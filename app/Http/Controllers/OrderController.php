<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')
            ->where('user_id', Auth::user()->id)
            ->get();
        $result = array();
        foreach ($orders as $order) {
            $order_details = DB::table('order_detail')
                ->join('product', 'order_detail.product_id', '=', 'product.id')
                ->where('order_id', $order->id)
                ->get();
            $items = array();
            foreach ($order_details as $order_detail) {
                $items[] = array(
                    'name' => $order_detail->name,
                    'qty' => $order_detail->qty,
                    'price' => $order_detail->price,
                    'img' => $order_detail->img,
                );
            }
            $result[] = array(
                'id' => $order->id,
                'status' => $order->status,
                'total' => $order->total,
                'orderTime' => $order->orderTime,
                'pay' => $order->pay,
                'items' => $items,
            );
        }
        return view('history', ['orders' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        $items = DB::table('cart')
            ->where('userId', $request->user)
            ->get();
        $order = new Order();
        $order->user_id = $user_id;
        $order->status = 0;
        $order->total = $request->qty;
        $order->orderTime = now("Asia/Ho_Chi_Minh");
        $order->pay = 0;
        

        $cart = DB::table('cart')
            ->where('userId', $user_id)
            ->get();
        $order->save();
        
        foreach ($cart as $item) {
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $item->productId;
            $order_detail->qty = $item->qty;
            $order_detail->price = $item->price;
            $order_detail->serial = "";
            $order_detail->save();
        }
        DB::table('cart')
            ->where('userId', $user_id)
            ->delete();
        $order->save();
        return redirect('/order');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $order)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->status;
        $order->save();
        if ($request->status == 1) {
            return redirect('/admin/ship')->with('status', 'Đã chấp nhận đơn hàng');
        }
        return redirect('/admin/ship')->with('status', 'Đã hủy đơn hàng');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}