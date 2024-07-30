<?php

use App\Models\Product;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
// use JMac\Testing\Traits\AdditionalAssertions;
// use PHPUnit\Framework\Attributes\Test;
// use Tests\TestCase;


uses(WithFaker::class);

it('test products', function () {
    expect(true)->toBe(true);
});



// use AdditionalAssertions, RefreshDatabase, WithFaker;


it('index_behaves_as_expected', function () {
    $products = Product::factory()->count(3)->create();

    $response = $this->get(route('products.index'));

    $response->assertOk();
    $response->assertJsonStructure([]);
});



it('store_uses_form_request_validation', function () {
    $this->assertActionUsesFormRequest(
        \App\Http\Controllers\Api\ProductController::class,
        'store',
        \App\Http\Requests\StoreProductRequest::class
    );
});


it('store_saves', function () {
    $title = $this->faker->sentence(4);
    $content = $this->faker->paragraphs(3, true);

    $response = $this->post(route('products.store'), [
        'title' => $title,
        'content' => $content,
    ]);

    $products = Product::query()
        ->where('title', $title)
        ->where('content', $content)
        ->get();
    // $this->assertCount(1, $products);
    $product = $products->first();

    $response->assertCreated();
    // $response->assertJsonStructure([]);
});



it('show_behaves_as_expected', function () {
    $product = Product::factory()->create();

    $response = $this->get(route('products.show', $product));

    $response->assertOk();
    $response->assertJsonStructure([]);
});



// it('update_uses_form_request_validation', function () {
//     $this->assertActionUsesFormRequest(
//         \App\Http\Controllers\Api\ProductController::class,
//         'update',
//         \App\Http\Requests\UpdateProductRequest::class
//     );
// });


// it('update_behaves_as_expected', function () {
//     $product = Product::factory()->create();
//     $title = $this->faker->sentence(4);
//     $content = $this->faker->paragraphs(3, true);

//     $response = $this->put(route('products.update', $product), [
//         'title' => $title,
//         'content' => $content,
//     ]);

//     $product->refresh();

//     $response->assertOk();
//     $response->assertJsonStructure([]);

//     $this->assertEquals($title, $product->title);
//     $this->assertEquals($content, $product->content);
// });



// it('destroy_deletes_and_responds_with', function () {
//     $product = Product::factory()->create();

//     $response = $this->delete(route('products.destroy', $product));

//     $response->assertNoContent();

//     $this->assertModelMissing($product);
// });
