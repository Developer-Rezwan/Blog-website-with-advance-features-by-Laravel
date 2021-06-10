<?php

namespace App\Http\Controllers;

use App\Events\CheckerEvent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $data = [];

    public $backend = [
        'siteName'  => 'TrickBD',
        'title' => 'Manage your blog!!!'
    ];

    public function __construct()
    {
        \broadcast(new CheckerEvent());
    }
}