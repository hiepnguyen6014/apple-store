<?php

namespace App\Http\Controllers;

use App\Models\OrderAcp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderAcpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderAcp  $orderAcp
     * @return \Illuminate\Http\Response
     */
    public function show(OrderAcp $orderAcp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderAcp  $orderAcp
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderAcp $orderAcp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderAcp  $orderAcp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $orderAcp = OrderAcp::find($request->id);
        $orderAcp->status = "1";
        $orderAcp->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderAcp  $orderAcp
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderAcp $orderAcp)
    {
        //
    }
}
