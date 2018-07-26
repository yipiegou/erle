<?php

namespace App\Http\Controllers\Shop;

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
        $time = time();
        //获取数据
        $activity = Activity::where('end_time','>',$time)->get();
        //显示视图 传递数据
        return view('shop.activity.index',compact('activity'));
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
        return view('shop.activity.edit',compact('activity'));
    }

}
