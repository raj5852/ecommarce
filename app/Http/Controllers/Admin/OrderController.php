<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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
    function update(int $orderId, Request $request)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order) {
            $order->update([
                'status_message' => $request->order_status
            ]);
            return  redirect('admin/orders/' . $order->id)->with('message', 'Order Status Updated');
        } else {
            return redirect('admin/orders/' . $order->id);
        }
    }

    function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice', compact('order'));
    }
    function generateInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);

        $data = ['order'=>$order];
        $todayDate = Carbon::now()->format('d-m-Y');
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        return $pdf->download('invoice'.$order->id.'-'.$todayDate.'pdf');
    }
}
