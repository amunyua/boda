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
        $is_logged_in = Auth::check();
        if ($is_logged_in) {
            // get the logged in user(Rider)
            $user = Auth::user();

            // ensure it's a rider
            if(!empty($user->first_application_id)) {
                // check and ensure that it's first application was approved
                if (empty($user->masterfile_id)) {
                    // check if first application has been approved
                    $fap = FirstApplication::where('email', $user->email)->first();

                    if ($fap->approval_status) {
                        // load the second application form for the user
                        return redirect('/second-application');
                    } else {
                        return redirect('unapproved-application');
                    }
                }
            }
            return $next($request);
        }

        return $next($request);
    }
}