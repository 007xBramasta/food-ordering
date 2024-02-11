<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductContrllerTest extends TestCase
{
    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "admin"
        ])->post("/products/add", [
            "id" => "2",
            "name" => "Soto",
            "description" => "enak",
            "price" => "Rp.10000",
            "categories_id" => 2,
            "images_menu" => "soto.jpg"
        ])->assertRedirect("/products/products");
    }
}
