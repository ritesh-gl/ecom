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
        <script>
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
            counter-- ;

            $('#TextBox').val(counter);
    });
});
     </script>
   
      
     <div class="col-sm-4">
     <input type="button" value="-"   id="rem">
     <input type="text" size=2 name="quant" id="TextBox" value="1" />
     <input type="button"  value="+"   id="add">
     </div>
        <button class="btn btn-success">Add to Cart</button>

        </form>
        <br>
          <button class="btn btn-primary">Buy Now</button>






        </div>      
    </div>
</div>

 @endsection