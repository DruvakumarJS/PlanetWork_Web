@extends('layouts.app')

@section('content')
<style type="text/css">
   .select2-container--bootstrap-5 .select2-selection {
        height: calc(2.25rem + 2px) !important; /* Match form-control height */
        padding: 0.375rem 0.75rem; /* Match Bootstrap padding */
        font-size: 1rem; /* Match Bootstrap font-size */
        border: 1px solid #ced4da; /* Bootstrap border color */
        border-radius: 0.375rem;
        border-color: black /* Match border-radius */
    }

    .select2-container--bootstrap-5 .select2-selection__arrow {
        top: 50%;
        transform: translateY(-50%);
    }

    .select2-container--bootstrap-5 .select2-selection__rendered {
        line-height: 1.5;
    }
</style>

<div class="container">
<form method="POST" action="{{route('update_quote',$quoteData->id)}}">
  @csrf
  @method('PUT')

<div class="row justify-content-center">
    <div class="d-flex">
       <label class="bold">Edit Quotation Details</label>
       <div class="ms-auto">
          <a href=""><button class="btn btn-sm btn-danger text-white">Go Back</button></a>
       </div>
    </div>
</div>  

<div class="py-4">
  
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
<input type="hidden" name="customer_id" value="{{$data->id}}">

<div class="row">
  <div class="col-5">
    <label class="font1-bold">Billing Address</label>
    <div class="card">
      <select class="form-control form-select border border-black rounded-0" name="billingaddress" id="billingaddress" >
        @foreach($data->addresses as $key=>$value)
         <option {{ ($value->id == $quoteData->billing_address)?'selected':''}} value="{{$value->id}}">{{$value->billing_address_line_1}},{{$value->billing_address_line_2}} ,{{$value->billing_city}},{{$value->billing_state}} ,{{$value->billing_pincode}}</option>
        @endforeach
      </select>
      <div class="card-body">
        
        <p id="billing"></p>
      </div>
    </div>
  </div>
  
  <div class="col-5">
    <label class="font1-bold">Shipping Address</label>
    <div class="card">
      <select class="form-control form-select  border border-black rounded-0" name="shippingaddress" id="shippingaddress" >
        @foreach($data->addresses as $key=>$value)
         <option {{ ($value->id == $quoteData->shipping_address)?'selected':''}} value="{{$value->id}}">{{$value->shipping_address_line_1}}, {{$value->shipping_address_line_2}}, {{$value->shipping_city}},{{$value->shipping_state}}, {{$value->shipping_pincode}}</option>
        @endforeach
      </select>
      <div class="card-body">
        
        <p id="shipping"></p>
      </div>
    </div>
  </div>
</div>

<div class="row py-4">
  <div class="col-5">
    <div class="form-group">
      <label class="font1">Quote Number</label>
      <input type="text" name="quote_no" value="{{$quoteData->quote_number}}" class="form-control" >
    </div>
  </div>
  <div class="col-2">
    <div class="form-group">
      <label class="font1">Quote Date</label>
      <input type="text" name="quote_date" class="form-control" value="{{$quoteData->quote_date}}" >
    </div>
  </div>

  <div class="col-2">
    <div class="form-group">
      <label class="font1">Expiry Date</label>
      <input type="text" name="quote_expiry" class="form-control" value="{{$quoteData->expiry_date}}" >
    </div>
  </div>
</div>

<div class="py-4">
  <label class="font2-bold">Products</label>
 
 @foreach($quoteData->products as $key=>$product)
  <div class="py-2">
    <div class="row align-items-center mb-2"> 
      <div class="col-3">
        <div class="form-group">
          @if($key==0)<span>Add Items</span>@endif
          <select class="form-control form-select border-black item-select" name="items[]" onchange="setAmount(this)">
            <option value="">Select</option>
            @foreach($products as $keys => $value)
              <option {{ ($value->id == $product->product_id) ? 'selected' : '' }}  
                value="{{$value->id}}" 
                data-rate="{{$value->selling_price}}" 
                data-gst="{{$value->gst}}" 
                data-igst="{{$value->igst}}">
                {{$value->product_name}}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-1">
        <div class="form-group">
          @if($key==0)<span>Quantity</span>@endif
          <input class="form-control qty-input" type="text" name="qty[]" value="{{$product->quantity}}" oninput="updateAmount(this)">
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
          @if($key==0)<span>Rate</span>@endif
          <input class="form-control rate-input" type="text" name="rate[]" value="{{$product->revised_price}}" readonly>
        </div>
      </div>

      <div class="col-1">
        <div class="form-group">
          @if($key==0)<span>Tax</span>@endif
          <input class="form-control tax-input" type="text" name="tax[]" value="{{$product->tax}}" readonly>
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
          @if($key==0)<span>Amount</span>@endif
          <input class="form-control amount-input" type="text" name="amount[]" value="{{$product->amount}}" readonly>
        </div>
      </div>

      <input type="hidden" name="quote_prod_id[]" value="{{$product->id}}">

      @if($key != 0)
      <div class="col-1 d-flex align-items-center">
        <button type="button" class="btn btn-sm btn-danger removeRow">Remove</button>
      </div>
      @endif
    </div>
  </div>
