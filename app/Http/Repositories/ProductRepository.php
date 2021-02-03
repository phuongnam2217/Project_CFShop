<?php

namespace App\Http\Repositories;


use App\Models\Product;

class ProductRepository implements RepositoryInterface {

    protected $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    function getAll()
    {
        // TODO: Implement getAll() method.
        return $this->productModel->get();
    }

    function findById($id)
    {
        // TODO: Implement findById() method.
        return $this->productModel->findOrFail($id);
    }

    function save($obj)
    {
        // TODO: Implement save() method.
        $obj->save();
    }

    function delete($obj)
    {
        // TODO: Implement delete() method.
        $obj->delete();
    }
}
