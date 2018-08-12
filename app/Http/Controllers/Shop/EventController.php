<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventPrizes;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends BaseController
{
    /**
     * 抽奖活动列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $events = Event::paginate(4);
        return view('shop.event.index',compact('events'));
    }


    /**
     * 活动报名
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id){
        $event = Event::findOrFail($id);
        if ($request->isMethod('post')) {
            if (EventUser::where('user_id',Auth::user()->id)->where('events_id',$id)->first()) {
                return redirect()->route('shop.event.index')->with('success','你已经报过名了');
            }
            if (EventUser::where('events_id',$id)->count() >= Event::where('id',$id)->first()->signup_num) {
                return redirect()->route('shop.event.index')->with('success','报名人数已满');
            }
            EventUser::create(['user_id'=>Auth::user()->id,'events_id'=>$id]);
            return redirect()->route('shop.event.index')->with('success','报名成功');
        }
        return view('admin.event.edit',compact('event'));
    }
}
