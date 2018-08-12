<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @foreach(\App\Models\Nav::where('pid',0)->get() as $nav)
                    <li class="dropdown">
                    <a href="{{route($nav->url)}}" class="dropdown-toggle" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">{{$nav->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach(\App\Models\Nav::where('pid',$nav->id)->get() as $n)
                            <li><a href="{{route($n->url)}}">{{$n->name}}</a></li>
                        @endforeach
                    </ul>
                    </li>
                @endforeach
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商户管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.user.index','1')}}">商户首页</a></li>
                        <li><a href="{{route('admin.user.index','0')}}">需审核商户</a></li>
                        <li><a href="{{route('admin.member.index')}}">会员首页</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.index')}}">管理员首页</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">订单管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.order.index')}}">订单首页</a></li>
                        <li><a href="{{route('admin.order.menu')}}">销量首页</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">权限管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.permission.index')}}">权限首页</a></li>
                        <li><a href="{{route('admin.permission.add')}}">权限添加</a></li>
                        <li><a href="{{route('admin.role.index')}}">用户组首页</a></li>
                        <li><a href="{{route('admin.role.add')}}">用户组添加</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @auth("admin")
                <li><a href="#">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}</a></li>
                <li>
                    <form action="{{route("admin.logout")}}" method="post">
                        {{csrf_field()}}
                        <input type="submit" value="退出">
                    </form>
                </li>
                @endauth

                @guest("admin")
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route("admin.login")}}">登录</a></li>
                                <li><a href="#">Something</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated</a></li>
                            </ul>
                        </li>
                @endguest
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>