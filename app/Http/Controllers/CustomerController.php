<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\Address;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteProduct;
use App\Models\PerformaInvoice;
use App\Models\Invoice;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::get();
       return view('customer.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = ["Andhra Pradesh","Arunachal Pradesh","Assam","Bihar","Chhattisgarh","Goa","Gujarat","Haryana","Himachal Pradesh","Jharkhand","Karnataka","Kerala","Maharashtra","Madhya Pradesh","Manipur","Meghalaya","Mizoram","Nagaland","Odisha","Punjab","Rajasthan","Sikkim","Tamil Nadu","Tripura","Telangana","Uttar Pradesh","Uttarakhand","West Bengal","Andaman & Nicobar (UT)","Chandigarh (UT)","Dadra & Nagar Haveli and Daman & Diu (UT)","Delhi [National Capital Territory (NCT)]","Jammu & Kashmir (UT)","Ladakh (UT)","Lakshadweep (UT)","Puducherry (UT)"];

        return view('customer.create',compact('states'));
    }

    public function create_from_enquiry($id)
    {
       // print_r($id);

        $data = Enquiry::where('id',$id)->first();

        $states = ["Andhra Pradesh","Arunachal Pradesh","Assam","Bihar","Chhattisgarh","Goa","Gujarat","Haryana","Himachal Pradesh","Jharkhand","Karnataka","Kerala","Maharashtra","Madhya Pradesh","Manipur","Meghalaya","Mizoram","Nagaland","Odisha","Punjab","Rajasthan","Sikkim","Tamil Nadu","Tripura","Telangana","Uttar Pradesh","Uttarakhand","West Bengal","Andaman & Nicobar (UT)","Chandigarh (UT)","Dadra & Nagar Haveli and Daman & Diu (UT)","Delhi [National Capital Territory (NCT)]","Jammu & Kashmir (UT)","Ladakh (UT)","Lakshadweep (UT)","Puducherry (UT)"];

        return view('customer.create_from_enquiry',compact('data','states'));
    }

    public function save_from_enquiry(Request $request , $enquiryid){
       // print_r(json_encode($request->input()));
      //  print_r($enquiryid); die();


        if(Customer::where('gst',$request->gstin)->exists()){
            return redirect()->back()->withInput()->with('message','Customer with same GSTIN already exists');
        }
      
        else{
            $customers = Customer::all();
            $enquiry = Enquiry::where('id',$enquiryid)->first();
            $save = Customer::create([
                'customer_no' => 'CUSTPW'.sizeof($customers)+1,
                'customer_type' => $enquiry->customer_type,
                'company_name' => $enquiry->company_name,
                'salutaion' => $enquiry->salutaion,
                'first_name' => $enquiry->first_name,
                'last_name' => $enquiry->last_name,
                'email' => $enquiry->email,
                'mobile' => $enquiry->mobile,
                'gst' => $request->gstin,
                'treatment' => $request->treatment,
                'pan' => $request->pan,
                'payment' => $request->payment,
                'supply' => $request->supply,
                'user_id'=> Auth::user()->id,
                'enquiry_id' => $enquiryid,
                'status' => 'Active'
            ]);

            if($save){
                $updateenquiry = Enquiry::where('id',$enquiryid)->update(['status' => 'Converted']);
                $cust = Customer::where('gst',$request->gstin)->first();

                foreach ($request->b_add1 as $index => $bAdd1) {
                   Address::create([
                        'customer_id' => $cust->id,
                        'billing_address_line_1' => $bAdd1,
                        'billing_address_line_2' => $request->b_add2[$index] ?? null,
                        'billing_city' => $request->b_city[$index],
                        'billing_state' => $request->b_state[$index],
                        'billing_pincode' => $request->b_pincode[$index],
                        'shipping_address_line_1' => $request->s_add1[$index] ?? null,
                        'shipping_address_line_2' => $request->s_add2[$index] ?? null,
                        'shipping_city' => $request->s_city[$index] ?? null,
                        'shipping_state' => $request->s_state[$index] ?? null,
                        'shipping_pincode' => $request->s_pincode[$index] ?? null,
                        'user_id' => Auth::user()->id
                    ]);
                }
            }
          
          return redirect()->route('customers')->with('message','Customer Created Successfully . Customer ID : '.'CUSTPW'.sizeof($customers)+1);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // print_r($request->input());

        if(Customer::where('gst',$request->gstin)->exists()){
            return redirect()->back()->withInput()->with('message','Customer with same GSTIN already exists');
        }
      
        else{
            $customers = Customer::all();
            $save = Customer::create([
                'customer_no' => 'CUSTPW'.sizeof($customers)+1,
                'customer_type' => $request->customer_type,
                'company_name' => $request->company_name,
                'salutaion' => $request->salutaion,
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'gst' => $request->gstin,
                'treatment' => $request->treatment,
                'pan' => $request->pan,
                'payment' => $request->payment,
                'supply' => $request->supply,
                'user_id'=> Auth::user()->id,
                'status' => 'Active'
            ]);

            if($save){
                $cust = Customer::where('gst',$request->gstin)->first();

                foreach ($request->b_add1 as $index => $bAdd1) {
                   Address::create([
                        'customer_id' => $cust->id,
                        'billing_address_line_1' => $bAdd1,
                        'billing_address_line_2' => $request->b_add2[$index] ?? null,
                        'billing_city' => $request->b_city[$index],
                        'billing_state' => $request->b_state[$index],
                        'billing_pincode' => $request->b_pincode[$index],
                        'shipping_address_line_1' => $request->s_add1[$index] ?? null,
                        'shipping_address_line_2' => $request->s_add2[$index] ?? null,
                        'shipping_city' => $request->s_city[$index] ?? null,
                        'shipping_state' => $request->s_state[$index] ?? null,
                        'shipping_pincode' => $request->s_pincode[$index] ?? null,
                        'user_id' => Auth::user()->id
                    ]);
                }
            }
          
          return redirect()->route('customers')->with('message','Customer Created Successfully . Customer ID : '.'CUSTPW'.sizeof($customers)+1);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Customer::with('addresses')->where('id',$id)->first();

        return view('customer.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Customer::with('addresses')->where('id',$id)->first();

        $states = ["Andhra Pradesh","Arunachal Pradesh","Assam","Bihar","Chhattisgarh","Goa","Gujarat","Haryana","Himachal Pradesh","Jharkhand","Karnataka","Kerala","Maharashtra","Madhya Pradesh","Manipur","Meghalaya","Mizoram","Nagaland","Odisha","Punjab","Rajasthan","Sikkim","Tamil Nadu","Tripura","Telangana","Uttar Pradesh","Uttarakhand","West Bengal","Andaman & Nicobar (UT)","Chandigarh (UT)","Dadra & Nagar Haveli and Daman & Diu (UT)","Delhi [National Capital Territory (NCT)]","Jammu & Kashmir (UT)","Ladakh (UT)","Lakshadweep (UT)","Puducherry (UT)"];

        return view('customer.edit',compact('data','states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $customerid)
    {
       // print_r(json_encode($request->input())); print_r($customerid); die();

        
        if($request->enquiry_id == ''){
             $update = Customer::where('id',$customerid)->update([
                'customer_type' => $request->customer_type,
                'company_name' => $request->company_name,
                'salutaion' => $request->salutaion,
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'gst' => $request->gstin,
                'treatment' => $request->treatment,
                'pan' => $request->pan,
                'payment' => $request->payment,
                'supply' => $request->supply,
           ]);
        }
        else{
           
            $update = Customer::where('id',$customerid)->update([
                'gst' => $request->gstin,
                'treatment' => $request->treatment,
                'pan' => $request->pan,
                'payment' => $request->payment,
                'supply' => $request->supply,
            ]);
        }


        

        if($update){

            $dbaddress = Address::where('customer_id',$customerid)->get();

            foreach ($dbaddress as $key => $value) {
                $dbids[]=$value->id;
            }
           
            foreach ($request->b_add1 as $index => $bAdd1) {
               $updatedid[]=$request->address_id[$index];
               if(isset($request->address_id[$index]) && Address::where('customer_id',$customerid)->where('id',$request->address_id)->exists()){
                
                 Address::where('id',$request->address_id[$index])->update([
                    'billing_address_line_1' => $bAdd1,
                    'billing_address_line_2' => $request->b_add2[$index] ?? null,
                    'billing_city' => $request->b_city[$index],
                    'billing_state' => $request->b_state[$index],
                    'billing_pincode' => $request->b_pincode[$index],
                    'shipping_address_line_1' => $request->s_add1[$index] ?? null,
                    'shipping_address_line_2' => $request->s_add2[$index] ?? null,
                    'shipping_city' => $request->s_city[$index] ?? null,
                    'shipping_state' => $request->s_state[$index] ?? null,
                    'shipping_pincode' => $request->s_pincode[$index] ?? null,
                    'user_id' => Auth::user()->id
                ]);

               }
               else{
                 Address::create([
                        'customer_id' => $customerid,
                        'billing_address_line_1' => $bAdd1,
                        'billing_address_line_2' => $request->b_add2[$index] ?? null,
                        'billing_city' => $request->b_city[$index],
                        'billing_state' => $request->b_state[$index],
                        'billing_pincode' => $request->b_pincode[$index],
                        'shipping_address_line_1' => $request->s_add1[$index] ?? null,
                        'shipping_address_line_2' => $request->s_add2[$index] ?? null,
                        'shipping_city' => $request->s_city[$index] ?? null,
                        'shipping_state' => $request->s_state[$index] ?? null,
                        'shipping_pincode' => $request->s_pincode[$index] ?? null,
                        'user_id' => Auth::user()->id
                    ]);
               }
             
            }

            $deletedIds = array_diff($dbids, $updatedid);
            if(sizeof($deletedIds) > 0){
                $deleteAddress = Address::whereIn('id',$deletedIds)->delete();
            }
            
        }

        return redirect()->back()->with('message','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function create_quote($id)
    {
        $data = Customer::where('id',$id)->first();
        $products = Product::get();
        return view('quote.create',compact('data','products'));
    }

    public function save_quote(Request $request, $id){

       // print_r(json_encode($request->input()));die();

        $cust_data = Customer::where('id',$id)->first();



        $request->validate([
            'items' => 'required|array|min:1',
            'qty' => 'required|array|min:1',
            'rate' => 'required|array|min:1',
            'tax' => 'required|array|min:1',
            'amount' => 'required|array|min:1',
            'items.*' => 'required|string', // Ensure each item is selected
            'qty.*' => 'required|numeric|min:1', // Quantity must be a number >= 1
            'rate.*' => 'required|numeric|min:0', // Rate must be a number >= 0
            'tax.*' => 'required|numeric|min:0', // Tax must be a number >= 0
            'amount.*' => 'required|numeric|min:0', // Amount must be a number >= 0
        ]);

        // Get the data from the request
        $items = $request->input('items');
        $quantities = $request->input('qty');
        $rates = $request->input('rate');
        $taxes = $request->input('tax');
        $amounts = $request->input('amount');


        $quote = new Quote;
        $quote->customer_id = $id;
        $quote->billing_address = $request->billingaddress;
        $quote->shipping_address = $request->shippingaddress ;
        $quote->quote_number = $request->quote_no;
        $quote->quote_date = $request->quote_date;
        $quote->expiry_date = $request->quote_expiry;
        $quote->sub_total = $request->subtotal;
        $quote->discount_percentage = $request->discount;
        $quote->discount_amount = $request->discounted_amount;
        $quote->adjustment = $request->adjustment;
        $quote->grant_total = $request->finalTotal;
        $quote->customer_note = $request->note;
        $quote->terms = $request->tc;
        $quote->status = $request->btn_name;
        $quote->user_id = Auth::user()->id;

        $quote->save();

        $quoteID=$quote->id;

 // Loop through the data and save each row
        foreach ($items as $index => $item) {
           QuoteProduct::create([
                'quote_id' => $quoteID,
                'product_id' => $item,
                'revised_price' => $rates[$index],
                'quantity' => $quantities[$index],
                'tax' => $taxes[$index],
                'amount' => $amounts[$index],
            ]);
        }
        
        return redirect()->route('view_quote');

    }


    public function view_quote(){
        $data = Quote::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        
        return view('quote.list',compact('data'));

    }

    public function view_quote_details($id){
        $quoteData = Quote::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $data = Customer::where('id',$quoteData->customer_id)->first();
        $products = Product::get();
        return view('quote.details',compact('data','quoteData','products'));

    }

    public function edit_quote($id){
        $quoteData = Quote::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $data = Customer::where('id',$quoteData->customer_id)->first();
        $products = Product::get();
        return view('quote.edit',compact('data','quoteData','products'));
    }

    public function update_quote(Request $request , $id){

      //  print_r(json_encode($request->input()));die();
        
        $cust_data = Customer::where('id',$request->customer_id)->first();

        $request->validate([
            'items' => 'required|array|min:1',
            'qty' => 'required|array|min:1',
            'rate' => 'required|array|min:1',
            'tax' => 'required|array|min:1',
            'amount' => 'required|array|min:1',
            'items.*' => 'required|string', // Ensure each item is selected
            'qty.*' => 'required|numeric|min:1', // Quantity must be a number >= 1
            'rate.*' => 'required|numeric|min:0', // Rate must be a number >= 0
            'tax.*' => 'required|numeric|min:0', // Tax must be a number >= 0
            'amount.*' => 'required|numeric|min:0', // Amount must be a number >= 0
        ]);

        // Get the data from the request
        $items = $request->input('items');
        $quantities = $request->input('qty');
        $rates = $request->input('rate');
        $taxes = $request->input('tax');
        $amounts = $request->input('amount');
        $quote_prod_id = $request->input('quote_prod_id');


        $quote = Quote::where('id',$id)->first();
        $quote->billing_address = $request->billingaddress;
        $quote->shipping_address = $request->shippingaddress ;
        $quote->sub_total = $request->subtotal;
        $quote->discount_percentage = $request->discount;
        $quote->discount_amount = $request->discounted_amount;
        $quote->adjustment = $request->adjustment;
        $quote->grant_total = $request->finalTotal;
        $quote->customer_note = $request->note;
        $quote->terms = $request->tc;
        $quote->status = $request->btn_name;
        $quote->user_id = Auth::user()->id;

        $quote->save();
         
         QuoteProduct::where('quote_id',$id)->whereNotIn('id',$quote_prod_id)->delete();
         
       
 // Loop through the data and save each row
        foreach ($items as $index => $item) {
          

          $QuotProdutc = QuoteProduct::where('id',$quote_prod_id[$index] ?? null)->first();

          if($QuotProdutc){
             $QuotProdutc->product_id = $item;
             $QuotProdutc->revised_price = $rates[$index];
             $QuotProdutc->quantity = $quantities[$index];
             $QuotProdutc->tax = $taxes[$index];
             $QuotProdutc->amount = $amounts[$index];
             $QuotProdutc->save();
          }
          else{
            QuoteProduct::create([
                'quote_id' => $id,
                'product_id' => $item,
                'revised_price' => $rates[$index],
                'quantity' => $quantities[$index],
                'tax' => $taxes[$index],
                'amount' => $amounts[$index],
            ]);
          }



           
        }
        
        return redirect()->route('view_quote_details',$id);
    }

    public function convert_to_pi($id){

        $data = Quote::where('id',$id)->first();
        // print_r($data);die();

        $quote = new PerformaInvoice;
        $quote->quote_id=$id;
        $quote->customer_id = $data->customer_id;
        $quote->billing_address = $data->billing_address;
        $quote->shipping_address = $data->shipping_address ;
        $quote->quote_number = $data->quote_number;
        $quote->quote_date = $data->quote_date;
        $quote->expiry_date = $data->expiry_date;
        $quote->sub_total = $data->sub_total;
        $quote->discount_percentage = $data->discount_percentage;
        $quote->discount_amount = $data->discount_amount;
        $quote->adjustment = $data->adjustment;
        $quote->grant_total = $data->grant_total;
        $quote->customer_note = $data->customer_note;
        $quote->terms = $data->terms;
        $quote->status = 'Profoma Invoice';
        $quote->user_id = Auth::user()->id;
        $quote->save();

        $quoteID=$quote->id;

        if($quoteID != ''){
            Quote::where('id',$id)->update(['status'=>'Perform Invoice' , 'perfoma_invoice'=>'1']);
            return redirect()->route('performa_invoice');
        }


    }

    public function performa_invoice(){
      $data = PerformaInvoice::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();

      return view('pinvoice.list',compact('data'));
    }

    public function performa_invoice_details($id){
        $quoteData = Quote::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $data = Customer::where('id',$quoteData->customer_id)->first();
        $products = Product::get();
        return view('pinvoice.details',compact('data','quoteData','products'));

    }



     public function convert_to_invoice($id){
       
        $data = Quote::where('id',$id)->first();


        $quote = new Invoice;
        $quote->quote_id=$id;
        $quote->customer_id = $data->customer_id;
        $quote->billing_address = $data->billing_address;
        $quote->shipping_address = $data->shipping_address ;
        $quote->quote_number = $data->quote_number;
        $quote->quote_date = $data->quote_date;
        $quote->expiry_date = $data->expiry_date;
        $quote->sub_total = $data->sub_total;
        $quote->discount_percentage = $data->discount_percentage;
        $quote->discount_amount = $data->discount_amount;
        $quote->adjustment = $data->adjustment;
        $quote->grant_total = $data->grant_total;
        $quote->customer_note = $data->customer_note;
        $quote->terms = $data->terms;
        $quote->status = 'Invoice';
        $quote->user_id = Auth::user()->id;
        $quote->save();

        $quoteID=$quote->id;

        if($quoteID != ''){
            Quote::where('id',$id)->update(['status'=>'Invoice' , 'invoice'=>'1']);
            return redirect()->route('invoice');
        }
    }
   
    public function invoice(){
      $data = Invoice::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();

      return view('invoices.list',compact('data'));
    }

    public function invoice_details($id){
        $quoteData = Quote::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $data = Customer::where('id',$quoteData->customer_id)->first();
        $products = Product::get();
        return view('invoices.details',compact('data','quoteData','products'));

    }



   

}
