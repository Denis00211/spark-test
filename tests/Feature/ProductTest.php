<?php

namespace Tests\Feature;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends PassportTestCase
{
    use RefreshDatabase;

    public function testSuccessInsertProduct()
    {
        $response = $this->post('/api/products',[
            'title' => 'Test',
        ],  $this->headers);

        $response->assertStatus(200);
    }

    public function testSuccessUpdateProduct()
    {
        $this->post('/api/products',[
            'title' => 'Test',
        ],  $this->headers);

        $product = Product::query()->first();

        $response = $this->put('/api/products/' . $product->id,[
            'title' => 'Test',
        ],  $this->headers);

        $response->assertStatus(200);
    }

    public function testSuccessDestroyProduct()
    {
        $this->post('/api/products',[
            'title' => 'Test',
        ],  $this->headers);

        $product = Product::query()->first();

        $response = $this->delete('/api/products/' . $product->id,  $this->headers);

        $response->assertStatus(200);
    }


    public function testSuccessGetProduct()
    {
        $this->post('/api/products',[
            'title' => 'Test',
        ],  $this->headers);

        $response = $this->get('/api/products',$this->headers);

        $response->json();

        $response->assertSeeText('Test', $response->json());
        $response->assertStatus(200);
    }

    public function testSuccessGetProductsByCategory()
    {
        $this->post('/api/products',[
            'title' => 'Test',
        ],  $this->headers);

        $this->post('/api/categories',[
            'title' => 'Category 1',
            'productIds' => [
                Product::query()->first()->id
            ]
        ],  $this->headers);

        $data = Category::query()->with('products')->first();

        $response = $this->get('/api/products/categories?categoryIds[]='. Category::query()->first()->id, $this->headers);

        $data = $response->json();
        $response->assertSeeText('Test', $data);
        $response->assertSeeText('Category 1', $data);
        $response->assertStatus(200);
    }
}
