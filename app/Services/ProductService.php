<?php
namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;

/**
 * @property ProductRepositoryInterface $repository
 */
class ProductService extends BaseService
{
    public function __construct(ProductRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function create (array $data)
    {
        if(isset($data['is_active']))
        {
            $data['is_active'] = $data['is_active'] ? 1: 0;
        }
        return parent::create($data);
    }

    public function searchProducts(string $query)
    {
        return $this->repository->searchProducts($query);
    }

    //This approach is more verbose and uses slightly more memory.
    //However, it provides clearer code by explicitly defining and using the specific repository property.
    // class ProductService extends BaseService
    // {
    //     // 1. Define a specific property
    //     private ProductRepositoryInterface $productRepository;

    //     public function __construct(ProductRepositoryInterface $repository)
    //     {
    //         parent::__construct($repository);

    //         // 2. Assign it in the constructor
    //         $this->productRepository = $repository;
    //     }

    //     public function searchProducts(string $query)
    //     {
    //         // 3. Use the specific property
    //         return $this->productRepository->searchProducts($query);
    //     }
    // }


}
