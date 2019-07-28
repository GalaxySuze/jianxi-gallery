@extends('home.index')

@section('main')

    <style>
        html,body {
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
            top: calc(50% - 9.25rem);
            margin: auto;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            text-align: center;
        }
        .title {
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
            width: 100%; height: 3rem;
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
            background: #00B0FF;
            transition: 200ms;
        }
        .submit:hover {
            background: #10C0FF;
        }
        .forgot {
            color: #ddd;
            text-decoration: none;
            font-size: .9rem;
        }
        .forgot:hover {
            color: #fff;
            text-decoration: none;
        }
        .sign-up {
            position: absolute;
            bottom: 2rem;
            left: 0; right: 0;
            width: 9rem; height: 3rem;
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
            background: rgba(255,255,255,.3);
        }

        @media all and (height:300px) {
            .sign-up {display:none}
        }

    </style>

    <form class="log-in">
        <h1 class="title">登录 - 简兮</h1>
        <div>
            <input id="email" type="text" autofocus placeholder="E-mail" />
            <label for="email"></label>
        </div>
        <div>
            <input id="pass" type="password" placeholder="密码" />
            <label for="pass"></label>
        </div>
        <div>
            <input id="code" type="text" placeholder="验证码" />
            <label for="code"></label>
        </div>
        <button class="login-input submit" type="submit">Log In</button>
        <a href="#" class="forgot">忘记密码?</a>
    </form>

    <button class="sign-up">注册 - 简兮</button>

@endsection

@section('scriptContent')
    Materialize.toast('欢迎登录 简兮', 3000)
@endsection