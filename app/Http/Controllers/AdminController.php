<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use Image;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function adminDashboard(){

        return view('admin.index');
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }


    public function adminProfileView(){
        return view('admin.profile.profileview');
    }

    public function adminProfileEdit(){

        return view('admin.profile.profileedit');

    }

    public function adminProfileUpdate(Request $request,$id){

        $admin=User::findOrFail($id);


        $old_photo=$admin->photo;

        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required','email',Rule::unique('users')->ignore($request->id)],
            'photo' => ['mimes:jpg,bmp,png'],


        
        ]);

       

        if($request->file('photo')){
            @unlink($old_photo);

            $image=$request->photo;
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(300,300)->save('upload/admin_images/'.$name_gen);
            $save_url = 'upload/admin_images/'.$name_gen;
          
            $admin->name=$request->name;
            $admin->email=$request->email;
$admin->photo=$save_url;
            $admin->save();

            $notification = array(
                'message' => 'Admin Profile Updated Successfully',
                'alert-type' => 'info'
             );
            
             return redirect()->route('admin.dashboard')->with($notification);

        }

        else{

            $admin->name=$request->name;
            $admin->email=$request->email;

            $admin->save();

            $notification = array(
                'message' => 'Admin Profile Updated Successfully',
                'alert-type' => 'info'
             );
            
             return redirect()->route('admin.dashboard')->with($notification);
        }
        
        

        
    }

    public function adminPasswordChange(){
        return view('admin.profile.changepassword');
    }


    public function adminPasswordupdate(Request $request): RedirectResponse
    {
        $validated = $request->validate( [
            'current_password' => ['required', 'current_password'],
            'password' => ['required',  'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'warning'
         );
        
         return redirect()->route('admin.dashboard')->with($notification);
    }
}
