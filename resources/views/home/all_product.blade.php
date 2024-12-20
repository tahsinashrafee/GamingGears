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

      <style type="text/css">
      
      .font_size
   {
        font-size: 40px; font-family: 'Signika', sans-serif; padding-bottom: 5px; 
       color: #700a2a; text-align: center; 

   } 
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
      @include('home.header')
       @if(session()->has('message'))

            <div class="alert alert-success">

              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

              {{session()->get('message')}}

             </div>

            @endif

         
         @foreach($category as $category)
         <h1 class="font_size"> {{$category->category_name}}</h1>

         @foreach ($product as $products)
         @if($products->category == $category->category_name)
         

         <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details',$products->id)}} " class="option1">
                           Product Details
                           </a>



                           <form action="{{url('add_cart',$products->id)}}" method="Post">

                              @csrf

                              <div class="row">

                                 <div class="col-md-4" style="padding: 25px">
                                 <input type="number" name="quantity" value="1" min="1" style="width: 100px">
                              </div>

                              <div class="col-md-4" style="padding-top : 20px">
                                 <input type="submit" value="Add To Cart">

                                 </div>
                              
                              
                              </div>

                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product/{{$products->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$products->title}}

                        </h5>

                        @if($products->discount_price!=null)
                        <h6 style="color: green">
                           Discount price
                           <br>
                           ${{$products->discount_price}}
                        </h6>

                        <h6 style="text-decoration: line-through; color: blue">
                           Price
                           <br>
                           ${{$products->price}}
                        </h6>

                        @else
                        <h6 style="color: blue">
                           Price
                           <br>
                           ${{$products->price}}
                        </h6>


                        @endif


                        



                        
                     </div>
                  </div>
               
               </div>
               </div>
               </div>
               


         @endif



         


         @endforeach



        
         @endforeach


      </div>
   </section>

      
      <!-- footer end -->
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
   </body>
</html>