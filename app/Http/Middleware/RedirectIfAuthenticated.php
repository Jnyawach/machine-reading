<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role=Auth::user()->getRoleNames()->first();
                switch ($role) {
                    case($role==RoleEnum::Admin->value):
                        return redirect(RouteServiceProvider::ADMIN);
                        break;
                    case($role==RoleEnum::Supervisor->value):
                        return redirect(RouteServiceProvider::SUPERVISOR);
                        break;
                    case($role==RoleEnum::MachineOperator->value):
                        return redirect(RouteServiceProvider::MACHINEOPERATOR);
                        break;
                    default:
                        return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
