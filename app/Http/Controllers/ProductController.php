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
    
    
    public function addProduct(Request $request): RedirectResponse
    {
        // Ubah pemanggilan input menjadi sesuai dengan nama-nama field pada form
        $name = $request->input("name");
        $description = $request->input("description");
        $price = $request->input("price");
        $categories_id = $request->input("categories_id");
        $image_menu = $request->file("image_menu");
    
        // Validasi apakah semua field sudah diisi
        if (empty($name) || empty($description) || empty($price) || empty($categories_id) || empty($image_menu)) {
            // Jika ada field yang kosong, kembalikan kembali ke halaman create dengan pesan error
            return redirect()->route("products.create")->withInput()->withErrors(["error" => "All fields are required"]);
        }
    
        // Simpan produk dengan menggunakan ProductService
        $this->productService->saveProduct(
            Str::uuid(), // UUID
            $name, // Nama produk
            $description, // Deskripsi produk
            $price, // Harga produk
            $categories_id, // ID kategori produk
            $image_menu->store("images") // Simpan gambar menu produk ke direktori images
        );
    
        // Redirect kembali ke halaman produk setelah berhasil menyimpan produk
        return redirect()->route("products.product");
    }

    public function editProduct(Request $request, string $productId)
    {
        $newProduct = $request->input("newProduct");

        if (empty($newProduct)) {
            return redirect()->back()->with('error', 'New Product is required');
        }

        $this->productService->editProduct($productId, $newProduct);

        return redirect()->action([ProductController::class, 'product']);
    }

    public function removeProduct(Request $request, string $productId): RedirectResponse
    {
        $this->productService->removeProduct($productId);
        return redirect()->route('products');
    }
}
