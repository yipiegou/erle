<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class MemberController extends Controller
{
    /**
     * 注册
     * @param Request $request
     * @return array
     */
    public function reg(Request $request)
    {
        $data = $request->input();
        $validator = Validator::make($data,[
            'username' => 'required|unique:members|max:255',
            'password' => 'required|min:6|max:16',
            'sms' => 'required|integer|min:1000|max:9999',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',
                'unique:members'
            ],
        ]);
        //验证 如果有错
        if ($validator->fails()) {
            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => $validator->errors()->first()
            ];
        }
        //验证码对比
        if($data['sms']!==Redis::get('tel_'.$data['tel'])){
            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => '验证码错误'
            ];
        }
        $data['password'] = bcrypt($data['password']);
       // dd($data);
        Member::create($data);
        return [
            "status"=> "true",
            "message"=> "注册成功"
        ];
    }

    /**
     * 短信验证码
     * @return array
     */
    public function sms(){
        //接收参数
        $tel = \request()->input('tel');
        $validator = Validator::make($tel,[
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/'
            ],
        ]);
        //验证 如果有错
        if ($validator->fails()) {
            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => $validator->errors()->first()
            ];
        }
        //设置验证码
        $code = rand(1000,9999);
        //把验证码存储到redis缓存内，5分钟失效
        Redis::setex('tel_'.$tel,300,$code);

//        return [
//            "status" => "true",
//            "message" => "获取短信验证码成功" . $code
//        ];
        $config = [
            'access_key' => 'LTAIqeM470ZlraBK',
            'access_secret' => 'PWIquVIDYrTX8d2SFRJNmCuPydfxYa',
            'sign_name' => '高小均',
        ];
        $aliSms = new AliSms();
        $response = $aliSms->sendSms($tel, 'SMS_140695123', ['code'=> $code], $config);



        if ($response->Message==='OK') {
            return [
                'status'=>'true',
                'message'=>'获取短信验证码成功'
            ];
        }else{
            return [
                'status'=>'false',
                'message'=>$response->Message
            ];
        }
    }

    /**
     * 登录
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        //接收参数
        $data = $request->input();
        $data['username'] = $data['name'];
        $validator = Validator::make($data,[
            'name' => 'required|min:2|max:16',
            'password' => 'required|min:6|max:16',
        ]);
        //验证 如果有错
        if ($validator->fails()) {
            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => $validator->errors()->first()
            ];
        }
        //先通过用户名找到用户
        $member = Member::where('username',$data['username'])->first();
        if ($member && Hash :: check($data['password'],$member->password)) {
            return [
                "status"=>"true",
                "message"=>"登录成功",
                "user_id"=>$member->id,
                "username"=>$member->username
            ];
        }
        return [
            "status"=>"false",
            "message"=>"密码输入错误",
            "user_id"=>$member->id,
            "username"=>$member->username
        ];
    }

    /**
     * 修改密码
     */
    public function changePassword()
    {
        //接收数据
        $data = \request()->input();
        $validator = Validator::make($data,[
            'oldPassword' => 'required|min:6|max:16',
            'newPassword' => 'required|min:6|max:16',
        ]);
        //验证 如果有错
        if ($validator->fails()) {
            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => $validator->errors()->first()
            ];
        }
        $user = Member::where('id',$data['id'])->first();
        if ($user && Hash :: check($data['oldPassword'],$user->password)) {
            $user->password = bcrypt($data['newPassword ']);
            return [
                "status"=>"true",
                "message"=>"修改成功",
            ];
        }
        return [
            "status"=>"false",
            "message"=>"旧密码输入错误",
        ];

    }

    /**
     * 重置密码
     * @return array
     */
    public function forgetPassword()
    {
        $data = \request()->input();
        $validator = Validator::make($data,[
            'password' => 'required|min:6|max:16',
            'sms' => 'required|integer|min:1000|max:9999',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/'
            ],
        ]);
        //验证 如果有错
        if ($validator->fails()) {
            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => $validator->errors()->first()
            ];
        }
        //验证码对比
        if($data['sms']!==Redis::get('tel_'.$data['tel'])){
            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => '验证码错误'
            ];
        }
        $user = Member::where('tel',$data['tel'])->first();
        $user->password = bcrypt($data['password']);
        $user->save();
        return [
            "status"=> "true",
            "message"=> "重置密码成功"
        ];
    }
}
