<?php


namespace App\Support;


use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tightenco\Collect\Support\Collection;

class DownloadPicture
{
    /**
     * @var
     */
    public $resources;
    /**
     * @var
     */
    public $client;

    /**
     * DownloadPicture constructor.
     * @param $resources
     * @throws Exception
     */
    public function __construct($resources = [])
    {
        $this->resources = $resources;
        $this->client = new Client();
    }

    /**
     * @return array
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * @param $resources
     * @return $this
     */
    public function setResources($resources)
    {
        $this->resources = $resources;
        return $this;
    }

    /**
     * @param $fileName
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function savePicture($fileName)
    {
        $item = $this->resources;

        // 存储远程图片
        if (isset($item['cover'])) {
            $coverURL = $item['cover'];
            $item['cover_path'] = $this->handleFile($coverURL, 'cover', $fileName);
        }

        if (isset($item['picture'])) {
            $imgURL = $item['picture'];
            $item['picture_path'] = $this->handleFile($imgURL, 'picture', $fileName);
        }

        return $item;
    }

    /**
     * @param $url
     * @param $dir
     * @param $name
     * @param string $ext
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handleFile($url, $dir, $name, $ext = '.jpg')
    {
        $date = Carbon::now()->toDateString();
        $res = $this->client->request('get', $url)
            ->getBody()->getContents();
        $picPath = "/$date" . "/$dir/" . md5($name) . $ext;
        Storage::disk('public')->put($picPath, $res);
        return $picPath;
    }

    public function filterHistory()
    {

    }
}