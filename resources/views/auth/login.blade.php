@extends('home.index')

@section('main')

    <link href="{{ asset('css/login.css') }}" type="text/css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bluebird@3/js/browser/bluebird.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/whatwg-fetch@2.0.3/fetch.min.js"></script>

    <form class="log-in" method="POST" action="{{ route('login') }}">
        @csrf

        <h1 class="title">登录 - <a href="{{ route('home.index') }}">{{ config('app.name', '简兮') }}</a></h1>
        <div>
            <input id="email" name="email" required class="validate" type="email" autofocus placeholder="E-mail"
                   value="{{ old('email') }}"/>
            <label for="email"></label>
        </div>
        <div>
            <input id="pass" name="password" required class="validate tooltipped" data-position="right" data-delay="50"
                   data-tooltip="密码要求: 长度大于等于8位,由数字,字母组成" type="password" placeholder="密码"/>
            <label for="pass"></label>
        </div>
        <div id="captcha-row">
            <input id="captcha" name="captcha" required class="validate" type="text" placeholder="验证码"/>
            <label for="captcha"></label>
            <span id="captcha-img" style="display: none;">
                <img src="{{ captcha_src('flat') }}" class="z-depth-4" alt="验证码"
                     onclick="this.src='/captcha/flat?'+Math.random()">
            </span>
        </div>
        <button class="login-input submit" type="submit">登录</button>
        <div class="row">
            <div class="col s12" style="margin-top: 16px;">
                <a href="#!" id="login-more-btn" class="waves-effect waves-red btn-flat black-text"><i
                            class="material-icons center">arrow_drop_down</i></a>
            </div>
        </div>
        <div class="row" style="display: none" id="login-more-func">
            <div class="input-field col s6 left">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot">忘记密码?</a>
                @endif
            </div>
            <div class="col s6 right" style="margin-top: 15px;">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                <label for="remember" class="forgot">记住我</label>
            </div>
        </div>
        <div style="margin-top: 16px;">
            <span class="black-text">
                @if ($errors->has('email'))
                    <p class="center-align"><strong class="red-text">{{ $errors->first('email') }}</strong></p>
                @endif
                @if ($errors->has('password'))
                    <p class="center-align"><strong class="red-text">{{ $errors->first('password') }}</strong></p>
                @endif
                @if ($errors->has('captcha'))
                    <p class="center-align"><strong class="red-text">{{ $errors->first('captcha') }}</strong></p>
                @endif
                @if ($errors->isEmpty())
                    <!-- 一言 -->
                    <p class="center-align" id="hitokoto">:D 获取中...</p>
                @endif
            </span>
        </div>
    </form>

    <a href="{{ route('register') }}">
        <button class="sign-up">注册 - {{ config('app.name', '简兮') }}</button>
    </a>

@endsection

@section('scriptContent')
    Materialize.toast('欢迎登录 {{ config('app.name', '简兮') }}', 3000);

    var xhr = new XMLHttpRequest();
    xhr.open('get', 'https://v1.hitokoto.cn');
    xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
            var data = JSON.parse(xhr.responseText);
            var hitokoto = document.getElementById('hitokoto');
            hitokoto.innerText = data.hitokoto;
        }
    }
    {{--    xhr.send();--}}
@endsection