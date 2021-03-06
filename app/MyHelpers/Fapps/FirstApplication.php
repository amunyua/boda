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

    /**
     * Creates a Masterfile on First application's approval as well
     * as updates the masterfile id on the rider's user login account
     * @param $candidate
     * @return array|mixed
     */
    public static function CreateRidersMasterfile($candidate){
        // check if masterfile exists and update it
        $mf_item = Masterfile::where('phone_no', $candidate->phone_no);
        $mf_exists = $mf_item->count();
        if($mf_exists){
            $mf_item->update(['status' => 1]);

            // activate login account
            User::where('phone_no', $candidate->phone_no)
                ->update(['status' => 1]);

            return true;
        } else {
            try {
                $mf = new Masterfile();
                $mf->surname = $candidate->surname;
                $mf->firstname = $candidate->firstname;
                $mf->middlename = $candidate->middlename;
                $mf->registration_date = date('Y-m-d');
                $mf->b_role = self::b_role;
                $mf->user_role = Role::userRole(self::user_role)->id;
                $mf->gender = ($candidate->gender == 'Male') ? 1 : 0;
                $mf->status = 1;
                $mf->phone_no = $candidate->phone_no;
                $mf->save();

                User::where('phone_no', $candidate->phone_no)
                    ->update([
                        'masterfile_id' => $mf->id
                    ]);

                return $mf->id;
            } catch (QueryException $qe) {
                return false;
                //            return [
                //                'status' => false,
                //                'error' => $qe->getMessage()
                //            ];
            }
        }
    }

    /**
     * Creates a new User Login account from a created Masterfile
     * @param $mf_id
     * @return array|mixed
     */
    public static function createUserFromMfId($mf_id){
        $mf = Masterfile::find($mf_id);
//        $email = \App\FirstApplication::where('phone_no', $mf->phone_no)->first()->email;

        try {
            $user = new User();
            $user->name = $mf->surname . ' ' . $mf->firstname;
             $user->email = $mf->email;
//            $user->email = $email;
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
}