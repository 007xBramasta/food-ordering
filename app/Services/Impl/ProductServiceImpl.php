<?php

namespace App\Services\Impl;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\Collection;

class ProductServiceImpl implements ProductService
{
    public function saveProduct(string $id, string $name, string $description, string $price, string $categories_id, ?string $image_menu): void
    {
        $product = new Product([
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "categories_id" => $categories_id,
            "image_menu" => $image_menu,
        ]);
        $product->save();
    }   

    public function getProduct(): Collection
    {
        return Product::all();
    }

    public function editProduct(string $productId, string $newProduct): void
    {
        $product = Product::query()->find($productId);
        if ($product != null) {
            $product->product = $newProduct;
            $product->save();
        }
    }

    public function removeProduct(string $productId)
    {
        $product = Product::query()->find($productId);
        if($product != null){
            $product->delete();
        }
    }
}