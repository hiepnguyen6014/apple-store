<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        print_r($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id == 'product') {
            $products = DB::table('product')->get();
            $products_detail = DB::table('product_detail')->get();
        return view('admin.product', [
            'products' => $products,
            'products_detail' => $products_detail
        ]);
        }
        else if ($id == 'ship') {
            $ship = DB::table('orders')
            ->where('status', '=', '0')
            ->orWhere('status', '=', '1')
            ->get();

            foreach ($ship as $value) {
                $value->items = DB::table('order_detail')
                ->join('product', 'order_detail.product_id', '=', 'product.id')
                ->where('order_id', '=', $value->id)
                ->select('order_detail.*', 'product.name', 'product.sellQty', 'product.img')
                ->get();
            }
            return view('admin.ship', [
                'ships' => $ship
            ]);
        }
        else if ($id == 'history') {
            $history = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('status', '>', '1')
            ->select('orders.*', 'users.phone')
            ->get();

            foreach ($history as $order) {
                $order->item = DB::table('order_detail')
                ->join('product', 'product.id', '=', 'order_detail.product_id')
                ->where('order_id', '=', $order->id)
                ->select('order_detail.qty', 'order_detail.price', 'product.name', 'order_detail.serial', 'product.img')
                ->get();
            }

            return view('admin.history', [
                'histories' => $history
            ]);
        }
        else if ($id == 'employee') {
            $users = DB::table('users')->where('role', '>', '1')->get();
            return view('admin.employee',['users' => $users]);
        }
        else if ($id == 'user') {
            $users = DB::table('users')->where('role', '=', '0')->get();
        return view('admin.user', ['users' => $users]);
        }
        else if ($id == 'discount') {
            $discounts = DB::table('product')
            ->where('sale', '=', '1')
            ->get();

            $time = DB::table('discount')
            ->take(1)
            ->get();
            return view('admin.discount', [
                'discounts' => $discounts,
                'time' => $time
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
