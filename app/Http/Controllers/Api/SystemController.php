<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;

class SystemController extends Controller
{
    public function getTimestamp(): int
    {
        return time();
    }
}
