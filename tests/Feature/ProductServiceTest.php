<?php

namespace Tests\Feature;

use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Assert;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    private ProductService $productService;

    protected function setUp(): void
    {
        parent::setUp();

        DB::delete("delete from products");

        $this->productService = $this->app->make(ProductService::class);
    }

    public function testProductServiceNotNull()
    {
        self::assertNotNull($this->productService);
    }

    public function testSaveProduct()
    {
        $this->productService->saveProduct("1", "Nasi Goreng", "Enak", "Rp.10000", "1", "nasgorjawa.jpg");

        $product = $this->productService->getProduct();
        foreach ($product as $value){
            self::assertEquals("1", $value['id']);
            self::assertEquals("Nasi Goreng", $value['name']);
            self::assertEquals("Enak", $value['description']);
            self::assertEquals("Rp.10000", $value['price']);
            self::assertEquals("nasgorjawa.jpg", $value['image_menu']);
            self::assertEquals("1", $value['categories_id']);
        }
    }

    public function testGetProductNotEmpty()
    {
        $expected = [
            [
                "id" => "2",
                "name" => "Nasi Goreng",
                "description" => "enak",
                "price" => "Rp.10000",
                "categories_id" => "1",
                "image_menu" => "nasgorjawa.jpg",
            ],
            [
                "id" => "1",
                "name" => "Es Teh",
                "description" => "enak pol",
                "price" => "Rp.15000",
                "categories_id" => "2",
                "image_menu" => "esteh.jpg",
            ]
        ];

        $this->productService->saveProduct("1", "Nasi Goreng", "enak", "Rp.10000", "1", "nasgorjawa.jpg");
        $this->productService->saveProduct("2", "Es Teh", "enak pol", "Rp.15000", "2", "esteh.jpg");

        Assert::assertArraySubset($expected, $this->productService->getProduct());
    }
}
