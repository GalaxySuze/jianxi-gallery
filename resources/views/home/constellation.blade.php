<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>简兮</title>

    <link rel="icon" href="{{ asset('favicon.png') }}" sizes="32x32">

    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('materialize/css/materialize.min.css') }}" type="text/css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('grid/css/base.css') }}"/>

</head>
<body class="loading">

<svg class="hidden">
    <symbol id="icon-arrow" viewBox="0 0 24 24">
        <title>arrow</title>
        <polygon points="6.3,12.8 20.9,12.8 20.9,11.2 6.3,11.2 10.2,7.2 9,6 3.1,12 9,18 10.2,16.8 "/>
    </symbol>
    <symbol id="icon-drop" viewBox="0 0 24 24">
        <title>drop</title>
        <path d="M12,21c-3.6,0-6.6-3-6.6-6.6C5.4,11,10.8,4,11.4,3.2C11.6,3.1,11.8,3,12,3s0.4,0.1,0.6,0.3c0.6,0.8,6.1,7.8,6.1,11.2C18.6,18.1,15.6,21,12,21zM12,4.8c-1.8,2.4-5.2,7.4-5.2,9.6c0,2.9,2.3,5.2,5.2,5.2s5.2-2.3,5.2-5.2C17.2,12.2,13.8,7.3,12,4.8z"/>
        <path d="M12,18.2c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7c1.3,0,2.4-1.1,2.4-2.4c0-0.4,0.3-0.7,0.7-0.7c0.4,0,0.7,0.3,0.7,0.7C15.8,16.5,14.1,18.2,12,18.2z"/>
    </symbol>
    <svg id="icon-github" viewBox="0 0 33 33">
        <title>github</title>
        <path d="M16.608.455C7.614.455.32 7.748.32 16.745c0 7.197 4.667 13.302 11.14 15.456.815.15 1.112-.353 1.112-.785 0-.386-.014-1.411-.022-2.77-4.531.984-5.487-2.184-5.487-2.184-.741-1.882-1.809-2.383-1.809-2.383-1.479-1.01.112-.99.112-.99 1.635.115 2.495 1.679 2.495 1.679 1.453 2.489 3.813 1.77 4.741 1.353.148-1.052.569-1.77 1.034-2.177-3.617-.411-7.42-1.809-7.42-8.051 0-1.778.635-3.233 1.677-4.371-.168-.412-.727-2.069.16-4.311 0 0 1.367-.438 4.479 1.67a15.602 15.602 0 0 1 4.078-.549 15.62 15.62 0 0 1 4.078.549c3.11-2.108 4.475-1.67 4.475-1.67.889 2.242.33 3.899.163 4.311C26.37 12.66 27 14.115 27 15.893c0 6.258-3.809 7.635-7.437 8.038.584.503 1.105 1.497 1.105 3.017 0 2.177-.02 3.934-.02 4.468 0 .436.294.943 1.12.784 6.468-2.159 11.131-8.26 11.131-15.455 0-8.997-7.294-16.29-16.291-16.29"></path>
    </svg>
    <symbol id="icon-cross" viewBox="0 0 24 23">
        <title>cross</title>
        <path d="M23.865 3.677c.197-.383.164-.818-.008-1.18.048-.41-.06-.827-.448-1.147L22.323.457c-.636-.524-1.632-.689-2.25 0a155.348 155.348 0 0 1-8.797 9.001C9.011 7.342 6.72 5.255 4.443 3.165c-.8-.734-1.956-.503-2.458.37C1.253 3.9.659 4.374.168 5.182c-.233.386-.215.872 0 1.258 1.47 2.635 4.31 4.951 6.646 7.083-.313.28-.623.562-.942.836-3.146 2.702-5.268 4.416-1.331 7.187.053.037.107.029.161.05.076.036.148.06.232.074.026 0 .05.005.075.003.082.007.16.027.243.011 2.117-.415 4.085-2.074 5.872-3.9 1.74 1.715 3.592 3.353 5.63 4.325.485.232 1.063.097 1.436-.227.626.047 1.197-.342 1.484-.901.042-.026.07-.041.116-.07.91-.569.993-1.701.32-2.482-1.522-1.762-3.138-3.438-4.787-5.084 2.968-2.9 6.674-6.027 8.542-9.667z"/>
    </symbol>
</svg>

