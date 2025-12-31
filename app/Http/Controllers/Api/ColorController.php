<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Services\ColorService;


class ColorController extends BaseController
{
    public function __construct(ColorService $service)
    {
        parent::__construct($service);
    }
}
