<?php

namespace App\Repositories;

use App\RPC\Client\Client;
use Illuminate\Support\Facades\Http;

class RPCRepository
{
    private $rpc_client;

    public function __construct()
    {
        $token = env("RPC_TOKEN", null);
        $url_endpoint =  env("RPC_URL_ENDPOINT", null);
        $this->rpc_client = new Client(Http::baseUrl($url_endpoint), $token);
    }

    public function getRPCClient(){
        return $this->rpc_client;
    }

}
