<?php

namespace App\Http\Controllers;

use App\Models\Lookup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class LookupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = DB::table('users')
        ->where('phone', $request->phone)
        ->select('id')
        ->get();

        if(count($user) != 0){
            $order = DB::table('orders')
            ->where('user_id', $user[0]->id)
            ->where('id', $request->id)
            ->select('id')
            ->get();

            if (count($order) != 0) {
                if ($order[0]->id == $request->id ) {
                    $data = DB::table('order_detail')
                    ->where('order_id', $request->id)
                    ->join('product', 'order_detail.product_id', '=', 'product.id')
                    ->join('orders', 'order_detail.order_id', '=', 'orders.id')
                    ->select('order_detail.order_id', 'order_detail.qty', 'order_detail.price', 'product.name', 'product.img', 'orders.status', 'orders.orderTime')
                    ->get();

                    return view('shipping', compact('data'));
                }
            }
        }
            return view('shipping', [
                'data' => array()
            ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lookup  $lookup
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lookup  $lookup
     * @return \Illuminate\Http\Response
     */
    public function edit(Lookup $lookup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lookup  $lookup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lookup $lookup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lookup  $lookup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lookup $lookup)
    {
        //
    }
}