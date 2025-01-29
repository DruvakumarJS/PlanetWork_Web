@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header d-flex">
          <label class="bold" style="margin-left: 20px" >Edit Customer</label>

          <div class="ms-auto">
            <a href="{{ route('create_quote',$data->id)}}"><button class="btn btn-outline-secondary">Create Quote</button></a>
            <a href="{{ URL::previous() }}"><button class="btn btn-outline-secondary">Go Back</button></a> 
          </div>
          
        </div> 
    </div> 

    @if(Session::has('message'))
      <script type="text/javascript">
        alert('{{Session::get('message')}}');
      </script>
    @endif

    <form method="POST" action="{{route('update_customer',$data->id)}}">
    @csrf
    @method('PUT')

    @if($data->enquiry_id != "")

    <div class="py-4">
      <div class="card p-3 border-0">
        <div class="row text-center">
          <div class="col"> 
              <p class="font1">Customer Name</p>
              <label class="font2-bold">{{ $data->salutaion }} {{ $data->first_name }} {{ $data->last_name }}</label>
          </div>

          <div class="col border-start border-black">
              <p class="font1">Customer Type</p>
              <label class="font2-bold">{{$data->customer_type}} {{ ($data->customer_type == 'Business') ? '- ' .$data->company_name : '' }}</label>
          </div>

          <div class="col border-start border-black">
              <p class="font1">Email Address</p>
              <label class="font2-bold">{{ $data->email }}</label>
          </div>

          <div class="col border-start border-black">
              <p class="font1">Mobile Number</p>
              <label class="font2-bold">{{ $data->mobile }}</label>
          </div> 
        </div>
      </div>
    </div> 

    @else

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

    @endif

    <input type="hidden" name="enquiry_id" value="{{ $data->enquiry_id}}">

    <div class="mt-4">
      <label class="font2-bold lable-active" id="address_form" onclick="toggleform('address');">Address Details</label>

      <label class="font2-bold ms-5" id="gst_form" onclick="toggleform('gst');">GST Details</label>

    </div>

    <div id="address-container">

      @foreach($data->addresses as $key=>$value)
      <div class="address-block py-2" id="address_block">
        <div class="row py-3">
          <div class="col-3">
            <label class="font1-bold">Billing Address</label>
            <div class="row py-3 pt-4">
              <div class="col-12">
                <input type="hidden" name="address_id[]" value="{{$value->id ?? '0'}}">
                <div class="form-group">
                  <label class="font1">Address Line 1</label>
                  <input type="text" class="form-control" name="b_add1[]" value="{{$value->billing_address_line_1}}" required />
                </div>

                <div class="form-group mt-2">
                  <label class="font1">Address Line 2</label>
                  <input type="text" class="form-control" name="b_add2[]" value="{{$value->billing_address_line_2}}"  required />
                </div>

                <div class="form-group mt-2">
                  <label class="font1">City</label>
                  <input type="text" class="form-control" name="b_city[]" value="{{$value->billing_city}}" required />
                </div>

                <div class="form-group mt-2">
                  <label class="font1">State</label>
                  <select class="form-control border-black" name="b_state[]" value="{{$value->billing_address_line_1}}" required>
                    <option value="">Select</option>
                    @foreach($states as $state)
                      <option {{ ($value->billing_state == $state) ?'selected':''}} value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group mt-2">
                  <label class="font1">Pincode</label>
                  <input type="text" class="form-control" name="b_pincode[]" value="{{$value->billing_pincode}}" required />
                </div>
              </div>
            </div>
          </div>

          <div class="col-1"></div>
          
          <div class="col-3">
            <label class="font1-bold">Shipping Address</label>
            <label class="font1 ms-2 border border-info rounded-2 p-1 text-info copy-billing" style="cursor: pointer;">Copy from Billing</label>
            <div class="row py-3">
              <div class="col-12">
                <div class="form-group">
                  <label class="font1">Address Line 1</label>
                  <input type="text" class="form-control" name="s_add1[]" value="{{$value->shipping_address_line_1}}" required />
                </div>

                <div class="form-group mt-2">
                  <label class="font1">Address Line 2</label>
                  <input type="text" class="form-control" name="s_add2[]" value="{{$value->shipping_address_line_2}}" required/>
                </div>

                <div class="form-group mt-2">
                  <label class="font1">City</label>
                  <input type="text" class="form-control" name="s_city[]" value="{{$value->shipping_city}}" required />
                </div>

                <div class="form-group mt-2">
                  <label class="font1">State</label>
                  <select class="form-control border-black" name="s_state[]" required>
                    <option value="">Select</option>
                    @foreach($states as $state)
                      <option {{ ($value->shipping_state == $state) ?'selected':''}} value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group mt-2">
                  <label class="font1">Pincode</label>
                  <input type="text" class="form-control" name="s_pincode[]" value="{{$value->shipping_pincode}}" required />
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="d-flex">
          <button type="button" class="btn btn-sm btn-danger ms-auto remove-address">Remove</button>
        </div>

        <hr />
      </div>
    @endforeach
</div>

