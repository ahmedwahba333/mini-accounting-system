<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRules;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $title = 'add to archive!';
        $text = "Are you sure you want to archive customer?";
        confirmDelete($title, $text);
        return view('customers.index', compact('customers'));
    }
    public function create()
    {
        return view('customers.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, ValidationRules::rulesCustomer());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $customers = Customer::create([
            'name' => $request->input('name'),
            'company' => $request->input('company'),
            'cPerson' => $request->input('cPerson'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'posCode' => $request->input('posCode'),
            'country' => $request->input('country'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
        ]);
        Alert::success($customers["name"], 'has been added');
        return redirect('/customers');
    }
    public function delete($id)
    {
        $customers = Customer::withTrashed()->find($id);
        $customers->delete();
        return redirect('/customers');
    }
    public function deletedCustomers()
    {
        $allCustomers = Customer::withTrashed()->get();
        $title = 'Delete Customer!';
        $text = "Are you sure you want to delete it?";
        confirmDelete($title, $text);
        return view('customers.deletedCustomers', compact('allCustomers'));
    }

    public function deleteForce($id)
    {
        $customers = Customer::withTrashed()->find($id);
        $customers->forceDelete();
        return redirect('/customers/deletedCustomers');
    }
    public function deletedFilter(Request $request)
    {
        if ($request->input('deletedFilter') == 'deleted') {
            $allCustomers = Customer::onlyTrashed()->get();
            return view('customers.deletedCustomers', compact('allCustomers'));
        } else if ($request->input('deletedFilter') == 'notDeleted') {
            $allCustomers = Customer::withoutTrashed()->get();
            return view('customers.deletedCustomers', compact('allCustomers'));
        }
    }


    public function edit($id)
    {
        $customer = Customer::withTrashed()->find($id);
        return view('customers.edit', compact('customer'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, ValidationRules::rulesCustomer());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $customers = Customer::withTrashed()->find($id);
        $customers->name = $request['name'];
        $customers->email = $request['email'];
        $customers->phone_number = $request['phone_number'];
        $customers->company = $request['company'];
        $customers->cPerson = $request['cPerson'];
        $customers->address = $request['address'];
        $customers->country = $request['country'];
        $customers->city = $request['city'];
        $customers->state = $request['state'];
        $customers->posCode = $request['posCode'];
        $customers->update();
        Alert::success($request['name'], 'has been updated');
        return redirect('/customers');
    }
    public function restore($id)
    {
        $customers = Customer::withTrashed()->find($id);
        $customers->restore();
        Alert::success($customers["name"], 'has been Restored');
        return redirect('/customers');
    }
}
