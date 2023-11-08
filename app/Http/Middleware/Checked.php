<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Checked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
    protected function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password'=>$request->password,
            'status' => 'مفعل'];
    }
}
