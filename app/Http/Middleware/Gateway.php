<?php

namespace App\Http\Middleware;

use Closure;

class Gateway
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $must_be
     * @return mixed
     */
    public function handle($request, Closure $next,$must_be)
    {
        $level = session()->get("level");
        if ($level === null){
            $level = -1;
        }
        $for_level = explode("|",$must_be);
        if (!in_array($level,$for_level)){
            return redirect(config("vmedis.redirect_unauthorized"))->withErrors(["msg"=>"Unauthorized User"]);
        }
        return $next($request);
    }
}
