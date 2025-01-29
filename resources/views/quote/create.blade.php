@extends('layouts.app')

@section('content')

<div class="container">
<div class="row justify-content-center">
    <div>
       <label class="bold">Create Quote</label>
    </div>
</div>  

<div class="py-4">
  <div class="row">
    <div class="col-6">
      <label class="font-small">Search Customer</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
         </div>
        <input type="text" class="form-control " aria-label="Amount (to the nearest dollar)">
        <div class="input-group-append bg-white border">
          <span class="input-group-text"> <img src="/images/search.svg"> </span>
        </div>
      </div>
    </div>
  </div>
  <label class="font1-bold py-2">Customer Type </label> <label class="font-small ms-2 border rounded-3 p-1 text-info copy-billing text-black bg-card-blue" style="cursor: pointer;">{{$data->customer_type}}</label>
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
</div>


<div class="row">
  <div class="col-4">
    <label class="font1-bold">Billing Address</label>
    <div class="card">
      <select class="form-control form-select border border-black rounded-0" id="billingaddress" >
        @foreach($data->addresses as $key=>$value)
         <option>{{$value->billing_address_line_1}},{{$value->billing_address_line_2}} ,{{$value->billing_city}},{{$value->billing_state}} ,{{$value->billing_pincode}}</option>
        @endforeach
      </select>
      <div class="card-body">
        
        <p id="billing"></p>
      </div>
    </div>
  </div>
  
  <div class="col-4">
    <label class="font1-bold">Shipping Address</label>
    <div class="card">
      <select class="form-control form-select border border-black rounded-0" id="shippingaddress">
        @foreach($data->addresses as $key=>$value)
         <option>{{$value->shipping_address_line_1}}, {{$value->shipping_address_line_2}}, {{$value->shipping_city}},{{$value->shipping_state}}, {{$value->shipping_pincode}}</option>
        @endforeach
      </select>
      <div class="card-body">
        
        <p id="shipping"></p>
      </div>
    </div>
  </div>
</div>

<div class="row py-4">
  <div class="col-4">
    <div class="form-group">
      <label class="font1">Quote Number</label>
      <input type="text" name="quote_no" value="#059599606" class="form-control" readonly>
    </div>
  </div>
  <div class="col-2">
    <div class="form-group">
      <label class="font1">Quote Date</label>
      <input type="text" name="quote_no" class="form-control" value="{{date('Y-m-d')}}" readonly>
    </div>
  </div>

  <div class="col-2">
    <div class="form-group">
      <label class="font1">Expiry Date</label>
      <input type="text" name="quote_no" class="form-control" value="{{date('Y-m-d',strtotime('+10 days')) }}" readonly>
    </div>
  </div>
</div>

