<?php
namespace App\Repositories\Eloquent;

use App\Models\Color;
use App\Repositories\Contracts\ColorRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

class ColorRepository extends BaseRepository implements ColorRepositoryInterface
{
    public function __construct(Color $model)
    {
        parent::__construct($model);
    }
}
