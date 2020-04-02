<?php

namespace App\Http\Controllers;

use App\LiqueurProduct;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::all();
        return View('auth.Order.index', compact('data'));
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
        $data = $request->all();
        $ready = Order::create($data);
        return $ready;
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
        $data = Order::find($id);
        return $data;

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
        $new = $request->all();
        $data =Order::find($id);
        $data->update($new);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Order::find($id);
        $data->delete();
        return 'successful';
    }

    public function productdata(Request $request)
    {
        $id = $request->all();
        // $pro=[];
        // $data = OrderDetail::where('order_id',$id['id'])->get();
        // foreach( $data as $item){
        //     $product = LiqueurProduct::where('liqueur_id',$item->product_id)->get();
        //     array_push($pro, $product);
        // };
        $data = OrderDetail::with('product')->where('order_id',$id['id'])->get();
       return $data;
    }

    public function Inquire($id)
    {
        $new_order = Order::where('order_no',$id)->first();
        $message ='';
        return view('fronts.orderfinish',compact('message','new_order'));
    }
}
