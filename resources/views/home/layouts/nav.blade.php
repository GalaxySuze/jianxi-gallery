<nav id="top">
    <div class="nav-wrapper" style="background: #98A9F9;">
        <a href="{{ route('home.index') }}" class="brand-logo center">
            <i class="material-icons">cloud</i>简兮 &nbsp;&nbsp;
        </a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li>
                <a href="{{ route('home.not-open') }}"><i class="material-icons left" style="color: #ffedff">bookmark</i>标签</a>
            </li>
            <li>
                <a href="{{ route('home.not-open') }}"><i class="material-icons left" style="color: #ffba92">star</i>星系</a>
            </li>
            <li>
                <a href="{{ route('home.not-open') }}"><i class="material-icons left" style="color: #bbded6">theaters</i>周刊</a>
            </li>
            <li>
                <a href="{{ route('home.not-open') }}"><i class="material-icons left" style="color: #ffa1c5">photo</i>画廊</a>
            </li>
        </ul>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="{{ route('home.login') }}">登录</a></li>
            <li><a href="{{ route('home.login') }}">注册</a></li>
        </ul>
    </div>
</nav>