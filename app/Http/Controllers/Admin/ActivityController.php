<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //获取数据
        $activity = Activity::paginate(4);
        //显示视图 传递数据
        return view('admin.activity.index',compact('activity'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'title'=>'required',
                'content'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
            ]);
            $data = $request->all();
            $data['start_time'] = strtotime($data['start_time']);
            $data['end_time'] = strtotime($data['end_time']);
            //dd($data);
            Activity::create($data);
            return redirect()->route('activity.index')->with('success','添加成功');
        }
        //显示视图
        return view('admin.activity.add');
    }

    /**
     * 修改
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request,$id)
    {
        $activity = Activity::findOrfail($id);
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'title'=>'required',
                'content'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
            ]);
            $data = $request->all();
            $data['start_time'] = strtotime($data['start_time']);
            $data['end_time'] = strtotime($data['end_time']);
            //dd($data);
            $activity->update($data);
            return redirect()->route('activity.index')->with('success','修改成功');
        }
        return view('admin.activity.edit',compact('activity'));
    }

    /**
     * 删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request,$id)
    {
        $shop=Activity::findOrfail($id);
        $shop->delete();
        return redirect()->route('activity.index')->with('success','删除成功');
    }
}
