@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
          <div id="div2">
            <a href="{{route('create_enquiry')}}"><button class="btn btn-outline-secondary">Create</button></a>
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

        @if(Session::has('message'))
          <script type="text/javascript">
            alert('{{Session::get('message')}}');
          </script>
        @endif
 
       
        <div>
           <label class="bold" style="margin-left: 20px" >Enquiries</label>
           
           <div class="row">
             <table class="table table-striped">
               <thead>
                 <th>Enquiry No.</th>
                 <th>Customer Type</th>
                 <th>Customer Name</th>
                 <th>Email</th>
                 <th>Mobile</th>
                 <th>Creator</th>
                 <th>Date</th>
                 <th>Status</th>
                 <th></th>
               </thead>

               <tbody>
                 @foreach($data as $key=>$value)
                  <tr>
                    <td>{{$value->enquiry_no}}</td>
                    <td>{{$value->customer_type}} {{ ($value->customer_type == 'Business') ? '-' .$value->company_name : '' }} </td>
                    <td>{{$value->salutaion}} {{$value->first_name}} {{$value->last_name}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->mobile}}</td>
                    <td>{{$value->user->name}}</td>
                    <td>{{ date('d-m-Y' , strtotime($value->date)) }}</td>
                    <td>{{ $value->status}}</td>
                    <td>
                      @if($value->status == 'Created')
                      <a href="{{route('edit_enquiry',$value->id)}}"><button class="btn btn-sm btn-outline-secondary">Edit</button></a>

                      <a href="{{route('create_customer',$value->id)}}"><button class="btn btn-sm btn-outline-success">Convert to Customer</button></a>
                      @endif
                    </td>
                  </tr>
                 @endforeach
               </tbody>
             </table>
           </div>
        
                   
        </div>
    </div>  
</div>







@endsection