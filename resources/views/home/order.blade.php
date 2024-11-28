<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Gaming Gears</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      <style type="text/css">
   	.center
   	{
          margin: auto;
          width: 70%;
          text-align: center;
          padding: 70px;


        }
        table,th,td
        {
          border: 1px solid grey;

        }
        .th_deg
        {font-size: 20px;
          padding: 5px;
          background: skyblue;

        }
        .img_deg
        {
          height: 200px;
          width:  200px;
        }
        
      .font_size
      {
        text-align: center;
       font-size: 40px;
       padding-bottom: 40px;
      }

	</style>
   </head>
   <body>

    

      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         
       

          	<table class="center">
          		<tr class="th_color">
          		
          			<th class="th_deg">Product Title</th>
          			<th class="th_deg">Quantity</th>
          			<th class="th_deg">Price</th>
          			<th class="th_deg">Payment Status</th>
          			<th class="th_deg">Delivery Status</th>
          			<th class="th_deg">Image</th>
          			<th class="th_deg">Action</th>
                <th class="th_deg">Action</th>
          			

          		</tr>

          		@foreach($order as $order)
          		<tr>
          			
          			<td>{{$order->product_title}}</td>
          			<td>{{$order->quantity}}</td>
          			<td>{{$order->price}}</td>
          			<td>{{$order->payment_status}}</td>
          			<td>{{$order->delivery_status}}</td>

          			<td>
          				<img class="img_deg" src="/product/{{$order->image}}">
          			</td>

          			
          			
          			<td>

          				@if($order->delivery_status=='Processing')
          				<a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('cancel_order',$order->id)}}">Cancel Order</a>

          				@else
          				<p style="color: blue">No Action</p>

          				@endif

                <td>
                  <a class="btn btn-danger" onclick="confirmation(event)"  href="">Contact Support </a>
                </td>

          			</td>
          			
          		</tr>

          	@endforeach
          		


          	</table>





      </div>

      <script>
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        console.log(urlToRedirect); 
        swal({
            title: "Are you facing any problem with your order?",
            text: "Please call on the given number to directly seek solution!  +8801793131323 ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel) => {
            if (willCancel) {


                 
                window.location.href = urlToRedirect;
               
            }  


        });

        
    }
</script>


      <!-- jQery -->
      <script src="js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
</html>