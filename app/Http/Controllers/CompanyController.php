<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.index', [
            'companies' => company::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
            'name' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'required',
        ]);



        $path = $request->file('logo')->storeAs(
            'public/company_logo',
            'logo_' . substr($request->name, 5) . '_' . time() . '.' . $request->file('logo')->extension()
        );

        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        // $company->logo = 'logo_' . substr($request->name, 5) .'_'.time();
        $company->logo = $path;
        $company->website = $request->website;
        if ($company->save()) {
            return view('company.edit', ['company' => $company]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return   Company::get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $company = Company::find($id);
        $company->name = request()->name;
        $company->email = request()->email;
        $company->website = request()->website;
        if ($company->save()) {
            return redirect('/company');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if ($company->delete()) {
            return redirect('/company');
        }
    }
}
