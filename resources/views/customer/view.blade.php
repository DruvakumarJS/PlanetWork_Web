@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header d-flex">
          <label class="bold" style="margin-left: 20px" >Customer Details</label>

          <div class="ms-auto">
            <a href="{{ route('create_quote',$data->id)}}"><button class="btn btn-outline-secondary">Create Quote</button></a>
            <a href="{{ route('edit_customer',$data->id)}}"><button class="btn btn-outline-secondary">Edit</button></a>
            <a href="{{route('customers')}}"><button class="btn btn-outline-secondary">Go Back</button></a>
          </div>
          
        </div> 
    </div> 

    @if(Session::has('message'))
      <script type="text/javascript">
        alert('{{Session::get('message')}}');
      </script>
    @endif
    
    <label class="font1">Customer Type </label> <label class="font-small border  rounded-3 p-1 text-info copy-billing text-black bg-card-blue" style="cursor: pointer;">{{$data->customer_type}}</label>
    <div class="py-4">
      <div class="card p-3 border-0 bg-card-blue">
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

    <div>
      <label class="font2-bold lable-active" id="address_form" onclick="toggleform('address');">Address Details</label>

      <label class="font2-bold ms-5" id="gst_form" onclick="toggleform('gst');">GST Details</label>

    </div>

    <div class="py-4" id="address_block">
       @foreach($data->addresses as $key=>$value) 
        <div class="row p-2">
          <div class="col-4">
            <div class="card p-1">
              <div class="card-title font1 ms-2">Billing Address</div>
              <div class="card-body">
                <label class="font1-bold">{{$value->billing_address_line_1}},<br> {{$value->billing_address_line_2}} <br>{{$value->billing_city}},{{$value->billing_state}} <br> {{$value->billing_pincode}}</label>
              </div>
            </div>
          </div>

          <div class="col-4">
            <div class="card p-1">
              <div class="card-title font1 ms-2">Shipping Address</div>
              <div class="card-body">
                <label class="font1-bold">{{$value->shipping_address_line_1}},<br> {{$value->shipping_address_line_2}} <br>{{$value->shipping_city}},{{$value->shipping_state}} <br> {{$value->shipping_pincode}}</label>
              </div>
            </div>
          </div>
        </div>
       @endforeach
    </div>

    <div class="d-none py-4" id="gst_block"> 
      <div class="row p-2">
          <div class="col-4">
            <div class="card p-2">
              <div class="card-title font1-bold">GST Details</div>
              <div class="card-body">
                <p>GST Treatment : <label class="font1-bold">{{$data->treatment}}</label></p>
                <p>GSTIN : <label class="font1-bold">{{$data->gst}}</label></p>
                <p>PAN : <label class="font1-bold">{{$data->pan}}</label></p>
                <p>Place Supply : <label class="font1-bold">{{$data->supply}}</label></p>
                <p>Payment Terms : <label class="font1-bold">{{$data->payment}}</label></p>
              </div>
            </div>
          </div>
      </div>
    </div>

    
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