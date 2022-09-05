<?php

namespace App\Console\Commands;

use App\DTO\ProductValueData;
use App\Http\Requests\SearchProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Service\ProductsService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products through a Fake Store Api ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            $id = $this->option('id');

            $id ? $product = ProductsService::getProductById($id)
                : $products = ProductsService::getAllProducts();

            if (isset($product)) {
                $existName = $this->getExistName($product);
            }

            if (isset($products)) {
                foreach ($products as $product) {
                    $existName = $this->getExistName($product);
                }
            }

            DB::commit();

            return 1;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function getExistName(Product $product)
    {
        $existName = Product::where('name', $product->name)->first();

        if (is_null($existName)) {
            $product->save();
        }
        return $existName;
    }
}
