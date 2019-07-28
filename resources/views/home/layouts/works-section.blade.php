<div class="animated fadeIn works-section">
    <div class="row">
        @foreach($works['data'] as $value)
            <div class="col s4" style="padding: 0;margin: 0;">
                <div class="card z-depth-2 hoverable" style="padding: 0;margin: 0; background-color: #384548;">

                    <!-- 分页信息 -->
                    @if ($loop->index == 2)
                        <div class="page-info">
                            <div class="card-panel center z-depth-2 hoverable" style="background-color: #ff9e80; min-width: 120px;margin: 0;padding: 5px;">
                                <span class="white-text">
                                    Page {{ $works['current_page'] }} / {{ $works['last_page'] }}
                                </span>
                            </div>
                        </div>
                    @endif

                    <!-- 图片信息 -->
                    <div class="card-image waves-effect waves-block waves-light">
                        <img alt="{{ $value['org_code'] }}" src="{{ $value['cover'] }}" oncontextmenu="return false;" class="activator img-selected">
                    </div>
                    <div class="card-reveal" style="background-color:rgba(255, 255, 255, 0.5);">
                        <span class="card-title grey-text text-darken-4">
                            ID: {{ $value['org_code'] }}
                            <i class="material-icons right">close</i>
                        </span>

                        <p>分辨率: {{ $value['resolution'] }}</p>
                        <p>收藏数: {{ $value['org_star'] }}</p>

                        <div class="row">
                            <div class="col s12 m6 l4">
                                <a href="{{ route('home.detail', $value['id']) }}" class="waves-effect waves-red btn-flat btn black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="收藏">
                                    <i class="material-icons large">favorite</i>
                                </a>
                            </div>
                            <div class="col s12 m6 l4">
                                <a href="{{ route('home.detail', $value['id']) }}"  class="waves-effect waves-yellow btn-flat btn black-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="访问">
                                    <i class="material-icons large">visibility</i>
                                </a>
                            </div>
                            <div class="col s12 m6 l4">
                                <a href="{{ route('home.detail', $value['id']) }}"  class="waves-effect waves-green btn-flat btn black-text tooltipped" data-delay="50" data-tooltip="下载">
                                    <i class="material-icons large" data-position="bottom">cloud_download</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div class="row center load-more-section" style="padding: 26px;">
        <div class="col s12">
            @if ($works['current_page'] != $works['last_page'])
                <a class="waves-effect blue accent-1 white-text btn load-more"
                   load-more-url="{{ $works['next_page_url'] }}">
                    <i class="material-icons left">refresh</i>加载更多
                </a>
            @else
                <h6 class="blue-text accent-5">已经到达世界的尽头...😎</h6>
            @endif
        </div>
    </div>
</div>