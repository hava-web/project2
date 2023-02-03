<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Mail\InvoiceOrderMailable;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class OrderControllers extends Controller
{
    public function index(Request $request)
    {
        $count = Order::where('status_message','in progress')->count();
        $todayDate = Carbon::now()->format('Y-m-d');
        $date = Carbon::now();
        $dateNow =  Carbon::parse($todayDate)->timestamp;
        // $order1 = Order::where('user_id',auth()->user()->id)->first()->created_at;
        // $datePro =  Carbon::parse($order1)->timestamp;
        // $time = $date->addDays(1)->format('Y-m-d');
        // $sub = CarbonInterval::seconds($dateNow - $datePro)->cascade()->forHumans();

        $orders = Order::when($request->date != null,function($q) use ($request){
                return $q->whereDate('created_at',$request->date);
        })
                        ->when($request->status != null,function($q) use ($request){
                 return $q->where('status_message',$request->status);
        })
                        ->paginate(10);
        return view('admin.orders.index',compact('orders','todayDate','dateNow'));
    }

    public function dashboard(Request $request)
    {
        $orderInfors = Order::when($request->date != null,function($q) use ($request){
            return $q->whereDate('created_at',$request->date);
    })
                    ->when($request->status != null,function($q) use ($request){
             return $q->where('status_message',$request->status);
    })
                    ->paginate(10);
        return view('admin.dashboard',compact('orderInfors'));
    }

    public function show($orderId)
    {
        $orders = Order::where('id',$orderId)->first();
        if($orders)
        {
            return view('admin.orders.view',compact('orders'));
        }
        else
        {
            redirect('admin/orders')->with('message','Order Not Found');
        }
    }

    public function updateOrderStatus(int $orderId, Request $request)
    {
        $order = Order::where('id',$orderId)->first();

        if($order)
        {
            $order->update([
                'status_message' => $request->order_status
            ]);
            return redirect('admin/orders/'.$orderId)->with('message','Order Status Updated');
        }
        else
        {
            return redirect('admin/orders/')->with('message','Order ID not found');
        }
    }

    public function viewInvoice(int $ordeId)
    {
        $order = Order::findOrFail($ordeId);
        return view('admin.invoice.generate-invoice',compact('order'));
    }

    public function generateInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $todayDate = Carbon::now()->format('Y-m-d');
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');
    }

    public function mailInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $email = User::where('id',$order->user_id)->first()->email;
        try
        {
            Mail::to("$email")->send(new InvoiceOrderMailable($order));
            return redirect('admin/orders/'.$orderId)->with('message','Invoice Mail has been sent to '.$email);
        }
        catch(\Exception $e)
        {
            return redirect('admin/orders/'.$orderId)->with('message','Somthing went wrong !');

        }

    }
}
