<?php

namespace App\Http\Controllers;

use App\Skin;
use App\SystemConfig;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ThemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validateroutes');
    }

    public function index(){
        return view('system.theme_config');
    }

    public function saveSkin(Request $request){
        $user = Auth::user();
//        var_dump($user);exit;
        $skin_count = Skin::all()->count();
        if($skin_count){
            // update skin
            Skin::whereNotNull('id')
                ->update([
                'theme' => $request->theme,
                'done_by' => $user->masterfile_id
            ]);
            return Response::json(['success' => true]);
        }else {
            // add skin
            $skin = new Skin();
            $skin->theme = $request->theme;
            $skin->done_by = $user->masterfile_id;
            $skin->save();
            return Response::json(['success' => true]);
        }
    }

    public function getTheme(){
        $skin = Skin::whereNotNull('id')->first();
        return Response::json($skin);
    }

    public function updateSystemConfig(Request $request){
        $this->validate($request, [
            'company_name' => 'required',
            'company_logo' => 'required'
        ]);

        $system = new SystemConfig();
        $system->company_name = $request->company_name;
        $system->company_logo = $request->company_logo;
        $system->save();

        $request->session()->flash('status', 'System Configurations have been updated');
        return redirect('system-config');
    }

}
