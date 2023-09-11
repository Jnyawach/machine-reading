<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Machine;
use App\Models\Product;
use App\Models\Shift;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function getProducts(){
        $products=ProductResource::collection(Product::get());
        $shifts=Shift::all();
        $machines=Machine::select('id','name')->get();
        return response()->json(['products'=>$products,'shifts'=>$shifts,'machines'=>$machines],200);
    }
}
