<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\admin\ChangePasswordRequest;
use App\Http\Requests\backend\admin\ChangeSettingRequest;
use App\Http\Requests\backend\admin\UpdateProfileRequest;
use App\Models\backend\Setting;
use App\Repositories\Admin\IAdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private $adminRepository;
    public function __construct(IAdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }
    public function index(){
        return view('backend.index');
    }

    public function profile(){
        $profile = Auth::user();
        return view('backend.users.profile', compact('profile'));
    }

    public function updateProfile(UpdateProfileRequest $request, $id){
        $result = $this->adminRepository->update( $id, $request->all() );
        if($result != false){
            request()->session()->flash('success','Profile successfully updated');
        } else{
            request()->session()->flash('error','Error occurred while editing profile');
        }

        return redirect()->route('profile');
    }

    public function changePassowrd(){
        return view('backend.layouts.change-password');
    }

    public function updatePassword(ChangePasswordRequest $request, $id){
        $result = $this->adminRepository->update($id, ['password' => Hash::make($request->new_password)]);

        if($result){
            request()->session()->flash('success','Password successfully updated');
        } else{
            request()->session()->flash('error','Error occurred while editing password');
        }

        return redirect()->route('change.password.form');
    }

    public function setting(){
        $setting = Setting::find(1);
        return view('backend.layouts.setting', compact('setting'));
    }

    public function settingUpdate(ChangeSettingRequest $request){
        $setting = Setting::find(1);
        $result = $setting->update($request->all());

        if($result){
            request()->session()->flash('success','Setting successfully updated');
        } else{
            request()->session()->flash('error','Error occurred while editing setting');
        }

        return redirect()->route('setting.form');

    }
}
