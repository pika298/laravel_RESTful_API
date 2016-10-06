<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Role;
use App\Permission;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::get();
        //return "test from index";
    }

    public function attachUserRole($userId, $role)
    {
        $user = User::find($userId);

        $roleId = Role::where('name', $role)->first();

        $user->roles()->attach($roleId);

        return $user;
    }

    public function getUserRole($userId)
    {
        return User::find($userId)->roles;
    }

    /**
    * add Permission to a role
    * @param Request $request
    * @return mixed
    */

    public function attachPermission(Request $request)
    {
        $parameters = $request->only('permission', 'role');

        $permissionParam = $parameters['permission'];
        $roleParam = $parameters['role'];

        $role = Role::where('name', $roleParam)->first();

        $permission = Permission::where('name', $permissionParam)->first();

        $role->attachPermission($permission);

        //return $role->permissions;
        return $this->response->created();
    }

    /**
    * Get all permissions related to the role.
    * @param $roleParam
    * @return mixed
    */
    public function getPermissions($roleParam)
    {
        $role = Role::where('name', $roleParam)->first();

       // return $role->perms;
        return $this->response->array($role->perms);
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
}
