<?php

namespace Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dashboard\Http\Controllers\Controller;
use Dashboard\User;
use Auth;
class ProfileController extends Controller
{
    public function index()
    {
      $role_id = Auth::user()-> role_id;
      if($role_id == 1){
        $users = DB::table('users')
        ->join('roles','users.role_id','=','roles.id')
        ->selectRaw('users.*,roles.name as role_name')
        ->get();
        return view('profile.index',compact('users'));
      }
      else{
        $user_id = Auth::user()-> id;
        return redirect('/profile/'.$user_id.'/edit');
      }
    }
    public function create()
    {
      $role_id = Auth::user()-> role_id;
      if( $role_id == 1){
      $roles = DB::table('roles')->get();
      return view('profile.create',compact('roles'));
      }else{
        return redirect('/profile')->with('error', 'You have no permission to create other accounts.');
      }
    }
    public function store(Request $request)
    {
      $this->validate($request, [
          'name' => 'required',
          'password' => 'required',
          'email'=>'required',
          'role_id' => 'required',
      ]);
      $user_id = Auth::user()-> id;
      $role_id = Auth::user()-> role_id;
      $now = date("Y-m-d H:i:s");
      if( $role_id == 1){
          DB::table('users')
            ->insertGetId([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'email'=> $request->input('email'),
            'role_id' => $request->get('role_id'),
            'active' => 1,
            'created_at'=> $now,
            'updated_at'=> $now,
          ]);
          return redirect('/profile')->with('success', 'Profile Created');
        }else{
          return redirect('/profile')->with('error', 'You have no permission to create other accounts.');
        }
    }
    public function show($id)
    {
      $user_id = Auth::user()-> id;
      return redirect('/profile/'.$user_id.'/edit');
    }
    public function edit($id)
    {
      $user_id = Auth::user()-> id;
      $role_id = Auth::user()-> role_id;
      if($id == $user_id || $role_id == 1){
        $roles = DB::table('roles')->get();
        $user = DB::table('users')->where('id',$id)->get();
        return view('profile.edit',compact('roles','user'));
      }else{
        return redirect('/profile')->with('error', 'You have no permission to edit other accounts.');
      }
    }
     public function update(Request $request, $id)
   {
       $this->validate($request, [
           'name' => 'required',
           'password' => 'required',
           'role_id' => 'required',
       ]);
       $user_id = Auth::user()-> id;
       $role_id = Auth::user()-> role_id;
       if($id == $user_id || $role_id == 1){
         DB::table('users')
              ->where('id', $id)
              ->update([
                'name' => $request->input('name'),
                'password' => bcrypt($request->input('password')),
                'role_id' => $request->get('role_id'),
            ]);
         return redirect('/profile')->with('success', 'Profile Updated');
       }else{
         return redirect('/profile')->with('error', 'You have no permission to update other accounts.');
       }
   }
    public function destroy($id)
    {
      $user = User::find($id);
      $role_id = Auth::user()-> role_id;
      if($role_id == 1){
        $user->delete();
        return redirect('/profile')->with('success', 'Account Delete');
      }
      return redirect('/profile')->with('error', 'You have no permission to delete other accounts.');
    }
}
