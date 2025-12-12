<?php
namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryService extends BaseService
{
    public function __construct(CategoryRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data)
    {
        if(isset($data['is_active']))
        {
            $data['is_active'] = $data['is_active'] ? 1: 0;
        }
        return parent::create($data);
    }

    
}
