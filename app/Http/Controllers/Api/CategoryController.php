<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Services\CategoryService;

class CategoryController extends BaseController
{
    public function __construct(CategoryService $service)
    {
        parent::__construct($service);
    }
}
