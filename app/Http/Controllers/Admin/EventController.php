<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrizes;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends BaseController
{
    /**
     * 抽奖活动列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $events = Event::paginate(4);
        return view('admin.event.index',compact('events'));
    }

    /**
     * 活动添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'title'=>'required',
                'content'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'prize_date'=>'required',
                'signup_num'=>'required',
            ]);
            $data = $request->all();
            $data['signup_start'] = strtotime($data['signup_start']);
            $data['signup_end'] = strtotime($data['signup_end']);
            $data['prize_date'] = strtotime($data['prize_date']);
            //dd($data);
            $event = Event::create($data);
            return redirect()->route('admin.event.index')->with('success','添加成功');
        }
        return view('admin.event.add');
    }
    /**
     * 活动修改
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id){
        $event = Event::findOrFail($id);
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'title'=>'required',
                'content'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'prize_date'=>'required',
                'signup_num'=>'required',
            ]);
            $data = $request->all();
            $data['signup_start'] = strtotime($data['signup_start']);
            $data['signup_end'] = strtotime($data['signup_end']);
            $data['prize_date'] = strtotime($data['prize_date']);
            $event->update($data);
            return redirect()->route('admin.event.index')->with('success','编辑成功');
        }
        return view('admin.event.edit',compact('event'));
    }
    /**
     * 活动奖品添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function prizeAdd(Request $request,$id){
        $events = Event::where('signup_start','>',time())->get();
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'name'=>'required',
                'description'=>'required',
            ]);
            EventPrizes::create($request->all());
            return redirect()->route('admin.event.index')->with('success','奖品添加成功');
        }
        return view('admin.event.prizeAdd',compact('events'));
    }
    /**
     * 开奖
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function open(Request $request,$id){
            $users = EventUser::where('events_id',$id)->pluck('user_id')->toArray();
            $prizes = EventPrizes::where('events_id',$id)->pluck('id')->toArray();
            shuffle($users);
            shuffle($prizes);
            foreach ($prizes as $k=>$v):
                EventPrizes::where('id',$v)->update(['user_id'=>$users[$k]]);
            endforeach;
            Event::update(['is_prize'=>1]);
            return redirect()->route('admin.event.index')->with('success','开奖成功');
    }
    public function del($id){
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admin.event.index')->with('success','删除成功');
    }
}
