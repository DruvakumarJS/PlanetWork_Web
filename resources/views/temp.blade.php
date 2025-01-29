@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
          <div id="div2">
            <a href=""><button class="btn btn-outline-secondary">Create</button></a>
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
 
       
        <div>
           <label class="bold" style="margin-left: 20px" >Audit Trail</label>

        
                   
        </div>
    </div>  
</div>








@endsection