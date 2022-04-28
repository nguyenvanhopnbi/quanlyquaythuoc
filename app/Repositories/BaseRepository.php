<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    /**
     * BaseRepository constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * Configure the Model
     *
     * @return string
     */
    public function model()
    {
    }

    /**
     * @return Model|mixed|void
     * @throws \Exception
     */
    public function makeModel()
    {
        if (!$this->model()) return;
        $model = app()->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function getById(string $id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * @param array $conditions
     * @return mixed
     */
    public function getByConditions(array $conditions)
    {
        return $this->model->where($conditions)->first();
    }

    /**
     * @param array $conditions
     * @return mixed
     */
    public function getMultiByConditions(array $conditions)
    {
        return $this->model->where($conditions)->orderByDesc('id')->get();
    }


    /**
     * @param array $conditions
     * @return mixed
     */
    public function deleteByConditions(array $conditions)
    {
        return $this->model->where($conditions)->delete();
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function deleteById(string $id)
    {
        return $this->model->where('id', $id)->delete();
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function updateById(int $id, array $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function updateByConditions(array $conditions, array $data)
    {
        return $this->model->where($conditions)->update($data);
    }

}
