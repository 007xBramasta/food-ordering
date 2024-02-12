<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductService;;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function product(Request $request)
    {
        $products = $this->productService->getProduct();
        return view("products.index", [
            "title" => "Product",
            "products" => $products
        ]);
    }
    
    public function addProduct(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $categories_id = $request->input('categories_id');
        $image_menu = $request->input('image_menu');

        // Periksa apakah nama produk baru tidak kosong
        if (empty($name)) {
            $products = $this->productService->getProduct();
            return response()->view('products.create', [
                'title' => 'Product',
                'products' => $products,
                'error' => 'Product name is required'
            ]);
        }

        $this->productService->saveProduct(
            Str::uuid(), // UUID
            $name, // Nama produk
            $description, // Deskripsi produk
            $price, // Harga produk
            $categories_id, // ID kategori produk
            $image_menu // Gambar menu produk
        );

        return redirect()->route('products');
    }

    
    public function editProduct(Request $request, string $productId)
    {
            
        $newProduct = $request->input('name');
        $newDescription = $request->input('description');
        $newPrice = $request->input('price');
        $newCategories_id = $request->input('categories_id');
        $newImage_menu = $request->input('image_menu');

        // Periksa apakah nama produk baru tidak kosong
        if (empty($newProduct)) {
            // Jika nama produk baru kosong, ambil daftar produk dan kembali ke halaman edit produk dengan pesan kesalahan
            $products = $this->productService->getProduct();
            return response()->view('products.edit', [
                'title' => 'Product',
                'products' => $products,
                'error' => 'Product name is required'
            ]);
        }

        // Jika nama produk baru tidak kosong, panggil method editProduct dari ProductService untuk mengedit produk
        $this->productService->editProduct(
            $productId,
            $newProduct,
            $newDescription,
            $newPrice,
            $newCategories_id,
            $newImage_menu
        );

        // Redirect ke halaman produk atau halaman lain yang diinginkan
        return redirect()->route('products');

    }

    public function removeProduct(Request $request, string $productId): RedirectResponse
    {
        $this->productService->removeProduct($productId);
        return redirect()->route('products');
    }
}