@endforeach

  <div id="rowContainer"></div>

   <div class="row py-2">
     <div class="col-9 d-flex">
       <div class="row g-3 align-items-center ms-auto">
 
          <div class="col-auto">
            <button type="button" id="addRow" class="btn btn-sm btn-dark ms-auto">Add Row</button>
          </div>
          
        </div>
     </div>
  </div>
 
  </div>


  <div class="row py-2">
     <div class="col-9 d-flex">
       <div class="row g-3 align-items-center ms-auto">
          <div class="col-auto">
            <label for="inputPassword6" class="col-form-label">Sub Total</label>
          </div>
          <div class="col-auto">
            <input class="form-control" type="text" name="subtotal" id="subtotal" value="{{$quoteData->sub_total}}" readonly name="">
          </div>
          
        </div>
     </div>
  </div>

   <div class="row py-2">
     <div class="col-9 d-flex">
       <div class="row g-3 align-items-center ms-auto">
          <div class="col-auto">
            <label for="inputPassword6" class="col-form-label" >Discount in %</label>
          </div>
          <div class="col-auto">
            <input type="text" id="discount" name="discount" class="form-control" value="{{$quoteData->discount_percentage}}" readonly>
          </div>
          
        </div>
     </div>
  </div>

  <div class="row py-2">
     <div class="col-9 d-flex">
       <div class="row g-3 align-items-center ms-auto">
          <div class="col-auto">
            <label for="inputPassword6" class="col-form-label" >Discounted Amount</label>
          </div>
          <div class="col-auto">
            <input type="text" id="discounted_amount" name="discounted_amount" class="form-control" value="{{$quoteData->discount_amount}}" readonly>
          </div>
          
        </div>
     </div>
  </div>

  <div class="row py-2">
     <div class="col-9 d-flex">
       <div class="row g-3 align-items-center ms-auto">
          <div class="col-auto">
            <label for="inputPassword6" class="col-form-label">Adjustment</label>
          </div>
          <div class="col-auto">
            <input class="form-control" type="text" id="adjustment" name="adjustment" value="{{$quoteData->adjustment}}" readonly>
          </div>
          
        </div>
     </div>
  </div>

   <div class="row py-2">
     <div class="col-9 d-flex">
       <div class="row g-3 align-items-center ms-auto">
          <div class="col-auto">
            <label for="inputPassword6" class="col-form-label">Grand Total</label>
          </div>
          <div class="col-auto">
            <input type="text" id="finalTotal" name="finalTotal" class="form-control" value="{{$quoteData->grant_total}}" readonly>
          </div>
          
        </div>
     </div>
  </div>

  <div class="row py-2">
     <div class="col-9 d-flex">
       <div class="row g-3 align-items-center ms-auto">
          <div class="col-auto">
            <strong>Amount in Words:</strong>
          </div>
          <div class="col-auto  ">
            <p id="finalTotalWords" class="text-primary"></p>
          </div>
          
        </div>
  </div>

  <div class=" col-9 form-group py-4">
     <label class="font1-bold">Customer Note</label>
    <textarea class="form-control" name="note"  style="min-height: 100px;">{{$quoteData->customer_note}}</textarea>
  </div>

   <div class=" col-9 form-group py-2">
     <label class="font1-bold">Terms and Condition</label>
    <textarea class="form-control" name="tc" style="min-height: 100px;">{{$quoteData->terms}}</textarea>
  </div>

  <div class="py-4">
     <button type="submit" class="btn btn-dark" name="btn_name" value="draft">Update</button>
  </div>

</form> 
</div>
</div>

