<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::get();
        return view('product.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // print_r($request->has('image'));

        if (file_exists(public_path().'/product_images/')) {
              
        } else {
           
            File::makeDirectory(public_path().'/product_images/', $mode = 0777, true, true);
        }
        $destinationPath = public_path().'/product_images/';
        
        $a12file = '';

        if($request->hasFile('image')) {
           //  print_r("ll");
            $doc_file = $request->file('image') ;
            $temp = explode(".", $doc_file->getClientOriginalName());
            $a12file = rand('111111','999999').'.'.end($temp);

           // $destinationPath = public_path().'/partner_documents';
            $doc_file->move($destinationPath,$a12file);
            
         }

        // print_r($a12file);die();

         $products = Product::get();

        $save = Product::create([
            'product_type' => $request->type,
            'product_name' => $request->name,
            'product_code' => "PRPW0".sizeof($products)+1,
            'tax_preference' => $request->tax_preference,
            'sku' => $request->sku,
            'hsn_code' => $request->hsn,
            'product_image' => $a12file,
            'units' => $request->units,
            'gst' => $request->intra,
            'igst' => $request->inter,
            'selling_price' => $request->price,
            'product_desc' => $request->desc

            
        ]);

        if($save){
            return redirect()->route('products')->with('message','Product Saved Succesfully');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Product::where('id',$id)->first();

        return view('product.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        if (file_exists(public_path().'/product_images/')) {
              
        } else {
           
            File::makeDirectory(public_path().'/product_images/', $mode = 0777, true, true);
        }
        $destinationPath = public_path().'/product_images/';

        $product = Product::where('id',$id)->first();
        
        $a12file = $product->product_image;

        if($request->hasFile('image')) {
           //  print_r("ll");
            $doc_file = $request->file('image') ;
            $temp = explode(".", $doc_file->getClientOriginalName());
            $a12file = rand('111111','999999').'.'.end($temp);

           // $destinationPath = public_path().'/partner_documents';
            $doc_file->move($destinationPath,$a12file);
            
         }

        // print_r($a12file);die();

         $products = Product::get();

        $update = Product::where('id',$id)->update([
            'product_type' => $request->type,
            'product_name' => $request->name,
            'tax_preference' => $request->tax_preference,
            'sku' => $request->sku,
            'hsn_code' => $request->hsn,
            'product_image' => $a12file,
            'units' => $request->units,
            'gst' => $request->intra,
            'igst' => $request->inter,
            'selling_price' => $request->price,
            'product_desc' => $request->desc

        ]);

        if($update){
            return redirect()->route('products')->with('message','Product Saved Succesfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
