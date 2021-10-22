<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Upload\FileuploadTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class FrontendController extends Controller
{
    use FileuploadTrait;

    public function index()
    {
        return view('welcome');
    }

    //Donor registration
    public function registration(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|unique:users',
            'phone' => 'required|max:11|unique:users',
            'blood_group' => 'required',
            'avatar' => 'required|image',
            'gender' => 'required',
            'password' => 'required|min:8|max:12|confirmed',
        ]);

        try {
            $avatar = $request->avatar;
            $filePathFrontal = $this->UserAvatarUpload($avatar); //Passing $frontal as parameter to our created method

            $user = new User();
            $user->name = $request->name;
            $user->slug = str_replace(' ', '-', strtolower($request->name));
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->blood_group = $request->blood_group;
            $user->gender = $request->gender;
            if ($request->avatar){
                $user->avatar = $filePathFrontal;
            }
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json($user, 200);
        }catch (\Exception $exception){
            return response()->json([
                'status' => false,
                'error'  => $exception->getMessage()
            ], 401);
        }
    }

    public function blood_donors(Request $request)
    {
        $search_data = User::where('blood_group', 'LIKE','%'.$request->search.'%')->take(10)->get();
        return response()->json([
            'status' => true,
            'data' => $search_data
        ]);
    }

    public function blood_donor_details($id)
    {
        $donor_details = User::find($id);
        return response()->json($donor_details, 200);
    }
}
