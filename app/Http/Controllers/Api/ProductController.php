<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    protected ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
        return parent::__construct($service);
    }

    public function searchProducts(Request $request)
    {
        $query = $request->input('query');
        $products = $this->service->searchProducts($query);

        if (!$products) {
            return response()->json(['message' => 'No products found'], 404);
        }

        return response()->json($products);
    }
}
