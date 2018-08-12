@extends("template.admin.whole")
@section('title','商家类型')
@section('content')
    <a href="{{route('admin.user.add')}}">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>会员名</th>
            <th>余额</th>
            <th>积分</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
        <tr>
            <td>{{$member->id}}</td>
            <td>{{$member->username}}</td>
            <td>{{$member->money}}</td>
            <td>{{$member->jifen}}</td>
            <td>
                    {{$member->status===0?'禁用':'启用'}}
            </td>
            <td>
                @if($member->status==1)
                    <a href="{{route("admin.member.edit",$member)}}">禁用</a>
                @endif
                <a href="{{route("admin.member.selete",$member)}}">查看会员</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection