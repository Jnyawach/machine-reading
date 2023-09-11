<?php

namespace App\Repositories;

use App\Http\Resources\MachineResource;
use App\Interfaces\MachineInterface;
use App\Models\Machine;

class MachineRepository implements MachineInterface
{

    public function getMachines(){
        $machines=Machine::when(request('search'), function($query){
               $query->where('name','like','%'.request('search').'%');
           })
         ->paginate(request('showing')??10);
        return MachineResource::collection($machines);
    }

    public function storeMachine($data){
        try {
            $machine=Machine::create($data);
            return response()->json([
                'status'=>200,
                'message'=>'Machine created successfully',
                'machine'=>new MachineResource($machine)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>400,
                'message'=>'Machine creation failed',
                'error'=>$th->getMessage()
            ]);
        }
    }

    public function updateMachine($data, $id){
        try {
            $machine=Machine::find($id);
            $machine->update($data);
            return response()->json([
                'status'=>200,
                'message'=>'Machine updated successfully',
                'machine'=>new MachineResource($machine)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>400,
                'message'=>'Machine update failed',
                'error'=>$th->getMessage()
            ]);
        }
    }

    public function machineDelete($id){
        try {
            $machine=Machine::findOrFail($id);
            $machine->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Machine deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>400,
                'message'=>'Machine deletion failed',
                'error'=>$th->getMessage()
            ]);
        }
    }
}
