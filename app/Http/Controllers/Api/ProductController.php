<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function __construct(ProductService $service)
    {
        return parent::__construct($service);
    }
}
