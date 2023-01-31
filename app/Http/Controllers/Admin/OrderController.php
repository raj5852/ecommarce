<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    //
    function index(Request $request)
    {


        // $today = '2023-01-31';
        // // Carbon::now();
        // $orders = Order::whereDate('created_at',$today)->paginate(100);

        $today = Carbon::now()->format('Y-m-d');

        $orders = Order::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        }, function ($q) use ($today) {
            $q->whereDate('created_at', $today);
        })
            ->when($request->status != null, function ($q) use ($request) {
                return $q->where('status_message', $request->status);
            })->paginate(10);


        return view('admin.orders.index', compact('orders'));
    }
    function show(int $orderrId)
    {
        $order = Order::where('id', $orderrId)->first();
        if ($order) {
            return view('admin.orders.view', compact('order'));
        } else {
            return redirect('admin/orders');
        }
    }
}
