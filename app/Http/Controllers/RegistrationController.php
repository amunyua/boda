<?php

namespace App\Http\Controllers;

use App\Mail\FirstApplicationConfirmation;
use App\Masterfile;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    const ClientAdmin = 'CLIENTADMIN';

    public function index() {
        return view('register.index');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'surname' => 'required',
            'email' => 'required|unique:users',
            'phone_no' => 'required|unique:masterfiles',
            'password' => 'required|confirmed'
        ]);

        $client_admin = Role::userRole(self::ClientAdmin);

        DB::transaction(function() use($request, $client_admin) {
            // create mf
            $mf = Masterfile::create([
                'surname' => $request->surname,
                'firstname' => $request->fname,
                'middlename' => $request->lname,
                'registration_date' => date('Y-m-d'),
                'b_role' => 'Client Admin',
                'user_role' => $client_admin->id,
                'status' => 1,
                'phone_no' => $request->phone_no
            ]);

            // create login account
            $user = User::create([
                'name' => $request->surname . ' ' . $request->firstname,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone_no' => $request->phone_no,
                'masterfile_id' => $mf->id,
                'confirmation_token' => str_random(30),
            ]);

            // assing a user role
            $user->roles()->attach($client_admin);

            // send a confirmation email to the client
//            Mail::to($user)
//                ->queue(new FirstApplicationConfirmation($user, ''));
        });



        $request->session()->flash('status', 'You have been registered. A confirmation email has been sent to: '. $request->email .'.');
        return redirect('login');
    }
}
