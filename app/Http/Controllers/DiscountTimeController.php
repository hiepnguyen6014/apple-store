<?php

namespace App\Http\Controllers;

use App\Models\DiscountTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountTimeController extends Controller
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
     * @param  \App\Models\DiscountTime  $discountTime
     * @return \Illuminate\Http\Response
     */
    public function show(DiscountTime $discountTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiscountTime  $discountTime
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiscountTime  $discountTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $date = $request->dateEnd;
        // get year month day from date
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        // get hour minute second from date
        $hour = substr($date, 11, 2);
        $minute = substr($date, 14, 2);

        $discountTime = DiscountTime::find(1);
        $discountTime->year = $year;
        $discountTime->month = $month;
        $discountTime->day = $day;
        $discountTime->hours = $hour;
        $discountTime->minutes = $minute;
        $discountTime->save();

        return redirect('/admin/discount')->with('success', 'Đã cập nhập thời gian khuyến mãi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiscountTime  $discountTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountTime $discountTime)
    {
        //
    }
}
