<?php

namespace App\Http;

use App\Http\Controllers\Controller;
use Ethereal\Foundation\Http\Kernel as HttpKernel;
use Ethereal\Support\Arr;

class Kernel extends HttpKernel
{
    protected $deny_methods = [
        'PATCH', 'PUT', 'DELETE', 'OPTIONS'
    ];

    public function getControllerName(string $name)
    {
        return Arr::join(Controller::SEPARATOR, [Controllers::class, $name]);
    }
}