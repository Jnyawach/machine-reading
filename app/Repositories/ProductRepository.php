<?php

namespace App\Repositories;

use App\Http\Resources\ProductResource;
use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{

    public function getProducts(){
        $products=Product::query()
            ->when(request('search'),function ($query){
                $query->where('name','like','%'.request('search').'%');
            })
            ->when(request('product_type'),function ($query){
                $query->where('product_type_id',request('product_type'));
            })
            ->when(request('product_weight'),function ($query){
                $query->where('product_weight_id',request('product_weight'));
            })
            ->paginate(request('showing')??10);

        return ProductResource::collection($products);
    }

    public function productById(string $id){
        return new ProductResource(Product::findOrFail($id));
    }
    public function productBySlug(string $slug){
        return new ProductResource(Product::where('slug',$slug)->firstOrFail());
    }

    public function createProduct(array $attributes){
        try {
            $product=Product::create($attributes);
            return response()->json(['message'=>'Product created successfully','product'=>$product],200);
        }catch (\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()],400);
        }
    }

    public function updateProduct(array $data, string $id){
        try {
            $product=Product::findOrFail($id);
            $product->update($data);
            return response()->json(['message'=>'Product updated successfully','product'=>$product],200);
        }catch (\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()],400);
        }
    }

    public function deleteProduct(string $id){
        $product=Product::findOrFail($id);
        $product->delete();
        return response()->json(['message'=>'Product deleted successfully'],200);
    }
}
