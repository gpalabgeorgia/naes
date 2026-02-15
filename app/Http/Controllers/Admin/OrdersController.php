<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function orders() {
        Session::put('page', 'orders');
        $orders = Order::with('orders_products')->orderBy('id', 'Desc')->get()->toArray();
        return view('admin.orders.orders')->with(compact('orders'));
    }
    public function orderDetails($id) {
        $orderDetails = Order::with('orders_products')->where('id', $id)->first()->toArray();
        $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();
        $orderStatuses = OrderStatus::where('status', 1)->get()->toArray();
        return view('admin.orders.order_details')->with(compact('orderDetails', 'userDetails', 'orderStatuses'));
    }

    public function updateOrderStatus(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            // Update Order Status
            Order::where('id', $data['order_id'])->update(['order_status'=>$data['order_status']]);
            Session::put('success_message', 'შეკვეთის სტატუსი წარმატებით გაახლდა!');
            return redirect()->back();
        }
    }
}
