<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\RPC\Client\Client;

class TestRPC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpc:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$this->addVisit();
        $this->getVisits();
        return 0;
    }

    public function addVisit()
    {
        $token = env("RPC_TOKEN", null);
        $url_endpoint =  env("RPC_URL_ENDPOINT", null);
        $params = ['url' => 'http://www.google.ru/'];
        $client = new Client(Http::baseUrl($url_endpoint), $token);
        $response = $client->execute('visits@hit', $params);
        var_dump($response->result());
    }

    public function getVisits()
    {
        $token = env("RPC_TOKEN", null);
        $url_endpoint =  env("RPC_URL_ENDPOINT", null);
        $params = ['page' => 1, 'page_size' => 10];
        $client = new Client(Http::baseUrl($url_endpoint), $token);
        $response = $client->execute('visits@get', $params);
        $res = $response->result();
        var_dump($res);
    }
}
