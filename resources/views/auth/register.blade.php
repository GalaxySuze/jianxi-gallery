@extends('home.index')

@section('main')

    <style>
        html, body {
            margin: 0;
            height: 100%;
            {{--            background: url({{ asset('img/login-side-bg-01.jpg') }}) #f0f0f4;--}}
         background-size: cover;
            background: #d9afd9;
            background-image: linear-gradient(to top, #d9afd9 0%, #97d9e1 88%);
        }

        .log-in {
            position: relative;
            width: 18rem;
            top: calc(40% - 9.25rem);
            margin: auto;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            text-align: center;
        }

        .title, .title > a {
            margin: 0 0 1.5rem;
            padding: 0;
            font-size: 2.5rem;
            line-height: 1;
            font-weight: 300;
            color: #fff;
        }

        .login-input, input[type=text], input[type=password], input[type=email] {
            box-sizing: border-box;
            display: block;
            margin: 0 0 1.2rem;
            padding: 0 1rem;
            width: 100%;
            height: 3rem;
            appearance: none;
            font-family: 'Roboto', sans-serif;
            font-size: 1.2rem;
            font-weight: 300;
            color: #556;
            text-align: center;
            border: 0;
            border-radius: 1.5rem;
            background: #fff;
        }

        .submit {
            margin-bottom: .6rem;
            font-weight: 500;
            cursor: pointer;
            color: #fff;
            background: #f6a7ba;
            transition: 200ms;
        }

        .submit:hover {
            background: #feb9c8;
        }

        .forgot {
            color: #ddd;
            text-decoration: none;
            font-size: 1rem;
        }

        .forgot:hover {
            color: #fff;
            text-decoration: none;
        }

        .sign-up {
            position: absolute;
            bottom: 2rem;
            left: 0;
            right: 0;
            width: 9rem;
            height: 3rem;
            margin: auto;
            border-radius: 1.5rem;
            border: 2px solid #fff;
            background: transparent;
            color: #fff;
            font-size: 1.2rem;
            font-weight: 500;
            font-family: 'Roboto', sans-serif;
            cursor: pointer;
            transition: 200ms;
            padding: 0;
        }

        .sign-up:hover {
            background: rgba(255, 255, 255, .3);
        }

        @media all and (height: 300px) {
            .sign-up {
                display: none
            }
        }

    </style>

    <script src="https://cdn.jsdelivr.net/npm/bluebird@3/js/browser/bluebird.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/whatwg-fetch@2.0.3/fetch.min.js"></script>

    <form class="log-in" method="POST" action="{{ route('register') }}">
        @csrf

        <h1 class="title">注册 - <a href="{{ route('home.index') }}">{{ config('app.name', '简兮') }}</a></h1>
        <div>
            <input id="name" name="name" required class="validate" type="text" autofocus placeholder="名称" value="{{ old('name') }}" />
            <label for="name"></label>
        </div>
        <div>
            <input id="email" name="email" required class="validate" type="email" autofocus placeholder="E-mail" value="{{ old('email') }}" />
            <label for="email"></label>
        </div>
        <div>
            <input id="pass" name="password" required class="validate tooltipped" data-position="right" data-delay="50"
                   data-tooltip="密码要求: 长度大于等于8位,由数字,字母组成" type="password" placeholder="密码"/>
            <label for="pass"></label>
        </div>
        <div>
            <input id="password-confirm" name="password_confirmation" required class="validate tooltipped" data-position="right" data-delay="50"
                   data-tooltip="密码要求: 长度大于等于8位,由数字,字母组成" type="password" placeholder="确认密码"/>
            <label for="password-confirm"></label>
        </div>
        <div id="captcha-row">
            <input id="captcha" name="captcha" required class="validate" type="text" placeholder="验证码"/>
            <label for="captcha"></label>
            <span id="captcha-img" style="display: none;">
                <img src="{{ captcha_src('flat') }}" class="z-depth-4" alt="验证码"
                     onclick="this.src='/captcha/flat?'+Math.random()">
            </span>
        </div>
        <button class="login-input submit" type="submit">注册</button>
        <div style="margin-top: 16px;">
            <span class="black-text">
                @if ($errors->has('name'))
                    <span class="center-align"><strong class="red-text">{{ $errors->first('name') }}</strong></span>
                @endif
                @if ($errors->has('email'))
                    <span class="center-align"><strong class="red-text">{{ $errors->first('email') }}</strong></span>
                @endif
                @if ($errors->has('password'))
                    <span class="center-align"><strong class="red-text">{{ $errors->first('password') }}</strong></span>
                @endif
                @if ($errors->has('captcha'))
                    <span class="center-align"><strong class="red-text">{{ $errors->first('captcha') }}</strong></span>
                @endif
                @if ($errors->isEmpty())
                    <p class="center-align" id="hitokoto">:D 获取中...</p>
                @endif
            </span>
        </div>
    </form>

    <a href="{{ route('login') }}">
        <button class="sign-up">登录 - {{ config('app.name', '简兮') }}</button>
    </a>

@endsection

@section('scriptContent')
    Materialize.toast('Hi, 欢迎注册 {{ config('app.name', '简兮') }}', 3000);

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