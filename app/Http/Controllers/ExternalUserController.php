<?php

namespace App\Http\Controllers;

use App\Models\ExternalUser;
use Illuminate\Http\Request;

class ExternalUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('external_user.index', [
            'externalUsers' => ExternalUser::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('external_user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'full_name' => 'required',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $path = $request->file('profile_image')->storeAs(
            'public/external_user_logo',
            'profile_image' . '_' . time() . '.' . $request->file('profile_image')->extension()
        );

        $external_user = new ExternalUser;
        $external_user->full_name = $request->full_name;
        $external_user->contact_no = $request->contact_no;
        $external_user->profile_image = $path;
        $external_user->address = $request->address;
        if ($external_user->save()) {
            return redirect('/user');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExternalUser  $externalUser
     * @return \Illuminate\Http\Response
     */
    public function show(ExternalUser $externalUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExternalUser  $externalUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $external_user =  ExternalUser::find($id);
        return view('external_user.edit', ['external_user' => $external_user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExternalUser  $externalUser
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $external_user =  ExternalUser::find($id);
        $external_user->full_name = request()->full_name;
        $external_user->contact_no = request()->contact_no;
        $external_user->address = request()->address;
        if ($external_user->save()) {
            return redirect('/user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExternalUser  $externalUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $external_user =  ExternalUser::find($id);
        if ($external_user->delete()) {
            return redirect('/user');
        }
    }
}
