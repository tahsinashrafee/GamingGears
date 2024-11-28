<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->


   @include('admin.css')
   <style type="text/css">
   	.center
   	{
   		margin: auto;
   		width: 100%;
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

          	<h1 class="font_size">Order List</h1>

          	<table class="center">
          		<tr class="th_color">
          			<th class="th_d">Name</th>
          			<th class="th_d">Email</th>
          			<th class="th_d">Phone</th>
          			<th class="th_d">Address</th>
          			<th class="th_d">Product Title</th>
          			<th class="th_d">Quantity</th>
          			<th class="th_d">Price</th>
          			<th class="th_d">Payment Status</th>
          			<th class="th_d">Delivery Status</th>
          			<th class="th_d">Image</th>
                <th class="th_d">Delivery</th>
          			<th class="th_d">Delete</th>
               
          			

          		</tr>

          		@foreach($order as $order)
          		<tr>
          			<td>{{$order->name}}</td>
          			<td>{{$order->email}}</td>
          			
          			<td>{{$order->phone}}</td>
          			<td>{{$order->address}}</td>
          			<td>{{$order->product_title}}</td>
          			<td>{{$order->quantity}}</td>
          			<td>{{$order->price}}</td>
          			<td>{{$order->payment_status}}</td>
          			<td>{{$order->delivery_status}}</td>

          			<td>
          				<img class="image_size" src="/product/{{$order->image}}">
          			</td>
                <td>
                  @if($order->delivery_status=='Processing')
                  <a class="btn btn-primary" onclick="return confirm('Are you sure the product is delivered?')"href="{{url('delivered',$order->id)}}">Delivered</a>
                  @elseif($order->delivery_status=='You haved canceled the order')
                  <p style="color: orange">Cancelled</p>

                  @else
                  <p style="color: yellow">Delivered</p>

                  @endif
                </td>

          			
          			
          			<td>
          				<a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('delete_order',$order->id)}}">Delete Order</a>
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