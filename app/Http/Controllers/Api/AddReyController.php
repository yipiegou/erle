<?php

namespace App\Http\Controllers\Api;

use App\Models\AddRey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddReyController extends BaseController
{
    public function address(Request $request){
        $data = $request->all();
        return AddRey::where('user_id',$data['user_id'])->get();
    }
    public function addresslist(Request $request){
        $data = $request->all();

        return AddRey::where('user_id',$data['user_id'])->get();
    }

    /**
     * 添加
     * @return array
     */
    public function addaddress(){
        $data = \request()->input();
        //dd($data);
        $validator = Validator::make($data,[
            'name' => 'required|min:6|max:16',
            'provence' => 'required',
            'city' => 'required',
            'area' => 'required',
            'user_id' => 'required',
            'detail_address' => 'required',
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
        AddRey::create($data);
        return [
            "status"=> "true",
            "message"=> "添加成功"
        ];
    }

    /**
     * 修改地址
     * @param Request $request
     * @return array
     */
    public function editAddress(Request $request){
        $data = $request->all();
       // dd($data);
        $validator = Validator::make($data,[
            'name' => 'required|min:1|max:16',
            'provence' => 'required',
            'city' => 'required',
            'area' => 'required',
            'id' => 'required',
            'detail_address' => 'required',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',
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
        $addrey = AddRey::find($data['id']);
        $addrey->update($data);
        return [
            "status"=> "true",
            "message"=> "修改成功"
        ];
    }
}