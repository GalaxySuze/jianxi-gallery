@extends('home.index')

@section('main')
    <style>
        body {
            background: #384548;
        }
    </style>

    <main>
        <div class="row">

            <!-- 图片信息 -->
            <div class="col s2" id="detail-info">
                <ul class="side-nav fixed animated fadeInLeft">
                    <li>
                        <div class="userView">
                            <div class="background">
                                <img alt="bg" src="{{ asset('img/df-bg-02.jpg') }}">
                            </div>
                            <a href="{{ route('home.index') }}">
                                <img alt="avatar" class="circle tooltipped" src="{{ asset('img/avatar.jpg') }}"
                                     data-position="right" data-delay="50" data-tooltip="点击返回主页">
                            </a>
                            <a href="#!"><span class="black-text accent-1 name">{{ $info['org_code'] }}</span></a>
                            <a href="#!"><span class="white-text email">下载</span></a>
                        </div>
                    </li>
                    <li>
                        <a href="#!" id="hide-info-btn">
                            <i class="material-icons">arrow_back</i>收起信息框
                        </a>
                    </li>
                    <li>
                        <a href="#!">
                            <i class="material-icons">color_lens</i>

                        </a>
                    </li>
                    <li>
                        <a href="#!">
                            <i class="material-icons">hd</i>{{ $info['resolution'] }}
                        </a>
                    </li>
                    <li>
                        <div class="divider"></div>
                    </li>
                    <li>
                        <ul class="collapsible" data-collapsible="expandable">
                            <li>
                                <div class="collapsible-header blue-grey lighten-5 active"
                                     style="border-bottom: 1px solid #e0e0e0;"><i class="material-icons">folder_open</i>属性
                                </div>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="#!"><i class="material-icons">account_box</i>{{ $info['author'] }}</a>
                                        </li>
                                        <li><a href="#!"><i
                                                        class="material-icons">access_time</i>{{ $info['org_upload_time'] }}
                                            </a></li>
                                        <li><a href="#!"><i class="material-icons">note</i>{{ $info['size'] }}</a></li>
                                        <li><a href="#!"><i class="material-icons">visibility</i>{{ $info['org_views'] }}
                                            </a></li>
                                        <li><a href="#!"><i class="material-icons">star</i>{{ $info['org_star'] }}</a></li>
                                        <li><a href="#!"><i
                                                        class="material-icons">cloud_download</i>{{ $info['downloads'] }}
                                            </a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header blue-grey lighten-5"
                                     style="border-bottom: 1px solid #e0e0e0;"><i class="material-icons">bookmark_border</i>标签
                                </div>
                                <div class="collapsible-body">
                                    <div class="row center">
                                        @if (isset($info['tags']))
                                            @foreach($info['tags'] as $tag)
                                                <div class="chip">
                                                    {{ $tag }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header blue-grey lighten-5"
                                     style="border-bottom: 1px solid #e0e0e0;"><i class="material-icons">build</i>工具
                                </div>
                                <div class="collapsible-body">
                                    <div class="row center">
                                        <ul>
                                            <li><a href="#!"><i class="material-icons">favorite</i>收藏</a></li>
                                            <li><a href="#!"><i class="material-icons">warning</i>举报</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- 图片展示 -->
            <div class="col s10 animated fadeIn" id="img-frame">
                <div class="img-box">
                    <a target="_blank" href="{{ asset($info['img']) }}">
                        <img alt="{{ $info['code'] }}" src="{{ asset($info['img']) }}" class="z-depth-2 hoverable">
                    </a>
                </div>
            </div>

        </div>

        <!-- 信息框开关 -->
        <div class="row" id="info-menu">
            <div class="col s12">
                <div class="fixed-action-btn horizontal">
                    <a class="btn-floating btn-sm" style="background: #eee;">
                        <i class="large material-icons red-text text-accent-1">menu</i>
                    </a>
                </div>
            </div>
        </div>
    </main>

@endsection
