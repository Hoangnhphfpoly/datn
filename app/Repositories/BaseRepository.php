<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    // lấy tất cả bản ghi
    public function fetchData()
    {
        return $this->model->all();
    }

    // tìm 1 bản ghi cụ thể bằng id
    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    // lưu mới bản ghi
    public function storeNew($data)
    {
        return $this->model->create($data);
    }

    // update bản ghi
    public function update($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    // xóa theo 1 id
    public function deleteById($id)
    {
        return $this->model->delete($id);
    }

    // xóa theo danh sách id
    public function delete($data)
    {
        return $this->model->whereIn('id', $data)->delete();
    }

    // lấy data theo câu where
    public function whereQuery($queries)
    {
        $result = $this->model;

        foreach ($queries as $query)
        {
            if ($query[0] === 'where')
            {
                $result = $result->where($query[1], $query[2], $query[3]);
            } elseif ($query[0] === 'orWhere')
            {
                $result = $result->orWhere($query[1], $query[2], $query[3]);
            }
        }

        return $result->get();
    }

}