<script type="text/javascript">
   $(document).ready(function () {
    var totalsum=$('#finalTotal').val();
    document.getElementById('finalTotalWords').innerText = numberToWords(Math.floor(totalsum)) + " Rupees Only";



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

  // Function to set the rate and amount when an item is selected
function setAmount(selectElement) {
    const row = selectElement.closest('.row');
    const rateInput = row.querySelector('.rate-input');
    const amountInput = row.querySelector('.amount-input');
    const qtyInput = row.querySelector('.qty-input');
    const taxInput = row.querySelector('.tax-input');

    qtyInput.value = '';
    taxInput.value = '';
    amountInput.value = '';
    
    // Get the selected option's data-rate attribute
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const rate = selectedOption.getAttribute('data-rate') || 0;
    const tax = selectedOption.getAttribute('data-gst') || 0;

    // Set the rate in the Rate input field
    rateInput.value = rate;
    taxInput.value = tax;

    // Calculate and set the amount
    const subtotal = rate * qty;
    const taxAmount = (tax / 100) * subtotal;  // Convert % to decimal
    const totalAmount = subtotal + taxAmount;
    amountInput.value = totalAmount.toFixed(2);


}

// Function to update the amount when quantity or tax changes
function updateAmount(inputElement) {
    const row = inputElement.closest('.row');
    const rateInput = row.querySelector('.rate-input');
    const qtyInput = row.querySelector('.qty-input');
    const taxInput = row.querySelector('.tax-input');
    const amountInput = row.querySelector('.amount-input');

    const rate = parseFloat(rateInput.value) || 0;
    const qty = parseFloat(qtyInput.value) || 0;
    const tax = parseFloat(taxInput.value) || 0;

    // Calculate the total amount (Rate * Quantity + Tax)
    const subtotal = rate * qty;
    const taxAmount = (tax / 100) * subtotal;  // Convert % to decimal
    const totalAmount = subtotal + taxAmount;

    amountInput.value = totalAmount.toFixed(2);

    updateSubtotal();
}

function updateSubtotal() {
    let total = 0;
    
    // Loop through all amount inputs
    document.querySelectorAll('.amount-input').forEach(input => {
        const amount = parseFloat(input.value) || 0;
        total += amount;
    });

    // Set subtotal value in the designated field
    document.getElementById('subtotal').value = total.toFixed(2);
    document.getElementById('finalTotal').value = total.toFixed(2);
    document.getElementById('finalTotalWords').innerText = numberToWords(Math.floor(finalTotal)) + " Rupees Only";


   updateFinalTotal();
}

function updateFinalTotal() {
    const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
    const discount = parseFloat(document.getElementById('discount').value) || 0;
    const adjustment = parseFloat(document.getElementById('adjustment').value) || 0;

    // Apply discount percentage
    const discountAmount = (discount / 100) * subtotal;
    const finalTotal = subtotal - discountAmount - adjustment;

    // Set final total
    document.getElementById('discounted_amount').value = discountAmount.toFixed(2);
    document.getElementById('finalTotal').value = finalTotal.toFixed(2);

    document.getElementById('finalTotalWords').innerText = numberToWords(Math.floor(finalTotal)) + " Rupees Only";
}

function numberToWords(num) {
    const a = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
    const b = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];

    function convert(n) {
      if (n < 20) return a[n];
      if (n < 100) return b[Math.floor(n / 10)] + (n % 10 ? " " + a[n % 10] : "");
      if (n < 1000) return a[Math.floor(n / 100)] + " Hundred" + (n % 100 ? " " + convert(n % 100) : "");
      if (n < 100000) return convert(Math.floor(n / 1000)) + " Thousand" + (n % 1000 ? " " + convert(n % 1000) : "");
      if (n < 10000000) return convert(Math.floor(n / 100000)) + " Lakh" + (n % 100000 ? " " + convert(n % 100000) : "");
    
     return "Number too large";
    }

    return num === 0 ? "Zero" : convert(num);
}

document.getElementById('discount').oninput = updateFinalTotal;
document.getElementById('adjustment').oninput = updateFinalTotal;

  // Add dynamic row with event listeners for `onchange` and `oninput`
document.getElementById('addRow').addEventListener('click', function () {
    const rowContainer = document.getElementById('rowContainer');
    
    // Create a new row without labels
    const newRow = document.createElement('div');
    newRow.className = 'row align-items-center mb-2';
    newRow.innerHTML = `
      <div class="col-3">
        <div class="form-group">
          <select class="form-control form-select border-black item-select" name="items[]" onchange="setAmount(this)">
            <option value="">Select</option>
            @foreach($products as $key => $value)
              <option value="{{$value->id}}"data-rate="{{$value->selling_price}}" data-gst="{{$value->gst}}" ata-igst="{{$value->igst}}" >{{$value->product_name}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-1">
        <div class="form-group">
          <input class="form-control qty-input" type="text" name="qty[]" oninput="updateAmount(this)" >
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
          <input class="form-control rate-input" type="text" name="rate[]" readonly>
        </div>
      </div>

      <div class="col-1">
        <div class="form-group">
          <input class="form-control tax-input" type="text" name="tax[]" onkeydown="numbersonly(event)">
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
          <input class="form-control amount-input" type="text" name="amount[]" readonly>
        </div>
      </div>
      
      <div class="col-1 d-flex align-items-center">
        <button type="button" class="btn btn-sm btn-danger removeRow">Remove</button>
      </div>
    `;

    // Add remove event listener for the new row
    newRow.querySelector('.removeRow').addEventListener('click', function () {
        newRow.remove();
         updateSubtotal();
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

  $(document).ready(function () {
    $(".qty-input, .tax-input").on("input", function () {
        updateAmount(this);
    });

    $(".item-select").on("change", function () {
        updateAmount(this);
    });

    $(".qty-input, .tax-input").on("input", function () {
        updateAmount(this);
    });


    $(".removeRow").on("click", function () {
        $(this).closest(".row").remove();
        updateSubtotal();
    });

    $("#addRow").on("click", function () {
        addNewRow();
    });
});


$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select an item",
        allowClear: true,
        width: '100%',// Ensures it adapts to the form-control width
        theme: 'bootstrap-5' 
    });
});

$(document).on("change keyup", ".qty-input, .rate-input, .tax-input", function() {
 
    updateRowTotal($(this).closest(".row"));
});


</script>




@endsection