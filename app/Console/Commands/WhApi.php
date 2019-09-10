<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class WhApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:wh-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '请求wallhaven官方api获取数据';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://wallhaven.cc/api/v1/search');
        dd($res->getStatusCode(), $res->getBody()->getContents());
    }
}
