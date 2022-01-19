<?php

namespace App\Http\Controllers;

use App\Models\OrderSerial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderSerialController extends Controller
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
     * @param  \App\Models\OrderSerial  $orderSerial
     * @return \Illuminate\Http\Response
     */
    public function show(OrderSerial $orderSerial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderSerial  $orderSerial
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderSerial $orderSerial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderSerial  $orderSerial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $orderSerial = OrderSerial::find($request->id);
        $orderSerial->serial = $request->serial;
        $orderSerial->save();
        return redirect()->back()->with('id', $request->back);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderSerial  $orderSerial
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderSerial $orderSerial)
    {
        //
    }
}
