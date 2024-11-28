<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
   <base href="/public">
   @include('admin.css')

   <style type="text/css">

      .div_center
      {
        text-align: center;
        padding-top: 40px;

      }  
      .font_size
      {
        font-size: 40px;
        padding-bottom: 40px;
      } 

      .text_color
      {
        color: black;
        padding-bottom: 20px;


      }
      label{

        display: inline-block;
        width: 200px;

      }
      .div_design{
        padding-bottom: 50px;
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
              
            <div class="div_center">


              <h1 class="font_size">Update Product</h1>

              <form action="{{url('/update_product_confirm',$product->id)}}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="div_design">
              <label>Product Title</label>
              <input class="text_color" type="text" name="title" placeholder="Write a title" required="" value="{{$product->title}}" >
              </div>

             

              <div class="div_design">
              <label>Product Description</label>
              <input class="text_color" type="text" name="Description" placeholder="Write a description" required="" value="{{$product->description}}">
              </div>

              <div class="div_design">
              <label>Product Price</label>
              <input class="text_color" type="number" name="Price" placeholder="Write a Price" required="" value="{{$product->price}}">

              </div>
              <div class="div_design">
              <label>Discount</label>
              <input class="text_color" type="number" name="Discount" placeholder="Discount" value="{{$product->discount_price}}">
              </div>


              <div class="div_design">
              <label>Product Quantity</label>
              <input class="text_color" type="number" min="0" name="Quantity" placeholder=" Quantity" required="" value="{{$product->quantity}}">
              </div>
              
              <div class="div_design">
              <label>Product Category</label>
              <select class="text_color" name="Category" required="" >
                <option value="{{$product->category}}" selected=""> {{$product->category}} </option>

                @foreach($category as $category)
                <option>{{$category->category_name}}</option>

                @endforeach
                
              </select>
              </div>

              <div class="div_design">
              <label>Current Product Image</label>
              <img style="margin: auto;" height="100" width="100" src="/product/{{$product->image}}">
              
              </div>

              <div class="div_design">
              <label>Change Product Image</label>
              <input type="file" name="image" >
              </div>

              <div class="div_design">
              
              <input type="submit" value="Update Product"class="btn btn-primary">
              </div>

              </form>

              

            </div>

          </div>
        </div>
        
    @include('admin.script')
    
  </body>
</html>