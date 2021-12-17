<nav id="top">
    <div class="nav-wrapper" style="background: #98A9F9;">
        <a href="{{ route('home.index') }}" class="brand-logo center">
            <i class="material-icons">cloud</i>{{ config('app.name', '简兮') }} &nbsp;&nbsp;
        </a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li>
                <a href="{{ route('home.not-open') }}"><i class="material-icons left"
                                                          style="color: #ffedff">bookmark</i>菜单1</a>
            </li>
            <li>
                <a href="{{ route('home.not-open') }}"><i class="material-icons left" style="color: #ffba92">star</i>菜单2</a>
            </li>
            <li>
                <a href="{{ route('home.not-open') }}"><i class="material-icons left"
                                                          style="color: #bbded6">theaters</i>菜单3</a>
            </li>
            <li>
                <a href="{{ route('home.not-open') }}"><i class="material-icons left" style="color: #ffa1c5">photo</i>菜单4</a>
            </li>
        </ul>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            @guest
                <li><a href="{{ route('login') }}">登录</a></li>
                @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">注册</a></li>
                @endif
            @else
                <li>
                    <a class='dropdown-button' href='#' data-activates='user-info'>
                        <i class="material-icons left">account_circle</i>
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <ul id='user-info' class='dropdown-content' style="width: 10em; background: #7189bf;">
                    <li>
                        <a href="#!"><i class="material-icons left">settings</i>个人设置</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#!"><i class="material-icons left">perm_media</i>我的收藏</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#!"><i class="material-icons left">lock</i>锁屏</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();"><i class="material-icons left">exit_to_app</i>登出</a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </ul>
    </div>
</nav>
