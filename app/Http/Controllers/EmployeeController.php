<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class EmployeeController extends Controller
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
        $emp = new User();

        $emp->name = $request->input('name');
        $emp->email = $request->input('email');
        $emp->phone = $request->input('phone');
        $emp->role = $request->input('role');
        // mật khẩu mặc định 1234566789
        $emp->password = '123456789';
        $emp->address = $request->input('address');
        $emp->active = '1';
        $emp->salary = $request->input('salary');

        $emp->save();

        return redirect('admin/employee') ->with('status','Thêm nhân viên thành công');

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
        //
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
        $emp = User::find($id);

        $emp->name = $request->input('name');
        $emp->email = $request->input('email');
        $emp->phone = $request->input('phone');
        $emp->role = $request->input('role');
        // mật khẩu mặc định 1234566789
        $emp->password = '123456789';
        $emp->address = $request->input('address');
        $emp->active = '1';
        $emp->salary = $request->input('salary');

        $emp->update();

        return redirect('admin/employee') ->with('status','Cập nhập thông tin nhân viên thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp = User::find($id);

        $emp->delete();
        return redirect('admin/employee') ->with('status','Xóa nhân viên thành công');
    }
}
