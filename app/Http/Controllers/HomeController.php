<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use App\Models\Category;

use Session;

use Stripe;



class HomeController extends Controller
{
	public function index()
	{
        $product=Product::paginate(3);
        return view('home.userpage',compact('product'));
    }


    public function redirect()
    {
    	$usertype=Auth::user()->usertype;

    	if ($usertype=='1')
    	{
    		return view('admin.home');
    	}
    	else
    	{
        $product=Product::paginate(3);
        return view('home.userpage',compact('product'));
    }
    }
    
    public function product_details($id)
    {
        $product=product::find($id);
        return view('home.product_details',compact('product'));
    }
    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
        {
           $user=Auth::user();
           $userid= $user->id;

           $product=Product::find($id);

           $product_exist_id=cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();


          if ($product->quantity >= $request->quantity)
          {
              if ($product_exist_id) 
               {
                    $cart=cart::find($product_exist_id)->first();
                    $quantity=$cart->quantity;
                    $cart->quantity = $quantity + $request->quantity;

                    if($product->discount_price)
                     {
                          $cart->price= $product->discount_price * $cart->quantity;
                     }
                     else
                     {
                          $cart->price= $product->price * $cart->quantity;
                     }

                    $cart->save();

                    $product->quantity = Product::where('id','=',$id)->decrement('quantity',$request->quantity); ///

                    return redirect()->back()->with('message','Product Added Sucessfully!');

               }
               else
               {
                     $cart=new cart;

                     $cart->name=$user->name;
                     $cart->email=$user->email;
                     $cart->phone=$user->phone;
                     $cart->address=$user->address;
                     $cart->user_id=$user->id;
                     $cart->product_title=$product->title;

                     if($product->discount_price)
                     {
                          $cart->price=$product->discount_price * $request->quantity;
                     }
                     else
                     {
                          $cart->price=$product->price * $request->quantity;
                     }
                     
                     $cart->image=$product->image;
                     $cart->product_id=$product->id;

                     $cart->quantity=$request->quantity;
                     $cart->save();

                     $product->quantity = Product::where('id','=',$id)->decrement('quantity',$request->quantity); ///

                     return redirect()->back()->with('message','Product Added Sucessfully!');
               }

          }
          
          else
          {
            return redirect()->back()->with('message','Not enough product available!');
          }

        }
        else
        {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;

        $cart=cart::where('user_id','=',$id)->get();

        return view('home.showcart',compact('cart'));
    }
        
        else
        {
           return redirect('login');
        }
    }
    public function remove_cart($id)
    {
        $cart=cart::find($id);
        $cart->delete();
        return redirect()->back();

    }
    public function cash_order()
    {
        $user=Auth::user();
        $userid=$user->id;
        $data=cart::where('user_id','=',$userid)->get();

        foreach ($data as $data) {
           $order=new order;
           $order->name=$data->name;
           $order->email=$data->email;
           $order->phone=$data->phone;
           $order->address=$data->address;
           $order->user_id=$data->user_id;
           $order->product_id=$data->product_id;
           $order->product_title=$data->product_title;
           $order->price=$data->price;
           $order->quantity=$data->quantity;

           $order->image=$data->image;

           $order->payment_status='Cash on Delivery';
           $order->delivery_status='Processing';
           $order->save();

           $cart_id=$data->id;
           $cart=cart::find($cart_id);
           $cart->delete();


        }
        return redirect()->back()->with('message','Your order is successfully placed.');

    }
    public function show_order()
    {
       if(Auth::id())
        { 
            $user=Auth::user();
            $userid=$user->id;
            $order=order::where('user_id',$userid)->get();
            return view('home.order',compact('order'));

        }
        else
        {
            return redirect('login');

        }
    }
    public function cancel_order($id)
    {
        $order=order::find($id);
        $order->delivery_status="You haved canceled the order";
        $order->save();
        return redirect()->back();
    }
    public function product_search(Request $request)
    { 
      
      $search_text=$request->search;
      $product=product::where('title','LIKE',$search_text.'%')->orWhere('category','LIKE',"$search_text")->paginate(10);

        return view('home.userpage', compact('product'));
    }
    public function stripe($totalprice)
    {
        return view('home.stripe',compact('totalprice'));
    }
    public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks." 
        ]);

        $user=Auth::user();
        $userid=$user->id;
        $data=cart::where('user_id','=',$userid)->get();

        foreach ($data as $data) {
           $order=new order;
           $order->name=$data->name;
           $order->email=$data->email;
           $order->phone=$data->phone;
           $order->address=$data->address;
           $order->user_id=$data->user_id;
           $order->product_id=$data->product_id;
           $order->product_title=$data->product_title;
           $order->price=$data->price;
           $order->quantity=$data->quantity;

           $order->image=$data->image;

           $order->payment_status='Paid using Card';
           $order->delivery_status='Processing';
           $order->save();

           $cart_id=$data->id;
           $cart=cart::find($cart_id);
           $cart->delete();


        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
    public function products()
    {
      $product=Product::all();
      $category=Category::all();

      return view('home.all_product',compact('product','category'));
    }
    public function teams()
    {
      return view('home.teams');
    }



        
}
