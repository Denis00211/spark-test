<?php

namespace Tests\Feature;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends PassportTestCase
{
    use RefreshDatabase;

    public function testSuccessInsertCategory()
    {
        $response = $this->post('/api/categories',[
            'title' => 'Test',
        ],  $this->headers);

        $response->assertStatus(200);
    }

    public function testSuccessUpdateCategory()
    {
        $this->post('/api/categories',[
            'title' => 'Test',
        ],  $this->headers);

        $category = Category::query()->first();

        $response = $this->put('/api/categories/' . $category->id,[
            'title' => 'Test',
        ],  $this->headers);

        $response->assertStatus(200);
    }

    public function testSuccessDestroyCategory()
    {
        $this->post('/api/categories',[
            'title' => 'Test',
        ],  $this->headers);

        $category = Category::query()->first();

        $response = $this->delete('/api/categories/' . $category->id,  $this->headers);

        $response->assertStatus(200);
    }


    public function testSuccessGetCategory()
    {
        $this->post('/api/categories',[
            'title' => 'Test',
        ],  $this->headers);

        $response = $this->get('/api/categories',$this->headers);

        $response->json();

        $response->assertSeeText('Test', $response->json());
        $response->assertStatus(200);
    }
}
