<?php


namespace App\Support;


use Illuminate\Support\Arr;

class Tool
{
    /**
     * @param $msg
     * @param $e
     * @return string
     */
    public static function errFormat($msg, $e)
    {
        return "$msg : [ {$e->getMessage()} ====> {$e->getFile()}({$e->getLine()}) ]...";
    }

    /**
     * @param array $data
     */
    public static function filterFormat(array $data)
    {
        foreach ($data as &$v) {
            if (is_string($v)) {
                $v = trim($v);
            }
        }
    }

    /**
     * @param $path
     * @return string
     */
    public static function setStoragePath($path)
    {
        return asset('storage' . $path);
    }

    /**
     * @return mixed
     */
    public static function getRandomColor()
    {
        return Arr::random(['#7189bf', '#df7599', '#ffc785', '#ff9e80']);
    }

    /**
     * @return mixed
     */
    public static function getRandomNumber()
    {
        return Arr::random([1, 2, 3, 4, 5, 6, 7, 8, 9]);
    }
}