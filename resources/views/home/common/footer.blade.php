<footer class="page-footer animated fadeInUp">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5>
                    <img class="circle responsive-img" src="{{ asset('img/avatar.jpg') }}" alt="logo" width="10%" height="10%">
                </h5>
                <p class="grey-text text-lighten-4">网站图片均来自网络，如有侵权请联系「 关于 」页面邮箱，立删。</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">友情链接</h5>
                <ul>
                    <li>
                        <a class="grey-text text-lighten-3" href="!#">简兮</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2017 - {{ date('Y', time()) }} Copyright 简兮. All Rights Reserved.
            <a style="color: rgba(255,255,255,0.8)"
               href="http://www.miitbeian.gov.cn/">{{ env('DOMAIN_NAME_FILING', '浙ICP备17047367号-1') }}</a>
            <a class="grey-text text-lighten-4 right" href="#!">🌟🌟🌟🌟🌟</a>
        </div>
    </div>
</footer>