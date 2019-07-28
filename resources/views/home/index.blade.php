<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('home.common.header')

<body>

<!-- 导航栏 -->
@includeWhen($showNav ?? false, 'home.layouts.nav')

@section('main')
    <main>
        <div class="container">
            <!-- 搜索框 -->
            <div class="row animated fadeInUp" style="padding-top: 16px;">
                <div class="col s12">
                    @include('home.layouts.search')
                </div>
            </div>

            <!-- 标签 -->
            <div class="row animated fadeInUp">
                <div class="col s10 left">
                    @if (isset($tags))
                        @foreach($tags as $tag)
                            <span style="padding-left: 5px; display: inline-block;">
                        <a class="waves-effect waves-light btn z-depth-2 hoverable"
                           style="background: {{ $tag['color'] }};">
                        <i class="material-icons left">loyalty</i> {{ $tag['name'] }}</a>
                    </span>
                        @endforeach
                    @endif
                </div>
                <div class="col s2">
                        <span class="right" style="display: inline-block;">
                            <a id="filter-panel-btn" class="btn-floating waves-effect waves-light btn-sm"
                               style="background-color: #6b778d;" data-activates="filter-panel">
                                <i class="material-icons">filter_list</i>
                            </a>
                        </span>
                </div>
            </div>

            <!-- 过滤器 -->
            <ul id="filter-panel" class="side-nav">
                <li>
                    <div class="userView">
                        <div class="background">
                            <img alt="" src="{{ asset('img/df-bg-01.jpg') }}">
                        </div>
                        <a href="#!"><img class="circle" src="{{ asset('img/avatar.jpg') }}"></a>
                        <a href="#!"><span class="white-text name">过滤器</span></a>
                        <a href="#!"><span class="white-text email"></span></a>
                    </div>
                </li>
                <li>
                    <div class="divider"></div>
                </li>
                <li>
                    <form>
                        <ul class="collapsible" data-collapsible="expandable">
                            <li>
                                <div class="collapsible-header blue-grey lighten-5 active"
                                     style="border-bottom: 1px solid #e0e0e0;"><i class="material-icons">whatshot</i>热度
                                </div>
                                <div class="collapsible-body">
                                    <div class="row center">
                                        <div class="input-field col s4">
                                            <input class="with-gap validate" name="filter_hot_group" type="radio"
                                                   id="filter_star" checked/>
                                            <label for="filter_star">收藏量</label>
                                        </div>
                                        <div class="input-field col s4">
                                            <input class="with-gap validate" name="filter_hot_group" type="radio"
                                                   id="filter_visit"/>
                                            <label for="filter_visit">访问量</label>
                                        </div>
                                        <div class="input-field col s4">
                                            <input class="with-gap validate" name="filter_hot_group" type="radio"
                                                   id="filter_download"/>
                                            <label for="filter_download">下载量</label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header blue-grey lighten-5 active"
                                     style="border-bottom: 1px solid #e0e0e0;"><i class="material-icons">date_range</i>时间
                                </div>
                                <div class="collapsible-body">
                                    <div class="row center">
                                        <div class="input-field col s6">
                                            <input class="with-gap validate" name="filter_date_group" type="radio"
                                                   id="filter_three_days" checked/>
                                            <label for="filter_three_days">近三天</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input class="with-gap validate" name="filter_date_group" type="radio"
                                                   id="filter_week"/>
                                            <label for="filter_week">近一周</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input class="with-gap validate" name="filter_date_group" type="radio"
                                                   id="filter_half_month"/>
                                            <label for="filter_half_month">近半月</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input class="with-gap validate" name="filter_date_group" type="radio"
                                                   id="filter_month"/>
                                            <label for="filter_month">近一月</label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header blue-grey lighten-5 active"
                                     style="border-bottom: 1px solid #e0e0e0;"><i class="material-icons">hd</i>分辨率
                                </div>
                                <div class="collapsible-body">
                                    <div class="row center">
                                        <div class="input-field col s10 offset-s1">
                                            <select id="filter_resolution" name="filter_resolution">
                                                <option value="" selected>请选择...</option>
                                                @if (isset($resolutionList))
                                                    @foreach($resolutionList as $item)
                                                        <option value="{{ $item['id'] }}">{{ $item['resolution'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <label for="filter_resolution"></label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </form>
                </li>
                <li>
                    <div class="row">
                        <div class="col s6">
                            <a class="waves-effect btn" style="background: #6b778d;"><i class="material-icons left">check_circle_outline</i>搜索</a>
                        </div>
                        <div class="col s6">
                            <a class="waves-effect btn" style="background: #6b778d;"><i class="material-icons left">autorenew</i>重置</a>
                        </div>
                    </div>
                </li>
            </ul>

            <!-- 图册 -->
            @if (isset($worksView))
                {!! $worksView !!}
            @endif
        </div>
    </main>
@show

<!-- top锚点 -->
@includeWhen($showFooter ?? false, 'home.layouts.top-anchor')

<!-- 页脚 -->
@includeWhen($showFooter ?? false, 'home.common.footer')

</body>

<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('materialize/js/materialize.min.js') }}"></script>

<script>
    $(document).ready(function () {

        // 过滤器面板
        $("#filter-panel-btn").sideNav({
            menuWidth: '36%',
            edge: 'right',
        });

        // 过滤器列表
        $('.collapsible').collapsible();

        // 分辨率过滤器初始化
        $('select').material_select();

        //初始化下拉框
        $('.dropdown-button').dropdown({
                constrain_width: false,
                belowOrigin: true,
                alignment: 'center'
            }
        );

        $('.carousel .carousel-slider').carousel({full_width: true});

        $('main').on('click', '.works-section:last .load-more', function () {
            var el = $(this);
            var loadMoreURL = el.attr('load-more-url');
            var parentSection = $('.works-section:last');
            $.ajax({
                url: loadMoreURL,
                success: function (result) {
                    el.closest('.load-more-section').remove();
                    parentSection.after(result);
                    $('.tooltipped').tooltip();
                }
            });
        });

        $('#info-menu').hide();
        $('#hide-info-btn').click(function () {
            $('#detail-info').hide(500);
            $('#info-menu').show(500);

            $('#img-frame').removeClass('s10').addClass('s12');
        });

        $('#info-menu').click(function () {
            $('#detail-info').show(500);
            $('#info-menu').hide(500);

            $('#img-frame').removeClass('s12').addClass('s10');
        });

        $('#login-more-btn').click(function () {
            if ($("#login-more-func").css("display") == "none") {
                $('#login-more-func').show(500);
            } else {
                $('#login-more-func').hide(500);
            }
        });

        $('#captcha').focus(function () {
            $('#captcha-img').show(300);
        });

        $('#captcha').blur(function () {
            $('#captcha-img').hide(300);
        });

        @yield('scriptContent')
    });
</script>
</html>
