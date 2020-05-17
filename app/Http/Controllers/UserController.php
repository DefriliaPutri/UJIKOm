<?php

namespace App\Http\Controllers;

use App\User;
use App\Outlet;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(function($request, $next){
            if(Gate::allows('manage-users')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
            });
           
    }
    public function index()
    {
        $users = \App\User::with('outlets')->paginate(10);
        

        return view('users.index', ['users' => $users]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlets = Outlet::orderBy('nama', 'asc')->get();

        return view("users.create", compact('outlets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $new_user = new \App\User;
            $new_user->name = $request->get('name');
            $new_user->username = $request->get('username');
            $new_user->phone = $request->get('phone');
            $new_user->roles = $request->get('roles');
            $new_user->address = $request->get('address');
            $new_user->email = $request->get('email');
            $new_user->password = \Hash::make($request->get('password'));
            if($request->file('avatar')){
            $file = $request->file('avatar')->store('avatars', 'public');
            $new_user->avatar = $file;
            }
            $new_user->save();
            $new_user->outlets()->attach($request->get('outlets'));
           
            return redirect()->route('users.create')->with('status', 'User
           successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = \App\User::findOrFail($id);

            $user->name = $request->get('name');
            $user->roles = $request->get('roles');
            $user->address = $request->get('address');
            $user->phone = $request->get('phone');

            if($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))){\Storage::delete('public/'.$user->avatar);
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
            }
            $user->save();
            $user->outlets()->sync($request->get('outlets'));
            return redirect()->route('users.index', [$id])->with('status', 'User succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);
            $user->delete();
            return redirect()->route('users.index')->with('status', 'User
            successfully delete');
    }

   
       
       
       
}
