<?php

namespace App\Service;

use App\DTO\ProductValueData;
use App\Models\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;

class ProductsService
{
    public static function getProductById($id): Product
    {
        $productById = self::apiConnection('products/' . $id);
        return self::getProduct($productById);
    }

    /** @return Product[] */
    public static function getAllProducts(): array
    {
        $products = [];
        $productAll = self::apiConnection('products');

        foreach ($productAll as $product) {
            $product = self::getProduct($product);
            $products[] = $product;
        }

        return $products;
    }

    private static function apiConnection($path)
    {
        $baseUri = config('services.products.baseUri');

        $client = new Client(['base_uri' => $baseUri . "/"]);
        $headers = [
            'Accept'     => 'application/json',
        ];

        try {
            $resp =  $client->request('GET', $path, [
                'headers' => $headers
            ]);
            return json_decode($resp->getBody()->getContents(), true);
        } catch (ServerException $e) {
            return [
                'statusCode' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        } catch (GuzzleException $e) {
            return [
                'statusCode' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * @param mixed $product
     * @return Product
     */
    protected static function getProduct(mixed $product): Product
    {
        $data = ProductValueData::fromRequest($product)->toArray();
        $product = new Product();
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->category = $data['category'];
        $product->image_url = $data['image_url'];
        return $product;
    }
}
