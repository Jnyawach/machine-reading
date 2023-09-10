<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductWeight;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Enums\RoleEnum;

class AdminProducts extends Controller
{
    private $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository=$productRepository;
        $this->middleware(['role:'.RoleEnum::Admin->value]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products=$this->productRepository->getProducts();
        $filters=request()->all('search','showing','product_type','product_weight');
        $product_types=ProductType::select('id','name')->get();
        $product_weights=ProductWeight::all();
        return inertia::render('admin/products/index', compact('products','filters','product_weights','product_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
