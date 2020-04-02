<?php

namespace App\Http\Controllers;

use App\LiqueurProduct;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addcart(Request $request){
        $data= $request->all();
        \Cart::add(array(
            'id' => $data['id'], // inique row ID
            'name' => $data['title'],
            'price' => $data['price'],
            'img' => $data['img'],
            'quantity' => 1,
            'attributes' => array($data['img'])
        ));
        $car = array(
            'id' => $data['id'], // inique row ID
            'name' => $data['title'],
            'price' => $data['price'],
            'quantity' => 1,
            'attributes' => array()
        );
        return $car;
    }

    public function getContent()
    {
        $content = \Cart::getTotal();
        return $content;
    }

    public function TotalCart()
    {
        $total = \Cart::getContent();
        return $total;


    }
    public function onChange(Request $request)
    {
        $data = $request->all();

        \Cart::update($data['id'], array(
            'quantity' => array(
                'relative' => false,
                'value' => $data["quantity"]
            ),
        ));
        return 'successful';
    }
    public function deletecar(Request $request)
    {
        $data = $request->all();

        \Cart::remove($data['id']);
        return 'successful';
    }


    public function frontaddcart(Request $request)
    {

        $id = $request->all();
        $data = LiqueurProduct::find($id['id']);
        \Cart::add(array(
            'id' => $data['id'], // inique row ID
            'name' => $data['title'],
            'price' => $data['price'],
            'img' => $data['img'],
            'quantity' => 1,
            'attributes' => array($data['img'])
        ));
        return 'success';
    }
}
