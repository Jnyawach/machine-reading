<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ReadingInterface;
use App\Models\Machine;
use App\Models\Product;
use App\Models\Reading;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Enums\RoleEnum;

class AdminController extends Controller
{
    private ReadingInterface $readingRepository;
    public function __construct(ReadingInterface $readingRepository)
    {
        $this->middleware(['role:'.RoleEnum::Admin->value]);
        $this->readingRepository=$readingRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users=User::count();
        $readings=Reading::count();
        $machines=Machine::count();
        $products=Product::count();
        $weeklyReadings=$this->readingRepository->getWeeklyReading();

        return inertia::render('admin/index',
            [
                'users'=>$users,
                'readings'=>$readings,
                'machines'=>$machines,
                'products'=>$products,
                'weeklyReadings'=>$weeklyReadings,
            ]);
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
