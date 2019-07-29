@extends('home.index')

@section('main')

    <link href="{{ asset('css/login.css') }}" type="text/css" rel="stylesheet">

    <style>
        body {
            background-image: linear-gradient(to top, #fbc2eb 0%, #a6c1ee 100%);
        }
    </style>

    <form class="log-in" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <h1 class="title">重置密码 - <a href="{{ route('home.index') }}">{{ config('app.name', '简兮') }}</a></h1>
        <div>
            <input id="email" name="email" required class="validate" type="email" autofocus placeholder="E-mail"
                   value="{{ $email ?? old('email') }}"/>
            <label for="email"></label>
        </div>
        <div>
            <input id="pass" name="password" required class="validate tooltipped" data-position="right" data-delay="50"
                   data-tooltip="密码要求: 长度大于等于8位,由数字,字母组成" type="password" placeholder="密码"/>
            <label for="pass"></label>
        </div>
        <div>
            <input id="password-confirm" name="password_confirmation" required class="validate tooltipped"
                   data-position="right" data-delay="50"
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
        <button class="login-input submit" type="submit">确认重置</button>

        <div style="margin-top: 16px;">
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
        </div>

    </form>

    <a href="{{ route('login') }}">
        <button class="sign-up">登录 - {{ config('app.name', '简兮') }}</button>
    </a>

@endsection