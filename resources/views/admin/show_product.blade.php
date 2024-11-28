<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
   @include('admin.css')
   <style type="text/css">
   	.center
   	{
   		margin: auto;
   		width: 70%;
   		border: 2px solid white;
   		text-align: center;
        margin-top: 40px;
   	}
   	.font_size
	{
	    text-align: center;
	    font-size: 40px;
	    padding-bottom: 40px;
	} 
	.image_size
	{
		width: 150px;
		height: 150px;
	}
	.th_color
	{
		background: red; 
	}
	.th_d
	{
		padding: 30px;
	}

   	




   </style>
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
       @include('admin.header')
      <div class="main-panel">

          <div class="content-wrapper">

          	@if(session()->has('message'))

            <div class="alert alert-success">

              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

              {{session()->get('message')}}

             </div>

            @endif

          	<h1 class="font_size">Show Product</h1>

          	<table class="center">
          		<tr class="th_color">
          			<th class="th_d">Product Title</th>
          			<th class="th_d">Description</th>
          			<th class="th_d">Category</th>
          			<th class="th_d">Quantity</th>
          			<th class="th_d">Price</th>
          			<th class="th_d">Discount Price</th>
          			<th class="th_d">Image</th>
          			<th class="th_d">Edit</th>
          			<th class="th_d">Delete</th>
          			

          		</tr>

          		@foreach($product as $product)
          		<tr>
          			<td>{{$product->title}}</td>
          			<td>{{$product->description}}</td>
          			
          			<td>{{$product->category}}</td>
          			<td>{{$product->quantity}}</td>
          			<td>{{$product->price}}</td>
          			<td>{{$product->discount_price}}</td>
          			<td>
          				<img class="image_size" src="/product/{{$product->image}}">
          			</td>

          			<td>
          				<a class="btn btn-primary" href="{{url('update_product',$product->id)}}">Edit</a>
          			</td>
          			
          			<td>
          				<a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('delete_product',$product->id)}}">Delete</a>
          			</td>
          			
          		</tr>

          		@endforeach
          		


          	</table>




          </div>
      </div>
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>