<main>
    <div class="content">
        <div class="grid">
            @foreach ($list as $v)
                @component("home.grid-components.{$v['grid']}", [
                'href' => $v['href'],
                'img' => $v['img'],
                'title'=> $v['title'],
                'tag' => $v['tag'],
                'content' => $v['content'],])
                @endcomponent
            @endforeach
        </div>
    </div>

    <div class="overlay">
        <div class="overlay__reveal"></div>
        <div class="overlay__item" id="preview-1">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img box__img--original" src="{{ asset('img/bg.jpg') }}" alt="Some image"/>
                <h3 class="box__title"><span class="box__title-inner">BEST</span></h3>
                <h4 class="box__text"><span class="box__text-inner">狮子座</span></h4>
                <div class="box__deco">&#10014;</div>
            </div>
            <p class="overlay__content">停车坐爱枫林晚,霜叶红于二月花.</p>
        </div>
        <div class="overlay__item" id="preview-2">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img box__img--original" src="{{ asset('img/bg.jpg') }}" alt="Some image"/>
                <h3 class="box__title box__title--straight box__title--bottom"><span class="box__title-inner">Gun</span>
                </h3>
                <h4 class="box__text box__text--bottom"><span
                            class="box__text-inner box__text-inner--rotated1">Rain</span></h4>
                <div class="box__deco box__deco--top">&#10115;</div>
            </div>
            <p class="overlay__content">It's time the tale were told of how you took a child and you made him old.</p>
        </div>
        <div class="overlay__item" id="preview-3">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img box__img--original" src="{{ asset('img/bg.jpg') }}" alt="Some image"/>
                <h3 class="box__title"><span class="box__title-inner">West</span></h3>
                <h4 class="box__text box__text--topcloser"><span class="box__text-inner">Green</span></h4>
                <div class="box__deco">&#10032;</div>
            </div>
            <p class="overlay__content">It's time the tale were told of how you took a child and you made him old.</p>
        </div>
        <div class="overlay__item" id="preview-4">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img box__img--original" src="{{ asset('img/bg.jpg') }}" alt="Some image"/>
                <h3 class="box__title"><span class="box__title-inner">Catch</span></h3>
                <h4 class="box__text box__text--bottom box__text--right"><span
                            class="box__text-inner box__text-inner--rotated3">Fire</span></h4>
            </div>
            <p class="overlay__content">It's time the tale were told of how you took a child and you made him old.</p>
        </div>
        <div class="overlay__item" id="preview-5">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img box__img--original" src="{{ asset('img/bg.jpg') }}" alt="Some image"/>
                <h3 class="box__title"><span class="box__title-inner">Lim</span></h3>
                <h4 class="box__text box__text--bottomcloser"><span class="box__text-inner">Breed</span></h4>
            </div>
            <p class="overlay__content">It's time the tale were told of how you took a child and you made him old.</p>
        </div>
        <div class="overlay__item" id="preview-6">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img box__img--original" src="{{ asset('img/bg.jpg') }}" alt="Some image"/>
                <h3 class="box__title"><span class="box__title-inner">Hard</span></h3>
                <h4 class="box__text"><span class="box__text-inner">Fast</span></h4>
            </div>
            <p class="overlay__content">It's time the tale were told of how you took a child and you made him old.</p>
        </div>
        <div class="overlay__item" id="preview-7">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img box__img--original" src="{{ asset('img/bg.jpg') }}" alt="Some image"/>
                <h3 class="box__title box__title--straight box__title--bottom"><span class="box__title-inner">Red</span>
                </h3>
                <h4 class="box__text box__title--bottom"><span
                            class="box__text-inner box__text-inner--rotated1">Life</span></h4>
            </div>
            <p class="overlay__content">It's time the tale were told of how you took a child and you made him old.</p>
        </div>
        <div class="overlay__item" id="preview-8">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img box__img--original" src="{{ asset('img/bg.jpg') }}" alt="Some image"/>
                <h3 class="box__title"><span class="box__title-inner">Jack</span></h3>
                <h4 class="box__text box__text--bottom"><span class="box__text-inner">Bust</span></h4>
                <div class="box__deco">&#10108;</div>
            </div>
            <p class="overlay__content">It's time the tale were told of how you took a child and you made him old.</p>
        </div>
        <div class="overlay__item" id="preview-9">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img box__img--original" src="{{ asset('img/bg.jpg') }}" alt="Some image"/>
                <h3 class="box__title"><span class="box__title-inner">Wild</span></h3>
                <h4 class="box__text box__text--bottom"><span class="box__text-inner">Zack</span></h4>
            </div>
            <p class="overlay__content">It's time the tale were told of how you took a child and you made him old.</p>
        </div>
        <div class="overlay__item" id="preview-10">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img box__img--original" src="{{ asset('img/bg.jpg') }}" alt="Some image"/>
                <h3 class="box__title box__title--bottom"><span class="box__title-inner">Lost</span></h3>
                <h4 class="box__text"><span class="box__text-inner box__text-inner--rotated2">Rust</span></h4>
            </div>
            <p class="overlay__content">It's time the tale were told of how you took a child and you made him old.</p>
        </div>
        <div class="overlay__item" id="preview-11">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img box__img--original" src="{{ asset('img/bg.jpg') }}" alt="Some image"/>
                <h3 class="box__title box__title--straight box__title--left"><span class="box__title-inner">Grit</span>
                </h3>
                <h4 class="box__text box__text--bottom box__text--right"><span
                            class="box__text-inner box__text-inner--rotated3">Mud</span></h4>
                <div class="box__deco box__deco--top">&#10153;</div>
            </div>
            <p class="overlay__content">It's time the tale were told of how you took a child and you made him old.</p>
        </div>
        <button class="overlay__close">
            <svg class="icon icon--cross">
                <use xlink:href="#icon-cross"></use>
            </svg>
        </button>
    </div>
</main>
</body>

<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('materialize/js/materialize.min.js') }}"></script>

<!-- 网格 -->
<script type="text/javascript" src="{{ asset('grid/js/imagesloaded.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('grid/js/TweenMax.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('grid/js/demo.js') }}"></script>

<script>
    document.documentElement.className = "js";
    var supportsCssVars = function () {
        var e, t = document.createElement("style");
        return t.innerHTML = "root: { --tmp-var: bold; }", document.head.appendChild(t), e = !!(window.CSS && window.CSS.supports && window.CSS.supports("font-weight", "var(--tmp-var)")), t.parentNode.removeChild(t), e
    };
    supportsCssVars() || alert("请在支持CSS变量的现代浏览器(比如谷歌浏览器)浏览网站~");

    $(document).ready(function () {

    });
</script>
</html>
