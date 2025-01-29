@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
          <div id="div2">
            <a href="{{route('create_product')}}"><button class="btn btn-outline-secondary">Create</button></a>
          </div>
           
          <div id="div2" style="margin-right: 30px">
           <form method="GET" action="">
            @csrf
            <input type="hidden" name="search" value="">
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search here" value="">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>

          <div id="div2" style="margin-right: 30px">
           <form method="POST" action="">
            @csrf
            <input type="hidden" name="search" value="">
             <div class="input-group mb-3">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Download CSV</button>
              </div>
           </form>
          </div>
           
        </div>
 
       
        <div>
           <label class="bold" style="margin-left: 20px" >Products</label>
           
           <div class="py-4">
             <table class="table tabe-striped">
               <thead>
                 <th>Type</th>
                 <th>Name</th>
                 <th>Tax Preference</th>
                 <th>SKU</th>
                 <th>HSN Code</th>
                 <th>Price</th>
                 <th>Units</th>
                 <th>GST</th>
                 <th></th>
               </thead>
               <tbody>
                 @foreach($data as $key=>$value)
                   <tr>
                     <td>{{$value->product_type}}</td>
                     <td>{{$value->product_name}}</td>
                     <td>{{ $value->tax_preference}}</td>
                     <td>{{$value->sku}}</td>
                     <td>{{$value->hsn_code}}</td>
                     <td>{{$value->selling_price}}</td>
                     <td>{{$value->units}}</td>
                     <td>GST-{{$value->gst}}% <br> IGST-{{$value->igst}}% </td>
                     <td><a href="{{route('edit_product',$value->id)}}"><button class="btn btn-sm btn-outline-secondary">Edit</button></a></td>
                   </tr>
                 @endforeach
               </tbody>
             </table>
           </div>
        
                   
        </div>
    </div>  
</div>








@endsection