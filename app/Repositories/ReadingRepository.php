<?php

namespace App\Repositories;

use App\Enums\ConfirmStatusEnum;
use App\Http\Resources\ReadingResource;
use App\Interfaces\ReadingInterface;
use App\Models\Product;
use App\Models\Reading;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReadingRepository implements ReadingInterface
{

    public function getReadings(){
        $readings=Reading::with(['product','shift','user','confirmBy','machine'])
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

        return ReadingResource::collection($readings);
    }

    public function getReadingById(string $id){
        return new ReadingResource(Reading::findOrFail($id));
    }

    public function  createReading($data){
        try {

            $product=Product::findOrFail($data['product_id']);
            $reading=Reading::latest()->first();
            $automatic_count=$data['reading_entry'];

            if($reading){
                $automatic_count=$data['reading_entry']-$reading->reading_entry;
            }
            $reading_count=$automatic_count/$product->productWeight->packaging_quantity;
            $reading=Reading::create([
                'product_id'=>$data['product_id'],
                'shift_id'=>$data['shift'],
                'reading_entry'=>$data['reading_entry'],
                'user_id'=>$data['user_id'],
                'automatic_count'=>$automatic_count,
                'reading_count'=>$reading_count,
                'machine_id'=>$data['machine_id'],

            ]);
            return response()->json(['message'=>'Reading created successfully','reading'=>$reading],200);
        }catch (\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()],400);
        }
    }

    public function updateReading(array $data, string $id){
        try {

            $reading=Reading::findOrFail($id);
            $reading->update(
                [
                    'name'=>$data['name'],
                    'description'=>$data['description'],
                    'product_type_id'=>$data['product_type'],
                    'product_weight_id'=>$data['product_weight'],
                    'user_id'=>$data['user_id'],
                ]
            );
            return response()->json(['message'=>'Reading updated successfully','reading'=>$reading],200);
        }catch (\Exception $exception){

            return response()->json(['message'=>$exception->getMessage()],400);
        }
    }

    public function deleteReading(string $id)
    {

        try {
            $reading=Reading::findOrFail($id);
            $reading->delete();
            return response()->json(['message'=>'Reading deleted'],200);
        }catch (\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()],400);
        }
    }

    public function markConfirmed($id){
        try {
            $reading=Reading::findOrFail($id);
            $reading->update([
                'confirm_status'=>ConfirmStatusEnum::Confirmed->value,
                'confirm_by_id'=>Auth::id(),
                'confirmed_at'=>Carbon::now()
            ]);
            return response()->json(['message'=>'Reading confirmed'],200);
        }catch (\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()],400);
        }
    }

}
