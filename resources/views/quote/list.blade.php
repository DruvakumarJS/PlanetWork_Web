@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
         
           
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
 
       
        <div class="">
           <label class="bold py-4" style="margin-left: 20px" >Quotations</label>

           <table class="table table-striped">
              <thead>
                <th>Quote Number</th>
                <th>Customer Name</th>
                <th>Quote Date</th>
                <th>Quote Expiry</th>
                <th>Sub Total</th>
                <th>Discount %</th>
                <th>Grand Total</th>
                <th>Status</th>
                <th></th>
              </thead>

              <tbody>
                @foreach($data as $key=>$value)
                <tr>
                  <td>{{$value->quote_number}}</td>
                  <td>{{$value->customer->first_name}}</td>
                  <td>{{$value->quote_date}}</td>
                  <td>{{$value->expiry_date}}</td>
                  <td>{{$value->sub_total}}</td>
                  <td>{{$value->discount_percentage}}</td>
                  <td>{{$value->grant_total}}</td>
                  <td>{{$value->status}}</td>
                  <td>
                    <a href="{{route('view_quote_details',$value->id)}}"><button class="btn btn-sm btn-warning text-white">View</button></a>
                  </td>
                </tr>
                  
                @endforeach
              </tbody>
           </table>

        
                   
        </div>
    </div>  
</div>








@endsection