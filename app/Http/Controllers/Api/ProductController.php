<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(Request $request): ProductCollection
    {
        $posts = Product::all();

        return new ProductCollection($posts);
    }

    public function store(StoreProductRequest $request): ProductResource
    {
        $post = Product::create($request->validated());

        return new ProductResource($post);
    }

    public function show(Request $request, Product $post): ProductResource
    {
        return new ProductResource($post);
    }

    public function update(UpdateProductRequest $request, Product $post): ProductResource
    {
        $post->update($request->validated());

        return new ProductResource($post);
    }

    public function destroy(Request $request, Product $post): Response
    {
        $post->delete();

        return response()->noContent();
    }
}
