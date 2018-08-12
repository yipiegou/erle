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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">最新活动<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shop.activity.index')}}">活动首页</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('menu.index')}}">菜品首页</a></li>
                        <li><a href="{{route('menu.add')}}">菜品添加</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品类管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('menus.index')}}">菜品类首页</a></li>
                        <li><a href="{{route('menus.add')}}">菜品类添加</a></li>
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
                        <li><a href="{{route('order.index')}}">订单首页</a></li>
                        <li><a href="{{route('order.menu')}}">销量首页</a></li>
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
                    @auth
                        <li><a href="#">{{\Illuminate\Support\Facades\Auth::user()->name}}</a></li>
                        <li>
                            <form action="{{route("user.logout")}}" method="post">
                                {{csrf_field()}}
                                <input type="submit" value="退出">
                            </form>
                        </li>
                    @endauth

                @guest
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="http://shop.erle.com/user/login">登录</a></li>
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