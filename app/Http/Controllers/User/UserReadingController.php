<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use App\Models\Product;
use App\Models\Shift;
use App\Repositories\ReadingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserReadingController extends Controller
{
    private $readingRepository;
    public function __construct(ReadingRepository $readingRepository)
    {
        $this->readingRepository=$readingRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $readings=$this->readingRepository->getMyReadings(Auth::id());
        $filters=request()->all('search','showing','shift','machine');
        $shifts=Shift::all();
        $machines=Machine::select('name','id')->get();
        return inertia::render('user/reading/index', compact(
            'readings',
            'filters',
            'machines',
            'shifts'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $products=Product::select('id','name')->get();
        return inertia::render('user/reading/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validated=$request->validate([
            'product_id'=>'required|integer|exists:products,id',
            'shift'=>'required|integer|exists:shifts,id',
            'reading_entry'=>'required|integer',
            'reading_confirmation'=>'required|integer|same:reading_entry',
            'user_id'=>'required|integer|exists:users,id',
            'machine_id'=>'required|integer|exists:machines,id',
        ]);

        $reading=$this->readingRepository->createReading($validated);
        if($reading->status()==200){
            return redirect()->route('readings.index')->with('success','Reading added successfully');
        }else{
            return redirect()->back()->with('status','Error adding a reading');
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function markConfirmed($id){
        $reading=$this->readingRepository->markConfirmed($id);
        if($reading->status()==200){
            return redirect()->route('readings.index')->with('success','Reading confirmed successfully');
        }else{
            return redirect()->back()->with('status','Error confirming a reading');
        }
    }
}
