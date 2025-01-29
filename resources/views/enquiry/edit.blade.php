@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <div class="container-header">
        <div class="d-flex">
          <label class="bold" style="margin-left: 20px" >Edit Enquiry</label>

          <div class="ms-auto">
            <a href="{{route('enquiry')}}"><button class="btn btn-outline-secondary">Back</button></a>

             <a href="{{route('create_customer',$data->id)}}"><button class="btn btn-outline-secondary">Create Customer</button></a>
          </div>

        </div>
      </div>

      @if(Session::has('message'))
        <script type="text/javascript">
          alert('{{Session::get('message')}}');
        </script>
      @endif
        
      <div>
        
        <div class="py-4">
          <form method="POST" action="{{route('update_enquiry',$data->id)}}">
            @csrf
            @method('PUT')
          <div class="">
            <label class="form-lable">Customer Type *</label>
            <div class="form-check form-check-inline ms-5">
                <input class="form-check-input" type="radio" name="customer_type" id="inlineRadio1" value="Individual" {{ ($data->customer_type == 'Individual')?'checked':''}} >
                <label class="form-check-label" for="inlineRadio1">Individual</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="customer_type" id="inlineRadio2" value="Business" {{ ($data->customer_type == 'Business')?'checked':''}} >
                <label class="form-check-label" for="inlineRadio2">Business</label>
            </div>   
          </div>
          
          <div class="row py-4 d-none" id="companyName" >
            <div class="col-3">
              <label>Company Name *</label>
               <input type="text" class="form-control" name="company_name" value="{{$data->company_name}}">
            </div>
          </div>

          <div class="row py-2">
            <div class="col-1">
               <label></label>
               <select class="form-control form-select" name="salutaion">
                  <option value="Mr" {{ ($data->salutaion == 'Mr')?'selected':''}}>Mr</option>
                  <option value="Ms" {{ ($data->salutaion == 'Ms')?'selected':''}}>Ms</option>
                  <option value="Mrs" {{ ($data->salutaion == 'Mrs')?'selected':''}}>Mrs</option>
                  <option value="Dr" {{ ($data->salutaion == 'Dr')?'selected':''}}>Dr</option>
               </select>
            </div>

            <div class="col-2">
               <label>First Name *</label>
               <input class="form-control" type="text" name="firstname" value="{{$data->first_name}}">
            </div>
          </div>

          <div class="row">
            <div class="col-3">
               <label>Last Name</label>
               <input class="form-control" type="text" name="lastname" value="{{$data->last_name}}">
            </div>
          </div>

          <div class="row py-2" >
            <div class="col-3">
              <label>Email Address *</label>
               <input type="email" class="form-control" name="email" value="{{$data->email}}">
            </div>
          </div>

          <div class="row py-2" >
            <div class="col-3">
              <label>Mobile Number</label>
               <input type="text" class="form-control" name="mobile" value="{{$data->mobile}}">
            </div>
          </div>

           <div class="row py-2" >
            <div class="col-3">
              <label>Date</label>
               <input type="date" class="form-control" name="date" value="{{ $data->date}}">
            </div>
          </div>

          <div class="row py-2" >
            <div class="col-6">
              <label>Details</label>
               <textarea class="form-control textarea resize-ta" name="details">{{$data->details}}</textarea>
            </div>
          </div>

          
          <button type="submit" class="mt-4 btn btn-dark">Update</button>
          </form>

        </div>
                   
      </div>
    </div>  
</div>

<script type="text/javascript">
  
  $('input[type=radio][name=customer_type]').change(function() {
    if (this.value == 'Individual') {
        $('#companyName').removeClass('d-block');
        $('#companyName').addClass('d-none');

        $('#company_name').prop('required',false);
    }
    else if (this.value == 'Business') {
        $('#companyName').removeClass('d-none');
        $('#companyName').addClass('d-block');

        $('#company_name').prop('required',true);
    }
  });


</script>







@endsection