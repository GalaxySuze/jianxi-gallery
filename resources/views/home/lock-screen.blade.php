@extends('home.index')

@section('main')

    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/typed.js/2.0.5/typed.js"></script>

    <style>
        /* 打字机动画 */
        .typed-cursor {
            opacity: 1;
            -webkit-animation: blink 0.7s infinite;
            -moz-animation: blink 0.7s infinite;
            animation: blink 0.7s infinite;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @-webkit-keyframes blink {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @-moz-keyframes blink {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        /* terminal box */
        body {
            background-color: #384548;
        }

        .terminal_window {
            margin: 10% auto;
            width: 600px;
            height: 450px;
            tex-align: left;
            postion: relative;
            border-radius: 10px;
            background-color: #0D1F2D;
            color: #F4FAFF;
            font-size: 11pt;
            box-shadow: rgba(0, 0, 0, 0.8) 0 20px 70px;
        }

        .terminal_window header {
            background-color: #E0E8F0;
            height: 30px;
            border-radius: 8px 8px 0 0;
            padding-left: 10px;
        }

        .terminal_window .button {
            width: 12px;
            height: 12px;
            margin: 10px 4px 0 0;
            display: inline-block;
            border-radius: 8px;
        }

        .terminal_text {
            margin-top: 15px;
            margin-left: 20px;
            font-family: Menlo, Monaco, "Consolas", "Courier New", "Courier";
        }

        .red_btn {
            background-color: #E75448;
        }

        .green_btn {
            background-color: #3BB662;
        }

        .yellow_btn {
            background-color: #E5C30F;
        }

        #typed-strings {
            display: inline-block;
            postiion: relative;
        }

        #typed {
            font-family: Menlo, Monaco, "Consolas", "Courier New", "Courier";
            margin-left: 10px;
        }

        .head-symbol {
            color: #ff8a80;
        }

        .uname {
            color: #80d8ff;
        }

        .home-symbol {
            color: #ffff8d;
        }

        .mac {
            color: #b9f6ca;
        }

        .pass {
            color: #78909c;
        }

        #pass-input {
            background-color: #0D1F2D;
            border: none;
            color: #F4FAFF;
        }
    </style>

    <div class="terminal_window">
        <header>
            <a href="{{ route('home.index') }}" class="red_btn button tooltipped" data-position="left" data-delay="50"
               data-tooltip="返回首页"></a>
            <a href="{{ route('home.login') }}" class="green_btn button tooltipped" data-position="top" data-delay="50"
               data-tooltip="我要注册"></a>
            <a href="#!" class="yellow_btn button tooltipped" data-position="right" data-delay="50"
               data-tooltip="嘤嘤嘤~"></a>
        </header>
        <div id="typed-strings" class="terminal_text">
            <p>
                <span class="head-symbol">$</span>
                <span class="uname"> Vick </span> @
                <span class="mac">MacBook-Pro</span> in
                <b class="home-symbol">~</b> [<?php echo e(date('H:i:s', time())); ?>]
            </p>
            <span class="head-symbol">$</span><span id="typed"></span>
        </div>
    </div>

    <script>
        var typed = new Typed('#typed', {
            strings: ["Login This-Site", "Login Your-Heart <p class='pass'>Password:🔑</p><span id='input-box'></span>"],
            typeSpeed: 100, //打字速度
            backSpeed: 50, //回退速度
            onComplete: function (result) {
                $("#input-box").html('<input type="password" id="pass-input" name="pass" value="******">');
            }
        });
    </script>

@endsection



