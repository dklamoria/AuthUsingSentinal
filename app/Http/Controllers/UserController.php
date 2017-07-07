<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Input;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function register(Request $request)
    {

        /*$credentials = [
        'email'    => 'deepakkumar@gmail.com',
        'password' => '12345678',
        ];

        //return Sentinel::register($credentials,true);

        //return Sentinel::authenticate($credentials);*/

        if ($user = Sentinel::check())
            {
                return "Welcome ".$user['first_name']." ".$user['last_name']."  ".$user['email']; 
            }
        else
            {
                return "PLEASE LOGIN FIRST!";
            }

        /*if ($user = Sentinel::register(Input::all()))
            {
              //return Redirect::home()->withSuccess('Registration complete.');
               return "sucessfull";
            }

        return Redirect::back()->withInput()->withErrors('An error occured while registering.');

        if ($auth = Sentinel::authenticate(Input::all()))
        {
            return Redirect::intended();
        }

        return Redirect::back()
            ->withInput()
            ->withErrors('Invalid login or password.');
        }
        
        $user = Sentinel::findById(2);

        Sentinel::login($user);
        //Sentinel::logout();*/


    }

    public function assignRole()
    {
        $role = Sentinel::findRoleBySlug('admins');

        $user = Sentinel::getUser();

        $user->roles()->attach($role);

        return Redirect::back()
            ->withSuccess('Role attached successfully.');
    }

    public function addPermission()
    {  
        /*
        $permission = Input::get('permissions');

        $role = Sentinel::findRoleBySlug('admins');

        $role->addPermission($permission);
        $role->save();

        return Redirect::back()->withSuccess('Permission added successfully.');*/

        $role = Sentinel::findRoleById(2);

        $role->permissions = [
            'user.update' => true,
            'user.view' => true,
            'user.create' => true,
            'user.delete' => true,
            ];

        $role->save();
    }

    public function delete()
    {   
        $user = Sentinel::check();
        if ($user->hasAccess('user.delete'))
        {
            $user = Sentinel::findById(9);

            $user->delete();

            return "yOU DELETE DONE!";
        }
        else {
            return "You have no admistrative rights!";
        }
    }
}