@extends('home.index')

@section('main')

    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, "San Francisco", Helvetica, Arial, sans-serif;
            font-weight: 300;
            margin: 0;
        }

        html, body {
            height: 100vh;
            width: 100vw;
            margin: 0 0;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            background: #f3f2f2;
        }

        h4 {
            font-size: 24px;
            font-weight: 600;
            color: #000;
            opacity: .85;
        }

        label {
            font-size: 12.5px;
            color: #000;
            opacity: .8;
            font-weight: 400;
        }

        form {
            padding: 40px 30px;
            background: #fefefe;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding-bottom: 20px;
        }

        form h4 {
            margin-bottom: 20px;
            color: rgba(0, 0, 0, 0.5);
        }

        form h4 span {
            color: black;
            font-weight: 700;
        }

        form p {
            line-height: 155%;
            margin-bottom: 5px;
            font-size: 14px;
            color: #000;
            opacity: .65;
            font-weight: 400;
            max-width: 200px;
            margin-bottom: 40px;
        }

        a.discrete {
            color: rgba(0, 0, 0, 0.4);
            font-size: 14px;
            border-bottom: solid 1px rgba(0, 0, 0, 0);
            padding-bottom: 4px;
            margin-left: auto;
            font-weight: 300;
            transition: all .3s ease;
            margin-top: 40px;
        }

        a.discrete:hover {
            border-bottom: solid 1px rgba(0, 0, 0, 0.2);
        }

        button {
            -webkit-appearance: none;
            width: auto;
            min-width: 100px;
            border-radius: 24px;
            text-align: center;
            padding: 15px 40px;
            margin-top: 5px;
            background-color: #b08bf8;
            color: #fff;
            font-size: 14px;
            margin-left: auto;
            font-weight: 500;
            box-shadow: 0px 2px 6px -1px rgba(0, 0, 0, 0.13);
            border: none;
            transition: all .3s ease;
            outline: 0;
        }

        button:hover {
            -webkit-transform: translateY(-3px);
            transform: translateY(-3px);
            box-shadow: 0 2px 6px -1px rgba(182, 157, 230, 0.65);
        }

        button:hover:active {
            -webkit-transform: scale(0.99);
            transform: scale(0.99);
        }

        input {
            font-size: 16px;
            padding: 20px 0px;
            height: 56px;
            border: none;
            border-bottom: solid 1px rgba(0, 0, 0, 0.1);
            background: #fff;
            min-width: 280px;
            box-sizing: border-box;
            transition: all .3s linear;
            color: #000;
            font-weight: 400;
            -webkit-appearance: none;
        }

        input:focus {
            border-bottom: solid 1px #b69de6;
            outline: 0;
            box-shadow: 0 2px 6px -8px rgba(182, 157, 230, 0.45);
        }

        .floating-label {
            position: relative;
            margin-bottom: 10px;
        }

        .floating-label label {
            position: absolute;
            top: calc(50% - 7px);
            left: 0;
            opacity: 0;
            transition: all .3s ease;
        }

        .floating-label input:not(:placeholder-shown) {
            padding: 28px 0px 12px 0px;
        }

        .floating-label input:not(:placeholder-shown) + label {
            -webkit-transform: translateY(-10px);
            transform: translateY(-10px);
            opacity: .7;
        }

        .session {
            display: flex;
            flex-direction: row;
            width: auto;
            height: auto;
            margin: auto auto;
            background: #ffffff;
            border-radius: 4px;
            box-shadow: 0px 2px 6px -1px rgba(0, 0, 0, 0.12);
        }

        .left {
            width: 220px;
            height: auto;
            min-height: 100%;
            position: relative;
            background-image: url("https://images.pexels.com/photos/114979/pexels-photo-114979.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
            background-size: cover;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .left svg {
            height: 40px;
            width: auto;
            margin: 20px;
        }

    </style>

    <div class="session">
        <div class="left">

        </div>
        <form action="" class="log-in" autocomplete="off">
            <h4>We are <span>NUVA</span></h4>
            <p>Welcome back! Log in to your account to view today's clients:</p>
            <div class="floating-label">
                <input placeholder="Email" type="text" name="email" id="email" autocomplete="off">
                <label for="email">Email:</label>
            </div>
            <div class="floating-label">
                <input placeholder="Password" type="password" name="password" id="password" autocomplete="off">
                <label for="password">Password:</label>
            </div>
            <button type="submit" onClick="return false;">Log in</button>
            <a href="https://codepen.io/elujambio/pen/YLMVed" class="discrete" target="_blank">Advanced version</a>
        </form>
    </div>

@endsection