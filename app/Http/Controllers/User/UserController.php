<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistration;
use Session;

class UserController extends Controller
{
    public function store(Request $request){
    	//dd($request->all());
    	$u = User::all();
    	$role = "User";
    	if(isset($u) && sizeof($u) == 0){
    	//	dd('ds');
    		$role = "Admin";
    	}

    	//dd($role);
    	$imageName = "";
        if($request->file('file')){
        	$file = $request->file('file');
        	//dd($file->getClientOriginalExtension());
            $imageName = time().'.'.$file->getClientOriginalExtension();  
            $file->move(public_path('/otfcoader/'), $imageName);  
        }
    	$user = User::create([
    		'name'=>$request->name,
    		'l_name'=>$request->l_name,
    		'phone'=>$request->phone,
    		'email'=>$request->email,
    		'password'=>bcrypt($request->password),
            'original_password'=>$request->password,
    		'image'=>$imageName,
    		'role'=>$role,
    	]);
    	//dd($user);
    	if($user){
    		Mail::to($request->email)->send(new UserRegistration($user));
    		Session::flash('message', "Profile has been created sucessfully!!!");
    		return response()->json(['status'=>1, 'message'=>'User has been registered successfully!!!']);
    	}else{
    		return response()->json(['status'=>0, 'message'=>'Something went wrong']);
    	}
    }


    public function edit(Request $request, $id){
    	$user = User::find($id);
    	return view('auth.edit',compact('user'));
    }

    public function update(Request $request,$id){
    	
    	User::where('id',$id)->update([
    		'name'=>$request->name,
    		'l_name'=>$request->l_name,
    		'phone'=>$request->phone,
    		'email'=>$request->email,
    	]);
    	Session::flash('message', "Profile has been updated sucessfully!!!");
    	return response()->json(['status'=>1, 'message'=>'User has been Updated successfully!!!']);
    }

    public function userList(Request $request){
    	$user = User::where('id','!=',1)->get();
    	return view('userlist',compact('user'));
    }
}
