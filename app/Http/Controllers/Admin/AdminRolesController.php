<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Enums\RoleEnum;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminRolesController extends Controller
{
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::query()
        ->with('permissions')
        ->when(request('search'), function($query){
            $query->where('name','like','%'.request('search').'%');
        })
      ->paginate(request('showing')??10);

        $filters=request()->only(['search','showing']);
        return inertia::render('admin/roles/index',compact('filters','roles'));
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
        $validated=$request->validate([
            'name'=>['required', 'string', 'max:255'],
        ]);
        DB::beginTransaction();
        try{
            Role::create(['name' => $request->name]);
            DB::commit();
            return redirect()->back()->with('success', 'Role Created Successfully');
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('status', 'Role Not Created. Try again');
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
        $validated=$request->validate([
            'name'=>['required', 'string', 'max:255'],
        ]);

        Role::findOrFail($id)->update([
            'name' => $validated['name'],
        ]);
        return redirect()->back()->with('success', 'Role Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Role::destroy($id);
            return redirect()->back()->with('success', 'Role Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('Role Not Deleted. Try again Later');
        }
    }

    public function permission(Request $request)
    {
        try {
        $role = Role::findByName($request->role);
        if($request->products){
            $role->givePermissionTo('products');
        } else{
            $role->revokePermissionTo('products');
        }
        if($request->machine){
            $role->givePermissionTo('machine');
        } else{
            $role->revokePermissionTo('machine');
        }
        if($request->shifts){
            $role->givePermissionTo('shifts');
        } else{
            $role->revokePermissionTo('shifts');
        }
        if($request->reading){
            $role->givePermissionTo('reading');
        } else{
            $role->revokePermissionTo('reading');
        }
        
        return redirect()->back()->with('success', 'Permissions Updated Successfully');
    } catch (\Exception $e) {
        dd($e);
        return redirect()->back()->with('Permissions Not Updated. Try again Later');
    }
    }

}