<div class="py-4">
  <label class="font2-bold">Products</label>

  <div id="rowContainer">
    <!-- Default Row with Labels -->
    <div class="row align-items-center mb-2">
      <div class="col-4">
        <div class="form-group">
          <span>Add Items</span>
          <select class="form-control form-select border-black" name="items[]">
            <option value="">Select</option>
            @foreach($products as $key => $value)
              <option value="{{$value->id}}">{{$value->product_name}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-1">
        <div class="form-group">
          <span>Quantity</span>
          <input class="form-control" type="text" name="qty[]" onkeydown="numbersonly(event)">
        </div>
      </div>

      <div class="col-1">
        <div class="form-group">
          <span>Rate</span>
          <input class="form-control" type="text" name="rate[]" onkeydown="numbersonly(event)">
        </div>
      </div>

      <div class="col-1">
        <div class="form-group">
          <span>Tax</span>
          <input class="form-control" type="text" name="tax[]" onkeydown="numbersonly(event)">
        </div>
      </div>

      <div class="col-1">
        <div class="form-group">
          <span>Amount</span>
          <input class="form-control" type="text" name="amount[]" onkeydown="numbersonly(event)">
        </div>
      </div>
      
    </div>
  </div>

  <div class="mt-3">
    <button type="button" id="addRow" class="btn btn-sm btn-dark">Add Row</button>
  </div>



  </div>

  <div class="row">
     <div class="col-8 d-flex">
       <div class="row g-3 align-items-center ms-auto">
          <div class="col-auto">
            <label for="inputPassword6" class="col-form-label">GST Tax</label>
          </div>
          <div class="col-auto">
            <select class="form-control form-select">
               <option value="">Select Tax</option>
               <option value="0"> GST 0 %</option>
               <option value="5"> GST 5 %</option>
               <option value="12"> GST 12 %</option>
               <option value="18"> GST 18 %</option>
               <option value="28"> GST 28 %</option>
            </select>
          </div>
          
        </div>
     </div>
  </div>

  <div class="row py-2">
     <div class="col-8 d-flex">
       <div class="row g-3 align-items-center ms-auto">
          <div class="col-auto">
            <label for="inputPassword6" class="col-form-label">Sub Total</label>
          </div>
          <div class="col-auto">
            <input class="form-control" type="text" name="">
          </div>
          
        </div>
     </div>
  </div>


</div>
</div>

<script type="text/javascript">
   $(document).ready(function () {
    var selectedIndex =0;
    const Billingmessage = addres[selectedIndex]['billing_address_line_1'] +'<br>'+ addres[selectedIndex]['billing_address_line_2'] +'<br>'+addres[selectedIndex]['billing_city'] + ',' + addres[selectedIndex]['billing_state']  +'<br>'+ addres[selectedIndex]['billing_pincode'] ;

    const Shippingmessage = addres[selectedIndex]['shipping_address_line_1'] +'<br>'+ addres[selectedIndex]['shipping_address_line_2'] +'<br>'+addres[selectedIndex]['shipping_city'] + ',' + addres[selectedIndex]['shipping_state']  +'<br>'+ addres[selectedIndex]['shipping_pincode'] ;

     
     document.getElementById("billing").innerHTML = Billingmessage; 
     document.getElementById("shipping").innerHTML = Shippingmessage; 
   });

  const selectElement = document.getElementById('billingaddress');
  const shippingElement = document.getElementById('shippingaddress');
    
  var addres = <?php echo json_encode($data->addresses); ?>;

  // Event listener to get the index on selection
  selectElement.addEventListener('change', function () {
    const selectedIndex = selectElement.selectedIndex; // Get the index

    const Billingmessage = addres[selectedIndex]['billing_address_line_1'] +'<br>'+ addres[selectedIndex]['billing_address_line_2'] +'<br>'+addres[selectedIndex]['billing_city'] + ',' + addres[selectedIndex]['billing_state']  +'<br>'+ addres[selectedIndex]['billing_pincode'] ;

    const Shippingmessage = addres[selectedIndex]['shipping_address_line_1'] +'<br>'+ addres[selectedIndex]['shipping_address_line_2'] +'<br>'+addres[selectedIndex]['shipping_city'] + ',' + addres[selectedIndex]['shipping_state']  +'<br>'+ addres[selectedIndex]['shipping_pincode'] ;

     shippingElement.selectedIndex  = selectElement.selectedIndex;

     document.getElementById("billing").innerHTML = Billingmessage; 
     document.getElementById("shipping").innerHTML = Shippingmessage; 




  });


  const selectElement2 = document.getElementById('shippingaddress');

 
  // Event listener to get the index on selection
  selectElement2.addEventListener('change', function () {
    const selectedIndex = selectElement2.selectedIndex; // Get the index

    const Shippingmessage = addres[selectedIndex]['shipping_address_line_1'] +'<br>'+ addres[selectedIndex]['shipping_address_line_2'] +'<br>'+addres[selectedIndex]['shipping_city'] + ',' + addres[selectedIndex]['shipping_state']  +'<br>'+ addres[selectedIndex]['shipping_pincode'] ;

    document.getElementById("shipping").innerHTML = Shippingmessage; 


  });

  document.getElementById('addRow').addEventListener('click', function () {
    const rowContainer = document.getElementById('rowContainer');
    
    // Create a new row without labels
    const newRow = document.createElement('div');
    newRow.className = 'row align-items-center mb-2';
    newRow.innerHTML = `
      <div class="col-4">
        <div class="form-group">
          <select class="form-control form-select border-black" name="items[]">
            <option value="">Select</option>
            @foreach($products as $key => $value)
              <option value="{{$value->id}}">{{$value->product_name}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-1">
        <div class="form-group">
          <input class="form-control" type="text" name="qty[]" onkeydown="numbersonly(event)">
        </div>
      </div>

      <div class="col-1">
        <div class="form-group">
          <input class="form-control" type="text" name="rate[]" onkeydown="numbersonly(event)">
        </div>
      </div>

      <div class="col-1">
        <div class="form-group">
          <input class="form-control" type="text" name="tax[]" onkeydown="numbersonly(event)">
        </div>
      </div>

      <div class="col-1">
        <div class="form-group">
          <input class="form-control" type="text" name="amount[]" onkeydown="numbersonly(event)">
        </div>
      </div>
      
      <div class="col-1 d-flex align-items-center">
        <button type="button" class="btn btn-sm btn-danger removeRow">Remove</button>
      </div>
    `;

    // Add remove event listener for the new row
    newRow.querySelector('.removeRow').addEventListener('click', function () {
      newRow.remove();
    });

    // Append the new row to the container
    rowContainer.appendChild(newRow);
  });

  // Remove row functionality for default rows
  document.querySelectorAll('.removeRow').forEach(function (button) {
    button.addEventListener('click', function () {
      button.closest('.row').remove();
    });
  });
</script>




@endsection