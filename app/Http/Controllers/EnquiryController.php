<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\Customer;
use Auth;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Enquiry::get();
        return view('enquiry.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('enquiry.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // print_r($request->Input());

        if(Customer::where('email',$request->email)->exists()){
            return redirect()->back()->withInput()->with('message','A Customer with same Email Address already exists');
        }

        $enq = Enquiry::all();


        $save = Enquiry::create([
            'enquiry_no' => 'ENQPW'.sizeof($enq)+1,
            'customer_type' => $request->customer_type,
            'customer_name' => $request->customer_name,
            'company_name' => $request->company_name,
            'salutaion' => $request->salutaion,
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'date' => $request->date,
            'details' => $request->details,
            'user_id' => Auth::user()->id,
            'status' => 'Created'
        ]);

        if($save){
            return redirect()->route('enquiry')->with('message','Created Successfully - Enquiry No: ENQPW'.sizeof($enq)+1);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Enquiry::where('id',$id)->first();

        return view('enquiry.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Enquiry::where('id',$id)->first();

        $update = Enquiry::where('id',$id)->update([
            'customer_type' => $request->customer_type,
            'customer_name' => $request->customer_name,
            'company_name' => $request->company_name,
            'salutaion' => $request->salutaion,
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'date' => $request->date,
            'details' => $request->details,
        ]); 

        if($update){
            return redirect()->back()->with('message','Updated Succesfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
