<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

interface ProductService
{
    public function saveProduct(string $id, string $name, string $description, string $price, string $categories_id, string $image_menu): void;

    public function getProduct(): Collection;

    public function editProduct(string $productId, string $newProduct): void;

    public function removeProduct(string $productId);
}