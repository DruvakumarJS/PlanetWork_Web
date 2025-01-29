@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

    @if(Session::has('message'))
      <script type="text/javascript">
        alert('{{Session::get('message')}}');
      </script>
    @endif
        
      <div>
        <label class="bold" style="margin-left: 20px" >Create Enquiry</label>

        <div class="py-4">
          <form method="POST" action="{{route('save_enquiry')}}">
            @csrf
          <div class="">
            <label class="form-lable">Customer Type *</label>
            <div class="form-check form-check-inline ms-5">
                <input class="form-check-input" type="radio" name="customer_type" id="inlineRadio1" value="Individual"  checked >
                <label class="form-check-label" for="inlineRadio1">Individual</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="customer_type" id="inlineRadio2" value="Business" >
                <label class="form-check-label" for="inlineRadio2">Business</label>
            </div>   
          </div>
          
          <div class="row py-4 d-none" id="companyName" >
            <div class="col-3">
              <label>Company Name *</label>
               <input type="text" class="form-control" name="company_name" value="{{ old('company_name')}}">
            </div>
          </div>

          <div class="row py-2">
            <div class="col-1">
               <label></label>
               <select class="form-control form-select" name="salutaion" value="{{ old('salutaion')}}" required>
                  <option value="Mr">Mr</option>
                  <option value="Ms">Ms</option>
                  <option value="Mrs">Mrs</option>
                  <option value="Dr">Dr</option>
               </select>
            </div>

            <div class="col-2">
               <label>First Name *</label>
               <input class="form-control" type="text" name="firstname" value="{{ old('firstname')}}" required>
            </div>
          </div>

          <div class="row">
            <div class="col-3">
               <label>Last Name</label>
               <input class="form-control" type="text" name="lastname" value="{{ old('lastname')}}">
            </div>
          </div>

          <div class="row py-2" >
            <div class="col-3">
              <label>Email Address *</label>
               <input type="email" class="form-control" name="email" value="{{ old('email')}}" required>
            </div>
          </div>

          <div class="row py-2" >
            <div class="col-3">
              <label>Mobile Number</label>
               <input type="text" class="form-control" name="mobile" value="{{ old('mobile')}}">
            </div>
          </div>

           <div class="row py-2" >
            <div class="col-3">
              <label>Date</label>
               <input type="date" class="form-control" name="date" value="{{ old('date') ?? date('Y-m-d')}}">
            </div>
          </div>

          <div class="row py-2" >
            <div class="col-6">
              <label>Details *</label>
               <textarea class="form-control" name="details" placeholder="Enter Comments here" required> {{ old('details')}}</textarea>
            </div>
          </div>

          
          <button type="submit" class="mt-4 btn btn-dark">Create</button>
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