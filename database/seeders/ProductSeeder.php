<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $product = new Product();
      $product->id = "1";
      $product->name = "Nasi Goreng";
      $product->description = "Enak";
      $product->price = "Rp.10000";
      $product->categories_id = "1";
      $product->image_menu = "nasgorjawa.jpg";
      $product->save();
    }
}
