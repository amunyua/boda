<?php

use Illuminate\Database\Seeder;
use App\MessageType;

class MessageTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_types')->delete();

        $msg = new MessageType();
        $msg->message_type_name = 'Email';
        $msg->message_type_code = 'EMAIL';
        $msg->message_type_status = 1;
        $msg->save();

        $msg = new MessageType();
        $msg->message_type_name = 'SMS';
        $msg->message_type_code = 'SMS';
        $msg->message_type_status = 1;
        $msg->save();
    }
}
