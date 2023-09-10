<?php

namespace App\Http\Controllers\MachineOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Enums\RoleEnum;

class MachineOperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:'.RoleEnum::MachineOperator->value]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return inertia::render('machine-operator/index');
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
