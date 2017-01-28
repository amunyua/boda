<?php

namespace App\Http\Middleware;

use App\FirstApplication;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckForFirstApplicationApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // check if a user is logged in
        if (Auth::check()) {
            // get the logged in user(Rider)
            $user = $request->user();

            // check and ensure that it's first time login for the rider
            if (empty($user->masterfile_id)) {
                // check if first application has been approved
                $fap = FirstApplication::where('phone_no', $user->phone_no)->first();

                if ($fap->approval_status) {
                    return redirect('/second-application');
                }
            }
        }

        return $next($request);
    }
}
