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
        <button class="btn btn-success">Add to Cart</button>

        </form>
        <br>
          <button class="btn btn-primary">Buy Now</button>






        </div>      
    </div>
</div>

 @endsection