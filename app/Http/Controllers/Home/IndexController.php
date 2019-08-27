<?php


namespace App\Http\Controllers\Home;


use App\Models\WhResolution;
use App\Models\WhTag;
use App\Models\WhWorks;
use App\Support\Tool;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class IndexController extends BaseController
{
    /**
     * IndexController constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // 加载更多
        $page = request()->get('page');
        if ($page && $page != 1) {
            return $this->worksView();
        }

        // 首页
        return view('home.index', [
            'tags'           => TagController::getRandomWhTag(),
            'resolutionList' => WhResolution::getResolutionData(),
            'worksView'      => $this->worksView(),
            'showNav'        => true,
            'showFooter'     => true,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function worksView()
    {
        return view('home.layouts.works-section', ['works' => WhWorks::getWhWorksData(),]);
    }

    /**
     * 404
     */
    public function notOpen()
    {
        return abort(404);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $info = WhWorks::find($id)->toArray();

        array_walk($info['tags'], function (&$v, $k) {
            return $v = Str::title($v);
        });

        return view('home.detail', ['info' => $info]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lockScreen()
    {
        return view('home.lock-screen');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function constellation()
    {
        $data = WhWorks::offset(0)
            ->limit(12)
            ->get()
            ->toArray();
        $constellation = ['aquarius', 'aries', 'cancer', 'capricorn', 'gemini', 'leo', 'libra', 'pisces', 'sagittarius', 'scorpio', 'taurus', 'virgo'];
        $tags = ['游戏', '数码', '鬼畜', '绅士', '风景', '粉色', '蓝色', '动漫', '复古'];
        $list = [];
        foreach ($constellation as $k => $v) {
            $attribute = [
                'grid'    => $v,
                'img'     => asset('storage' . $data[$k]['cover']),
                'title'   => strtoupper($v),
                'tag'     => Arr::random($tags),
                'content' => '停车坐爱枫林晚,霜叶红于二月花',
                'href'    => '#preview-1',
            ];
            $list[] = $attribute;
        }

        return view('home.constellation', ['list' => $list]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        if (empty(request()->get('query'))) {
            Tool::failureAlert('请输入搜索内容!');
        }
        $input = request()->all();
        $query = $input['query'];
        list($hot, $date, $resolution) = $input['filter'];
        $hotMap = [
            'filter_star'     => 'star',
            'filter_visit'    => 'views',
            'filter_download' => 'downloads',
        ];
        $dateMap = [
            'filter_three_days' => Carbon::now()->subDays(3)->toDateString(),
            'filter_week'       => Carbon::now()->subWeeks(1)->toDateString(),
            'filter_half_month' => Carbon::now()->subDays(15)->toDateString(),
            'filter_month'      => Carbon::now()->subMonths(1)->toDateString(),
        ];
        $hotValue = $hot['name'];
        $dateValue = $date['name'];
        $resolutionValue = optional(WhResolution::where('resolution', $resolution['value'])->first())->id;

        $data = WhWorks::where('title', trim($query))
            ->when($dateMap[$dateValue], function ($q) use ($dateMap, $dateValue) {
                $q->where('created_at', '>=', $dateMap[$dateValue]);
            })
            ->when($resolutionValue, function ($q) use ($resolutionValue) {
                $q->where('resolution_id', $resolutionValue);
            })
            ->orderBy($hotMap[$hotValue] ?? 'star', 'desc')
            ->paginate(WhWorks::DEFAULT_PAGES)
            ->toArray();

        return view('home.layouts.works-section', ['works' => $data,]);
    }
}
