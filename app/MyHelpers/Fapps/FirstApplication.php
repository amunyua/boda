<?php
namespace App\MyHelpers\Fapps;

use App\Masterfile;
use App\Role;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

/**
 * Created by PhpStorm.
 * User: eric
 * Date: 1/28/17
 * Time: 10:07 PM
 */
class FirstApplication
{
    const b_role = 'Client';
    const user_role = 'CLIENT';

    public static function CreateRidersMasterfile($candidate){
        try{
            $mf = new Masterfile();
            $mf->surname = $candidate->surname;
            $mf->firstname = $candidate->firstname;
            $mf->middlename = $candidate->middlename;
            $mf->registration_date = date('Y-m-d');
            $mf->b_role = self::b_role;
            $mf->user_role = self::getUserRoleByRoleCode(self::user_role)->id;
            $mf->gender = ($candidate->gender == 'Male') ? 1 : 0;
            $mf->status = 1;
            $mf->phone_no = $candidate->phone_no;
            $mf->save();

            self::createUserFromMfId($mf->id);
            return $mf->id;
        } catch (QueryException $qe){
            Log::error($qe->getMessage());
            return [
                'status' => false,
                'error' => $qe->getMessage()
            ];
        }
    }

    public static function createUserFromMfId($mf_id){
        $mf = Masterfile::find($mf_id);
        $email = \App\FirstApplication::where('phone_no', $mf->phone_no)->first()->email;

        try {
            $user = new User();
            $user->name = $mf->surname . ' ' . $mf->firstname;
            // $user->email = $mf->email;
            $user->email = $email;
            $user->password = bcrypt(123456);
            $user->status = 1;
            $user->phone_no = $mf->phone_no;
            $user->masterfile_id = $mf_id;
            $user->save();

            return $user->id;
        } catch (QueryException $qe){
            Log::error('User Creation error: '.$qe->getMessage());
            return [
                'status' => false,
                'error' => $qe->getMessage()
            ];
        }
    }

    public static function getUserRoleByRoleCode($role_code){
        $role = Role::where('role_code', $role_code)->first();
        return $role;
    }
}