@extends('master')


@section('content')
	<div class="greyBg">
	    <div class="container">
			<div class="wrapper">

<script>
$(function() {
	if(localStorage.getItem('category')){
        $('#ct').val(localStorage.getItem('category')).trigger('change');;
    }
	else {
		
    $('#ct').change(function() {
        localStorage.setItem('category', this.value);
    });
    if(localStorage.getItem('category')){
        $('#ct').val(localStorage.getItem('category')).trigger('change');;
    }
}
	$('#pr').change(function() {
        localStorage.setItem('price', this.value);
    });
    if(localStorage.getItem('price')){
        $('#pr').val(localStorage.getItem('price')).trigger('change');;
    }
});
</script>

			    <!-- <h1 class="text-center">E-Com </h1>
			 -->

			    <div class="row">
                <div class="col-xs-6 col-sm-3">

				<form action="/productCat" method="get">
				{{csrf_field()}}
					<select name="ct">
                            <option value="" >Category</option>
							 <option value="mobile">Mobile</option> 
							    <option value="washing machine">Washing Machine</option>
							    <option value="watch">Watch</option>
							    <option value="tv">Tv</option>
							    <option value="printer">Printer</option>
								<option value="all">All</option>
							</select>
					
					    </div>
					    
						<div class="col-xs-6 col-sm-3">
						
					<input type="number" value="Paginate" name="paginate" min="1" placeholder="Paginate" size=8>

						</div>
				
					<div class="col-sm-6 hidden-xs">
						<div class="row">
	
							<div class="col-sm-4">
								<select name="pr">
								    <option value="">Sort By Price</option>
								    <option value="asc">Low to High</option>
								    <option value="desc">High to Low</option>
								    
								</select>
							</div>
							<input type="submit" value="Submit" class="btn btn-primary">
						</div>	
						
					</div>
					
					
				</form>
			    </div>
				{{$products->links()}}
		    	<div class="row top25">
			
                @foreach($products as $item)
	
                    <div class="col-xs-6 col-sm-4">
		    			<div class="itemBox">
                        <a href="detail/{{$item['id']}}"> 
		    				<div class="prod"><img class="slider-img1" src="{{$item['gallery']}}" alt="" /></div>
		    				<label>{{$item['name']}}</label>
		    				
                            <br>
                            <span class="hidden-xs">{{$item['description']}}</span>
		    				<div class="addcart">
		    					<div class="price">Rs {{$item['price']}}</div>
		    					<div class="cartIco hidden-xs"><a href="/"></a></div>
		    				</div>
		    			</div>
                        </a>
		    		</div>
		    		@endforeach
                   </div>
				   {{$products->links()}}
		    	</div>
			</div>
		</div>		
	</div>
@endsection
	