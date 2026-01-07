<?php
namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function searchProducts(string $query)
    {
        return $this->model->where('name', 'LIKE', "%$query%")
                           ->orWhere('description', 'LIKE', "%$query%")
                           ->get();
    }
}
