<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByName($name)
    {
        return $this->model->where('name', 'like', "%$name%")->get();
    }
}
