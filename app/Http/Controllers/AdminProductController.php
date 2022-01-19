<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_detail;
use App\Models\Product_img;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('product')->get();
        $products_detail = DB::table('product_detail')->get();
        /* return view('admin.product', [
            'products' => $products,
            'products_detail' => $products_detail
        ]); */
        return view('admin.product')
        ->with('products', $products);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $sale = $request->input('sale');
        if ($sale == 'on') {
            $sale = 1;
        } else {
            $sale = 0;
        }
        //
        $pro = new Product();
        $pro_detail = new Product_detail();
        $pro_img = new Product_img();
        $this->validate($request, [
            'name' => 'required',
            'oldPrice' => 'required',
            'newPrice' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image3' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image4' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
        /* if($request->hasFile('image'))
        {
            $file = $request->('image');
        }) */
        // product
        $pro->name = $request->input('name');
        $pro->oldPrice = $request->input('oldPrice');
        $pro->newPrice = $request->input('newPrice');
        $pro->offer = $request->input('offer');
        $pro->version = $request->input('version');
        
        $pro->sale = $sale;
        $pro->type = $request->input('type');
        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('images/product/',$filename);
            $pro->img = $filename;

        }else{
            $pro->img = 'phone1.webp';
        }
        $pro->sellQty='0';
        $pro->rate = '5';
        $pro->guarantee = $request->input('guarantee');
        $pro->save();
        print_r($pro->sale);
        //product image
        $pro_img->productId = $pro->id;
        /* if ($request->hasFile('images'))
        { */
            /* $file = $request->file('image'); */
        /* $images = $request->file('images'); */
        // print_r($images);
        $img1 = $request->file('image1');
        $ext1 = $img1->getClientOriginalExtension();
        $filename1 = 'ct1'.time().'.'.$ext1;
        $img1->move('images/product/',$filename1);

        // echo $filename1;
        $img2 = $request->file('image2');
        $ext2 = $img2->getClientOriginalExtension();
        $filename2 = 'ct2'.time().'.'.$ext2;
        $img2->move('images/product/',$filename2);

        // echo $filename2;
        $img3 = $request->file('image3');
        $ext3 = $img3->getClientOriginalExtension();
        $filename3 = 'ct3'.time().'.'.$ext3;
        $img3->move('images/product/',$filename3);


        $img4 = $request->file('image4');
        $ext4 = $img4->getClientOriginalExtension();
        $filename4 = 'ct4'.time().'.'.$ext4;
        $img4->move('images/product/',$filename4);
        /* echo $filename;
        echo $filename1;
        echo $filename2;
        echo $filename3;
        echo $filename4; */
        $pro_img->img1 = $filename1;
        $pro_img->img2 = $filename2;
        $pro_img->img3 = $filename3;
        $pro_img->img4 = $filename4;

        /* }else{
            $pro->img = 'phone1.webp';
        } */
        $pro_img->save();
        //product detail
        $pro_detail->product_id = $pro->id;
        $pro_detail->cpu = $request->input('cpu');
        $pro_detail->screen = $request->input('screen');
        $pro_detail->resolution = $request->input('resolution');
        $pro_detail->ram = $request->input('ram');
        $pro_detail->weight = $request->input('weight');
        $pro_detail->camera = $request->input('camera');
        $pro_detail->storage = $request->input('storage');
        $pro_detail->pin = $request->input('pin');
        $pro_detail->port = $request->input('port');
        $pro_detail->feature = $request->input('feature');
        $pro_detail->bluetooth = $request->input('bluetooth');
        $pro_detail->compatible = $request->input('compatible');
        $pro_detail->save();
        return redirect('admin/product')->with('status',"Thêm sản phẩm thành công");
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
    public function edit(Request $request, $id)
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
        $pro = Product::find($id);
        $pro->name = $request->input('name');
        $pro->oldPrice = $request->input('oldPrice');
        $pro->newPrice = $request->input('newPrice');
        $pro->offer = $request->input('offer');
        $pro->version = $request->input('version');
        $sale = $request->input('sale1');
        if ($sale == 'on') {
            $sale = 1;
        }else{
            $sale = 0;
        }
        $pro->sale = $sale;
        $pro->update();

        $pro_detail = Product_detail::firstWhere('product_id',$id);
        $pro_detail->cpu = $request->input('cpu');
        $pro_detail->screen = $request->input('screen');
        $pro_detail->resolution = $request->input('resolution');
        $pro_detail->ram = $request->input('ram');
        $pro_detail->weight = $request->input('weight');
        $pro_detail->camera = $request->input('camera');
        $pro_detail->storage = $request->input('storage');
        $pro_detail->pin = $request->input('pin');
        $pro_detail->port = $request->input('port');
        $pro_detail->feature = $request->input('feature');
        $pro_detail->bluetooth = $request->input('bluetooth');
        $pro_detail->compatible = $request->input('compatible');
        $pro_detail->update();
        print_r($pro->sale);
        return redirect('admin/product')->with('status',"Cập nhập sản phẩm thành công");
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
        echo $id;
        $pro = Product::find($id);
        $pro_detail = Product_detail::firstWhere('product_id',$id);
        $pro_img = Product_img::firstWhere('productId',$id);
        echo $pro_img;
        /* $pro_img = Product_img::find($id); */
        $pathImg = 'images/product/'.$pro->img;
        $pathImg1 = 'images/product/'.$pro_detail->img1;
        $pathImg2 = 'images/product/'.$pro_detail->img2;
        $pathImg3 = 'images/product/'.$pro_detail->img3;
        $pathImg4 = 'images/product/'.$pro_detail->img4;

        if(File::exists($pathImg)){
            File::delete($pathImg);
        }
        if(File::exists($pathImg1)){
            File::delete($pathImg1);
        }
        if(File::exists($pathImg2)){
            File::delete($pathImg2);
        }
        if(File::exists($pathImg3)){
            File::delete($pathImg3);
        }
        if(File::exists($pathImg4)){
            File::delete($pathImg4);
        }
        $pro_img->delete();
        $pro_detail->delete();
        $pro->delete();

        /* return redirect('admin/product') -> with('status',"Xóa sản phẩm thành công"); */
        return redirect('admin/product')->with('status',"Xóa sản phẩm thành công");

    }
}
