<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles) {
    if (!Auth::check())
      return redirect('/login');
    $user = Auth::user();
    // check each role to see if the user is allowed
    foreach($roles as $role) {

        if($user->role->value == $role) {
            return $next($request);
        }
    }

    //user unauthorized
    //return abort('/admin/dashboard');
    return abort(401,'Unauthorized');
  }
}
