<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product_detail');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = DB::table('product')
            ->join('product_detail', 'product.id', '=', 'product_detail.product_id')
            ->join('product_img', 'product.id', '=', 'product_img.productId')
            ->select('product.*', 'product_detail.*','product_img.*')
            ->where('product.id', '=', $id)
            ->get();
        $getType = $item[0]->type;
        $getOldprice = $item[0]->oldPrice;
        $item__similar = DB::table('product')
        ->where('type', '=' , $getType)
        // ->where('oldPrice', '<' ,$getOldprice-$getOldprice/10)
        // ->where('oldPrice', '>' ,$getOldprice+$getOldprice/10)
        ->take(8)->get();
        return view('product_detail', ['item' => $item , 'item__similar' =>  $item__similar]);
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
