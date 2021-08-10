<?php

namespace App\Http\Controllers\APIs;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Validador
use Illuminate\Support\Facades\Validator;


class AuthorizeController extends Controller
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
        $rules = [
            'name' => 'required|string|min:5|max:200',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:6|max:100',
        ];

        $validate = Validator::make($request->all(), $rules);
        if($validate->fails()) {
            return response()->json(['success'=>0,'error'=>$validate->errors()]);
        }

        try {
            $user = User::create($request->all());
            return response()->json(['success'=>1,'records'=>$user]);
        } catch (Exception $e) {
            return response()->json(['success'=>0,'error'=>$e->getMessage()],500);
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function show(AppUser $appUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function edit(AppUser $appUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppUser $appUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppUser $appUser)
    {
        //
    }
}
