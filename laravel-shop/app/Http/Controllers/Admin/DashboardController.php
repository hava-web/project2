<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $earnings = Order::select(
            DB::raw('sum(total_price) as sums'), 
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
            )
            ->where('status_message','completed')
            ->groupBy('months')
            ->get();

        $total = Order::select(
            DB::raw('sum(total_price) as total')
            )
            ->where('status_message','completed')
            ->get();

        $orders = Order::where('status_message','!=','canceled')->count();

        //Data Chart 
        $data = Order::select('id','created_at')->where('status_message','!=','canceled')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });
        // $earning = Order::select(DB::raw('sum(total_price) as sums'),'created_at')->where('status_message','completed')->get()->groupBy(function($data){
        //     return Carbon::parse($data->created_at)->format('M');
        // });
        $months = [];
        $monthCount = [];
        foreach($data as $month => $value)
        {
            $months[] = $month;
            $monthCount[] = count($value);
        }

        $customers = Customer::count();

        $orders_pending = Order::where('status_message','pending')->count();

        $orderInfors = Order::when($request->date != null,function($q) use ($request){
            return $q->whereDate('created_at',$request->date);
    })
                    ->when($request->status != null,function($q) use ($request){
             return $q->where('status_message',$request->status);
    })
                    ->paginate(10);
        return view('admin.dashboard',['data'=>$data,'months'=>$months,'monthCount'=>$monthCount],compact('earnings','total','orders','orders_pending','customers','orderInfors','data'));
    }
    

    
}
