<?php

namespace App\Http\Controllers\User;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Interfaces\MachineInterface;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Enums\RoleEnum;

class UserMachineController extends Controller
{
    private MachineInterface $machineRepository;

    public function __construct(MachineInterface $machineRepository){
        $this->machineRepository=$machineRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $machines=$this->machineRepository->getMachines();
        $filters = request()->all('search', 'showing');
        $statuses=StatusEnum::cases();
        $product_types=ProductType::select('name','id')->get();

        return inertia::render('user/machines/index', compact(
            'machines','filters','statuses','product_types'));
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

        $validated=$request->validate([
            'name'=>'required|string|max:125',
            'status'=>'required|string',
            'product_type'=>'required|integer|exists:product_types,id'
        ]);
        $machine=$this->machineRepository->storeMachine($validated);

        if ($machine->status()==200) {
            return redirect()->back()->with('success', 'Machine created successfully');
        } else {
            return redirect()->back()->with('status', 'Machine creation failed');
        }
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
        $validated=$request->validate([
            'name'=>'required|string|max:125',
            'status'=>'required|string',
            'product_type'=>'required|integer|exists:product_types,id'
        ]);

        $machine=$this->machineRepository->updateMachine($validated,$id);
        if ($machine->status()==200) {
            return redirect()->back()->with('success', 'Machine updated successfully');
        } else {
            return redirect()->back()->with('status', 'Machine update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $machine=$this->machineRepository->machineDelete($id);
        if ($machine->status()==200) {
            return redirect()->back()->with('success', 'Machine deleted successfully');
        } else {
            return redirect()->back()->with('status', 'Machine deletion failed');
        }
    }
}
