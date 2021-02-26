<?php

namespace App\Http\Services;

use App\Http\Repositories\ProductRepository;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService implements ServiceInterface {

    protected $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }

    function getAll()
    {
        // TODO: Implement getAll() method.
        return $this->productRepository->getAll();
    }

    function findById($id)
    {
        // TODO: Implement findById() method.
        return $this->productRepository->findById($id);
    }

    function add($request, $obj = null)
    {
        // TODO: Implement add() method.
        $obj = new Product();

        $obj->name = $request->name_product;
        $obj->price = $request->price;
        $obj->active = 1;
        $obj->isPortable = $request->isPortable;
        $obj->stock = $request->stock;
        $obj->image = $request->image;
//        $this->uploadFile($obj, $request);
        $obj->category_id = $request->category_id;
        $obj->menu_id = $request->menu_id;

        $this->productRepository->save($obj);
    }

    function delete($obj)
    {
        // TODO: Implement delete() method.
    }

    function update($request, $obj = null)
    {
        // TODO: Implement update() method.
        if($request->isPortable == 2){
            $obj->stock = null;
        } else {
            $obj->stock = $request->stock;
        }
        $obj->fill($request->all());
//        $this->uploadFile($obj, $request);
        $this->productRepository->save($obj);
    }

//    function uploadFile($obj, $request)
//    {
//        if ($request->hasFile('image')) {
//            $path = Storage::disk('s3')->put('images', $request->image, 'public');
//            $obj->image1 = $path;
//        }
//    }
}
