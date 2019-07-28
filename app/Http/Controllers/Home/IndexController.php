<?php


namespace App\Http\Controllers\Home;


use App\Models\WhResolution;
use App\Models\WhTag;
use App\Models\WhWorks;
use App\Support\Tool;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class IndexController extends BaseController
{

    // 随机显示标签数
    const RANDOM_TAG_NUM = 3;

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
        $page = request()->get('page');
        if ($page && $page != 1) {
            return $this->worksView();
        }

        return view('home.index', [
            'tags'           => WhTag::getRandomWhTagData(self::RANDOM_TAG_NUM),
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

        return view('home.detail', [
            'info'       => $info,
            'showNav'    => false,
            'showFooter' => false,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('home.login', [
            'showNav'    => false,
            'showFooter' => false,
        ]);
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
}