<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->paginate(4);

        return view('frontend.orders.index',compact('orders'));
    }

    public function show($orderId)
    {
        $order = Order::where('user_id',Auth::user()->id)->where('id',$orderId)->first();
        if($order)
        {
            return view('frontend.orders.view',compact('order'));
        }
        else
        {
            return redirect()->back()->with('message','No Order Found');
        }
    }

    public function cancelOrder($orderId)
    {
        $order = Order::where('id',$orderId)->first();

        if($order) 
        {
            $order->update([
                'status_message' => "canceled"
            ]);

            return redirect('orders');
        }
        else
        {
            return redirect('ordes')->with('message','Sorry Order ID not found');
        }
    }
}
