<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class MemberController extends BaseController
{
    public function index(){
        $members = Member::all();
        return view('admin.member.index',compact('members'));
    }
    /**
     * 账号禁用
     * @return array
     */
    public function edit($id)
    {
        $user = Member::where('id',$id)->first();
        $user->status = 0;
        $user->save();
        session()->flash('success','账号禁用成功');
        return redirect(url()->previous());
    }
    /**
     * 会员查看
     * @return array
     */
    public function selete($id)
    {
        $user = Member::where('id',$id)->first();
        $user->order = Order::where('user_id',$user->id)->get();
        return view('admin.member.selete',compact('user'));
    }
}
