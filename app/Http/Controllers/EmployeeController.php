<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.index', [
            'employees' => employee::paginate(10)
        ]);
    }

    public function show()
    {

        return employee::join('companies', 'employees.company_id', '=', 'companies.id')
            ->select('employees.*', 'companies.name as company_name')
            ->get();
    }


    public function create()
    {
        $validated = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email'
        ]);


        $employee = new employee();
        $employee->first_name = \request('first_name');
        $employee->last_name = \request('last_name');
        $employee->company_id = \request('company_id');
        $employee->phone = \request('phone');
        $employee->email = \request('email');
        $msg = $employee->save();
        if ($msg) {
            return array('id' => 1, 'message' => 'Saved Successfully');
        } else {
            return array('id' => 0, 'message' => 'Fails To Save New Employee');
        }
    }

    public function update($id)
    {
        $selected_employee = employee::findOrFail($id);
        $selected_employee->first_name = \request('first_name');
        $selected_employee->last_name = \request('last_name');
        $selected_employee->company_id = \request('company_id');
        $selected_employee->phone = \request('phone');
        $selected_employee->email = \request('email');
        $msg = $selected_employee->save();
        if ($msg) {
            return array('id' => 1, 'message' => 'Updated Successfully');
        } else {
            return array('id' => 0, 'message' => 'Fails To Update Employee');
        }
    }

    public function destroy($id)
    {
        $selected_employee = employee::findOrFail($id);
        $msg = $selected_employee->delete();
        if ($msg) {
            return array('id' => 1, 'message' => 'Deleted Successfully');
        } else {
            return array('id' => 0, 'message' => 'Fails To Delete Employee');
        }
    }
}