<div class="d-none" id="gst_block">
  <div class="row">
    <div class="col-3">
     
      <div class="row py-3 pt-4">
        <div class="col-12">

          <div class="form-group">
            <label class="font1">GST Treatment</label>
            <select class="form-control border-black" name="treatment" required>
              <option value=""></option>
              <option value="Registered" {{ ($data->treatment== 'Registered')?'selected':'' }}>Registered</option>
              <option value="Non - Registered" {{ ($data->treatment== 'Non - Registered')?'selected':'' }}>Non - Registered</option>
            </select>
          </div>

          <div class="form-group">
            <label class="font1">GSTIN</label>
            <input type="text" class="form-control" name="gstin" value="{{$data->gst}}" required />
          </div>

          <div class="form-group mt-2">
            <label class="font1">PAN Number</label>
            <input type="text" class="form-control" name="pan" value="{{$data->pan}}" required />
          </div>

          <div class="form-group mt-2">
              <label class="font1">Place Supply</label>
              <select class="form-control border-black" name="supply" required>
                <option value="">Select</option>
                @foreach($states as $state)
                  <option {{ ($data->supply == $state)?'selected':'' }} value="{{ $state }}">{{ $state }}</option>
                @endforeach
              </select>
          </div>
          
          <div class="form-group mt-2">
            <label class="font1">Payment Terms</label>
            <select class="form-control border-black" name="payment" required>
              <option value="">Select</option>
              <option {{ ($data->payment == 'Net 15')?'selected':'' }} value="Net 15">Net 15</option>
              <option {{ ($data->payment == 'Net 30')?'selected':'' }} value="Net 30">Net 30</option>
              <option {{ ($data->payment == 'Net 45')?'selected':'' }} value="Net 45">Net 45</option>
              <option {{ ($data->payment == 'Net 50')?'selected':'' }} value="Net 30">Net 50</option>
              <option {{ ($data->payment == 'Due on Receipt')?'selected':'' }} value="Due on Receipt">Due on Receipt</option>
              <option {{ ($data->payment == 'Due at End of month')?'selected':'' }} value="Due at End of month">Due at End of month</option>
              <option {{ ($data->payment == 'Due Next month')?'selected':'' }} value="Due Next month">Due Next month</option>
              <option {{ ($data->payment == 'Due at End of Year')?'selected':'' }} value="Due at End of Year">Due at End of Year</option>
              <option {{ ($data->payment == 'Due Next Year')?'selected':'' }} value="Due Next Year">Due Next Year</option>
              <option {{ ($data->payment == 'Due at End of Next Year')?'selected':'' }} value="Due at End of Next Year ">Due at End of Next Year</option>
            </select>
          </div>

           
          
        </div>
      </div>
    </div>
  </div>
  <hr/>
      
</div>

<div class="d-flex">
   <button type="button" class="btn btn-sm btn-outline-secondary" id="add-address">Add Address</button>
    
  <div class="ms-auto">
   <button class="btn btn-sm btn-success ms-5" >Update</button>
  </div>
</div>
</form>
</div>

<script>
  $(document).ready(function () {
    // Clone and append new address block
    $("#add-address").click(function () {
      const newAddressBlock = $(".address-block:first").clone();
      newAddressBlock.find("input, select").val(""); // Clear input values
      $("#address-container").append(newAddressBlock);
    });

    $(document).on("click", ".remove-address", function () {
      if ($(".address-block").length > 1) {
        $(this).closest(".address-block").remove();
      } else {
        alert("At least one address block is required.");
      }
    });

    // Copy billing to shipping
    $(document).on("click", ".copy-billing", function () {
      const addressBlock = $(this).closest(".address-block");
      const bAdd1 = addressBlock.find('[name="b_add1[]"]').val();
      const bAdd2 = addressBlock.find('[name="b_add2[]"]').val();
      const bCity = addressBlock.find('[name="b_city[]"]').val();
      const bState = addressBlock.find('[name="b_state[]"]').val();
      const bPincode = addressBlock.find('[name="b_pincode[]"]').val();

      addressBlock.find('[name="s_add1[]"]').val(bAdd1);
      addressBlock.find('[name="s_add2[]"]').val(bAdd2);
      addressBlock.find('[name="s_city[]"]').val(bCity);
      addressBlock.find('[name="s_state[]"]').val(bState);
      addressBlock.find('[name="s_pincode[]"]').val(bPincode);
    });

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


  });

   function toggleform(item){
      if(item=='address'){
        $('#address_form').addClass('lable-active');
        $('#gst_form').removeClass('lable-active');

        $('#address_block').removeClass('d-none');
        $('#address_block').addClass('d-block');

        $('#address-container').removeClass('d-none');
        $('#address-container').addClass('d-block');

        $('#add-address').removeClass('d-none');
        $('#add-address').addClass('d-block');

        $('#gst_block').removeClass('d-block');
        $('#gst_block').addClass('d-none');
      }
      if(item=='gst'){
        $('#address_form').removeClass('lable-active');
        $('#gst_form').addClass('lable-active');

        $('#gst_block').removeClass('d-none');
        $('#gst_block').addClass('d-block');

        $('#address_block').removeClass('d-block');
        $('#address_block').addClass('d-none');

        $('#address-container').removeClass('d-block');
        $('#address-container').addClass('d-none');

        $('#add-address').removeClass('d-block');
        $('#add-address').addClass('d-none');

        
      }
    }
</script>






@endsection