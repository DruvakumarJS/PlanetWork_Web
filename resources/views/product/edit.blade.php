@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">  
           <label class="bold">Edit Product</label>

          <div id="div2">
            <a href="{{route('products')}}"><button class="btn btn-outline-secondary">GO Back</button></a>
          </div>
           
        </div>
 
       
        <div class="py-2">
           <form method="POST" action="{{ route('update_product',$data->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           <div class="row">
             <div class="col-8">

               <div class="row py-2">
                 <div class="col-4">
                   <div class="form-group">
                     <label>Product Type</label>
                     <select class="form-control form-select border-black" name="type"  required>
                       <option {{ ($data->product_type == 'Product')? 'selected':''}} value="Product">Product</option>
                       <option {{ ($data->product_type == 'Product')? 'selected':''}} value="Service">Service</option>
                     </select>
                   </div>
                 </div>

                 <div class="col-4">
                   <div class="form-group">
                     <label>Product Name</label>
                     <input type="text" class="form-control" name="name" value="{{$data->product_name}}" required>
                   </div>
                 </div>
               </div>

               <div class="row py-2">
                 <div class="col-4">
                   <div class="form-group">
                     <label>Tax Preference</label>
                      <select class="form-control form-select border-black" name="tax_preference" id="tax_preference" required>
                        <option {{ ($data->product_type == 'Product')? 'selected':''}} value="Non-Taxable">Non-Taxable</option>
                        <option {{ ($data->product_type == 'Product')? 'selected':''}} value="Taxable">Taxable</option>
                      </select>
                   </div>
                 </div>

               </div>

               <div class="row py-2">
                 <div class="col-4">
                   <div class="form-group">
                     <label>SKU</label>
                     <input type="text" class="form-control" name="sku" value="{{$data->sku}}">
                   </div>
                 </div>

                 <div class="col-4">
                   <div class="form-group">
                     <label>HSN Code</label>
                     <input type="text" class="form-control" name="hsn" value="{{$data->hsn_code}}">
                   </div>
                 </div>

               </div>

               <div class="row py-2">
                
                 <div class="col-4">
                   <div class="form-group">
                     <label>Selling Price</label>
                     <input type="text" class="form-control" name="price"  onkeypress='numbersonly(event)' min='0.1' step=".01" oninput="validateDecimal(this)" value="{{$data->selling_price}}">
                   </div>
                 </div>

                 <div class="col-4">
                   <div class="form-group">
                     <label>Units</label>
                     <input type="text" class="form-control" name="units" value="{{$data->units}}">
                   </div>
                 </div>

               </div>

               <div class="row">
                 <div class="col-8">
                   <div class="form-group">
                     <label>Product Description</label>
                     <textarea class="form-control border-black" name="desc">{{$data->product_desc}}</textarea>
                   </div>
                 </div>
               </div>

               <label class="font1-bold py-4">Default Tax Rate</label>

               <div class="row">
                 <div class="col-4">
                   <div class="form-group">
                     <label>GST (Intra State Tax)</label>
                     <select class="form-control form-select border-black" name="intra" id="intra">
                        <option value="">Select</option>
                        <option {{ ($data->gst == '0')? 'selected':''}} value="0">GST 0(0%)</option>
                        <option {{ ($data->gst == '5')? 'selected':''}} value="5">GST 5(5%)</option>
                        <option {{ ($data->gst == '8')? 'selected':''}} value="8">GST 8(8%)</option>
                        <option {{ ($data->gst == '12')? 'selected':''}} value="12">GST 12(12%)</option>
                        <option {{ ($data->gst == '18')? 'selected':''}} value="18">GST 18(18%)</option>
                        <option {{ ($data->gst == '28')? 'selected':''}} value="28">GST 28(28%)</option>
                      </select>
                   </div>
                 </div>
               </div>

               <div class="row py-2">
                 <div class="col-4">
                   <div class="form-group">
                     <label>IGST (Inter State Tax)</label>
                     <select class="form-control form-select border-black" name="inter" id="inter">
                        <option value="">Select</option>
                        <option {{ ($data->igst == '0')? 'selected':''}} value="0">GST 0(0%)</option>
                        <option {{ ($data->igst == '5')? 'selected':''}} value="5">GST 5(5%)</option>
                        <option {{ ($data->igst == '8')? 'selected':''}} value="8">GST 8(8%)</option>
                        <option {{ ($data->igst == '12')? 'selected':''}} value="12">GST 12(12%)</option>
                        <option {{ ($data->igst == '18')? 'selected':''}} value="18">GST 18(18%)</option>
                        <option {{ ($data->igst == '28')? 'selected':''}} value="28">GST 28(28%)</option>
                      </select>
                   </div>
                 </div>
               </div>


             </div>

             <div class="col-4 mt-5">
                <div class="card justify-content-center text-center" style="height: 400px; width: 400px; cursor: pointer;">
                  <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;" />
                  
                  <img id="imagePreview" src="{{url('/')}}/product_images/{{$data->product_image}}" alt="Upload Image" class="img-fluid" style="display: {{ ($data->product_image != '')?'block':'none'; }}'; height: 100%; object-fit: cover; border-radius: 10px;" />
                </div>
              </div>


           </div>
           
           <div class="d-flex">
             <button type="submit" class="ms-auto btn btn-sm btn-dark">Update</button>
           </div>

           </form>
            
        </div>
    </div>  
</div>



<script>
  document.querySelector('.card').addEventListener('click', function () {
    document.getElementById('imageInput').click();
  });

  document.getElementById('imageInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById('imagePreview').src = e.target.result;
        document.getElementById('imagePreview').style.display = 'block';
        document.getElementById('previewContainer').style.display = 'none';
      };
      reader.readAsDataURL(file);
    }
  });

   $('#tax_preference').on('change', function() {
    alert(this.value);
    if (this.value == 'Taxable') {
        $('#inter').prop('required',true);
        $('#intra').prop('required',true);

    }
    else if (this.value == 'Non-Taxable') {
        $('#inter').prop('required',false);
        $('#intra').prop('required',false);
    }
  });
</script>




@endsection