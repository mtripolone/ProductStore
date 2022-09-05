<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::all();
        return response($products, 200);
    }

    public function store(SearchProductRequest $request): Response
    {
        $payload = $request->validated();
        $product = Product::create($payload);
        return response($product, 200);
    }

    public function show($id): Response
    {
        $product = Product::find($id);
        if ($product != null) {
            return response($product, 200);
        }

        return response("Product {$id} not found", 404);
    }

    public function update(UpdateProductRequest $request, int $id): Response
    {
        $payload = $request->validated();
        $product = Product::find($id);

        if (isset($product)) {
            $product->update($payload);
            return  response($product->refresh(), 200);
        }

        return response('Não foram encontrados produtos', 404);
    }

    public function destroy(int $id): Response
    {
        $destroy = Product::destroy($id);
        if ($destroy != 1) {
            return response("Product {$id} not found", 404);
        }
        return response("Product {$id} deleted", 200);
    }

    public function searchByCategory($category): Response
    {
        $product = Product::where(
            'category',
            $category
        )->get()
        ->toArray();

        if ($product != []) {
            return response($product, 200);
        }

        return response("Product {$category} not found", 404);
    }

    public function searchByNameAndCategory($name, $category): Response
    {
        $product = Product::where(
            'name',
            $name
        )->where(
            'category',
            $category
        )->get()
        ->toArray();

        if ($product != []) {
            return response($product, 200);
        }

        return response("Product {$name} from category {$category} not found", 404);
    }

    public function searchByNoImage(): Response
    {
        $product = Product::where(
            'image_url',
            null
        )->get()
        ->toArray();

        if ($product != []) {
            return response($product, 200);
        }

        return response("Products without image not found", 404);
    }

    public function searchByImage(Request $request): Response
    {
        $imageUrl = $request->get('image_url');
        $product = Product::where(
            'image_url',
            $imageUrl
        )->get()
        ->toArray();

        if ($product != []) {
            return response($product, 200);
        }

        return response("Product image {$imageUrl} not found", 404);
    }
}
