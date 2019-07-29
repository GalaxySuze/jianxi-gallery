@extends('home.index')

@section('main')

    <link href="{{ asset('css/login.css') }}" type="text/css" rel="stylesheet">

    <form class="log-in">
        <h1 class="title">登录 - <a href="{{ route('home.index') }}">{{ config('app.name', '简兮') }}</a></h1>
        <p>在继续之前，请检查您的电子邮件中的验证链接。</p>
        <p>如果您没有收到电子邮件,
            <a href="{{ route('verification.resend') }}">
                <button class="login-input submit" type="submit">可以点击这里重新请求</button>
            </a>
        </p>

        <div style="margin-top: 16px;">
            <span class="black-text">
                @if (session('resent'))
                    <p class="center-align"><strong>一个新的验证链接已发送到您的电子邮件地址。</strong></p>
                @endif
            </span>
        </div>
    </form>

    <a href="{{ route('login') }}">
        <button class="sign-up">登录 - {{ config('app.name', '简兮') }}</button>
    </a>

@endsection