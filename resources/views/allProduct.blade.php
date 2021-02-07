@extends('master')


@section('content')
	<div class="greyBg">
	    <div class="container">
			<div class="wrapper">
				
			    <h1 class="text-center">E-Com </h1>
			    <div class="row">
                <div class="col-xs-6 col-sm-3">
							<select id="selectbox1">
                            <option value="">Category</option>
							    <option value="mobile">Mobile</option>
							    <option value="wm">Washing Machine</option>
							    <option value="watch">Watch</option>
							    <option value="tv">Tv</option>
							    <option value="printer">printer</option>
							</select>
					    </div>
					    
				
					<div class="col-sm-6 hidden-xs">
						<div class="row">
	
							<div class="col-sm-4 pull-right">
								<select id="selectbox3">
								    <option value="">Sort By Price</option>
								    <option value="aye">Low to High</option>
								    <option value="eh">High to Low</option>
								    
								</select>
							</div>
							
						</div>	
					</div>
			    </div>
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
		    	</div>
			</div>
		</div>		
	</div>
@endsection
	