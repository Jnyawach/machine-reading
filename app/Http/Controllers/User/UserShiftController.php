<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\ShiftRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Enums\RoleEnum;

class UserShiftController extends Controller
{
    private $shiftRepository;
    public function __construct(ShiftRepository $shiftRepository)
    {
        $this->shiftRepository=$shiftRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $shifts=$this->shiftRepository->getShift();
       $filters=request()->all('search','showing');
        return inertia::render('user/shifts/index', compact('shifts','filters'));
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
            'start_time'=>'required|string|max:125',
            'end_time'=>'required|string|max:125'
        ]);
        $shift=$this->shiftRepository->createShift($validated);
        if ($shift->status()==200){
            return redirect()->back()->with('success','Shift created successfully');
        }else{
            return redirect()->back()->with('status','Shift creation failed');
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
            'start_time'=>'required|string|max:125',
            'end_time'=>'required|string|max:125'
        ]);
       $shift=$this->shiftRepository->updateShift($validated,$id);
       if ($shift->status()==200){
           return redirect()->back()->with('success','Shift updated successfully');
       }else{
           return redirect()->back()->with('status','Shift update failed');
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $shift=$this->shiftRepository->deleteShift($id);
        if ($shift->status()==200) {
            return redirect()->back()->with('success', 'Shift deleted successfully');
        }else{
            return redirect()->back()->with('status', 'Shift deletion failed');
        }
    }
}
