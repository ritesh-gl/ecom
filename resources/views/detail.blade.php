@extends('master')

@section('content')
 <div class=" container ">
    <div class="row">
        <div class="col-sm-6">

        <img class="detail-img" src="{{$products['gallery']}}" alt="">

        </div>
        <div class="col-sm-6">
        <a href="/">  Go Back </a>
        <h2> Name: {{$products['name']}} </h2>
        <h3> Price: {{$products['price']}} </h3>
        <h4> Category: {{$products['category']}} </h4>
        <h4> Description: {{$products['description']}} </h4>

        <br><br>
        <form action="/add_to_cart" method="post">
        
        <input type="hidden" name="product_id" value="{{$products['id']}}">
        {{ csrf_field() }}
        <!-- <script>
  $(document).ready(function(){
        //var counter = $('#TextBox').val();
        $('#add').click( function() {
            var counter = $('#TextBox').val();
            counter++ ;
            $('#TextBox').val(counter);
    });
    $('#rem').click( function() {
            var counter = $('#TextBox').val();
            if(counter==1)
            {
              $('#TextBox').val(0);
            }
            else
            if(counter>0)
            counter-- ;

            $('#TextBox').val(counter);
    });
});
     </script> -->
   
      <?php 
      if($products['quantity']==0)
      {
        ?>
        <script> alert ("No item left");
        window.location = '/products';
         </script>
        <?php
      }
      ?>
     <div class="col-sm-4">
     <!-- <input type="button" value="-"   id="rem"> -->
     <input type="number" style="width: 4em" name="quant" id="TextBox" value="1" min=1 max="{{$products['quantity']}}" />
     <!-- <input type="button"  value="+"   id="add"> -->
     </div>
        <button  class="btn btn-primary">Add to Cart</button>

          <button formaction="/buyNow" class="btn btn-success" >Buy Now</a>
         
          </form>
        </div>  
         <div>
         </div>   
    </div>
</div>

 @endsection