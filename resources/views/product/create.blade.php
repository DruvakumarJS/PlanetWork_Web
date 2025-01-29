@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">  
           <label class="bold">Create New Product</label>

          <div id="div2">
            <a href="{{route('products')}}"><button class="btn btn-outline-secondary">GO Back</button></a>
          </div>
           
        </div>
 
       
        <div class="py-2">
           <form method="POST" action="{{ route('save_product')}}" enctype="multipart/form-data">
            @csrf
           <div class="row">
             <div class="col-8">

               <div class="row py-2">
                 <div class="col-4">
                   <div class="form-group">
                     <label>Product Type</label>
                     <select class="form-control form-select border-black" name="type"  required>
                       <option value="Product">Product</option>
                       <option value="Service">Service</option>
                     </select>
                   </div>
                 </div>

                 <div class="col-4">
                   <div class="form-group">
                     <label>Product Name</label>
                     <input type="text" class="form-control" name="name" required>
                   </div>
                 </div>
               </div>

               <div class="row py-2">
                 <div class="col-4">
                   <div class="form-group">
                     <label>Tax Preference</label>
                      <select class="form-control form-select border-black" name="tax_preference" id="tax_preference" required>
                        <option value="Non-Taxable">Non-Taxable</option>
                        <option value="Taxable">Taxable</option>
                      </select>
                   </div>
                 </div>

               </div>

               <div class="row py-2">
                 <div class="col-4">
                   <div class="form-group">
                     <label>SKU</label>
                     <input type="text" class="form-control" name="sku" >
                   </div>
                 </div>

                 <div class="col-4">
                   <div class="form-group">
                     <label>HSN Code</label>
                     <input type="text" class="form-control" name="hsn">
                   </div>
                 </div>

               </div>

               <div class="row py-2">
                
                 <div class="col-4">
                   <div class="form-group">
                     <label>Selling Price</label>
                     <input type="text" class="form-control" name="price"  onkeypress='numbersonly(event)' min='0.1' step=".01" oninput="validateDecimal(this)">
                   </div>
                 </div>

                 <div class="col-4">
                   <div class="form-group">
                     <label>Units</label>
                     <input type="text" class="form-control" name="units">
                   </div>
                 </div>

               </div>

               <div class="row">
                 <div class="col-8">
                   <div class="form-group">
                     <label>Product Description</label>
                     <textarea class="form-control border-black" name="desc"></textarea>
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
                        <option value="0">GST 0(0%)</option>
                        <option value="5">GST 5(5%)</option>
                        <option value="8">GST 8(8%)</option>
                        <option value="12">GST 12(12%)</option>
                        <option value="18">GST 18(18%)</option>
                        <option value="28">GST 28(28%)</option>
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
                        <option value="0">GST 0(0%)</option>
                        <option value="5">GST 5(5%)</option>
                        <option value="8">GST 8(8%)</option>
                        <option value="12">GST 12(12%)</option>
                        <option value="18">GST 18(18%)</option>
                        <option value="28">GST 28(28%)</option>
                      </select>
                   </div>
                 </div>
               </div>


             </div>

             <div class="col-4">
                <div class="card justify-content-center text-center" style="height: 400px; width: 400px; cursor: pointer;">
                  <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;" />
                  <div class="text-center" id="previewContainer" >
                    <i class="fa fa-camera fa-3x"></i>
                    <br>
                    <span>Upload Product Images</span>
                  </div>
                  <img id="imagePreview" src="#" alt="Preview" class="img-fluid" style="display: none; height: 100%; object-fit: cover; border-radius: 10px;" />
                </div>
              </div>


           </div>
           
           <div class="d-flex">
             <button type="submit" class="ms-auto btn btn-sm btn-dark">Save </button>
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