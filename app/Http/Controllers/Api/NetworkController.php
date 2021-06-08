<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Routing\Controller;

class NetworkController extends Controller
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getIp(): string
    {
        $remoteIp = $_SERVER['REMOTE_ADDR'];
        $googleCloudFunctionPath = env('GOOGLE_CLOUD_FUNCTIONS_PATH');
        if ($googleCloudFunctionPath) {
            $remoteIp = (string)$this->client
                ->get($googleCloudFunctionPath . 'getRemoteIpAddress')
                ->getBody();
        }
        return $remoteIp;
    }
}
