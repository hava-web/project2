<?php

namespace App\Http\Controllers\Frontend;


use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $customer = Customer::where('user_id',Auth::user()->id)->first();
        return view('frontend.profile.index',compact('customer'));
    }

    public function updateUserDetails(UpdateUserRequest $request)
    {
        $user = Customer::where('user_id',Auth::user()->id)->first();
        $user->update([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('message','Profile Updated Successfully');
    }

    public function passwordCreate()
    {
        return view('frontend.profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','Password Updated Successfully');

        }else{

            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }
    
}
