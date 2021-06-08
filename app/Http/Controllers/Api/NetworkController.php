<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;

class NetworkController extends Controller
{
    public function getIp(): string
    {
        return $_SERVER['REMOTE_ADDR'];
    }
}
