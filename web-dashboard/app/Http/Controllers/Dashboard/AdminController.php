<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function index() 
    {
        $user = Auth::user();

        return view('pages.profile', compact('user'));
    }

    // update profile
    public function update(Request $request, $id)
    {
        $rules = array(
            'name'      => 'string',
            'email'     => 'email',
        );
        $error = Validator::make(request()->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $adminUser = User::findOrFail($id);

        $adminUser->name = $request->name;
        $adminUser->email = $request->email;
        $adminUser->update();

        return response()->json([
            'success' => 'Superadmin Edited Successfully',
        ]);
    }

    public function resetPassword(Request $request)
    {
        $rules = array(
            'password'     => 'required|confirmed',
        );
        $error = Validator::make(request()->all(), $rules);
        if ($error->fails()) {
            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }
        $user = User::findOrFail($request->user_id);

        $password = $request->password;
        $user->password =  Hash::make($password);
        $user->update();

        return response()->json([
            'success' => 'Password Edited Successfully',
        ]);
    }

    
}
