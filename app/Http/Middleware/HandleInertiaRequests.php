<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $auth=null;
        if (Auth::check()){
            $auth=[
                'name'=>Auth::user()->name,
                'id'=>Auth::id(),
                'email'=>Auth::user()->email,
                'role'=>Auth::user()->getRoleNames()->first(),
                'permissions'=>Auth::user()->getAllPermissions()->pluck('name')
            ];
        }

        return array_merge(parent::share($request), [
            //
            'auth' =>$auth,
            'status' => $request->session()->get('status')?$request->session()->get('status'):null,
            'success' => $request->session()->get('success')?$request->session()->get('success'):null,
        ]);
    }
}
