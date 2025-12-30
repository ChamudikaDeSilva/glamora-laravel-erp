<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Services\BrandService;

class BrandController extends BaseController
{
    public function __construct(BrandService $service)
    {
        parent::__construct($service);
    }
}
