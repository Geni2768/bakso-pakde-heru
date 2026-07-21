<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    // HALAMAN UTAMA
    public function index()
    {
        $menus = Menu::limit(3)->get();

        return view('welcome', compact('menus'));
    }



    // TAMBAH KERANJANG
    public function addCart($id)
    {
        $menu = Menu::findOrFail($id);


        $cart = session()->get('cart', []);



        if(isset($cart[$id])) {

            $cart[$id]['qty']++;

        } else {


            $cart[$id] = [

                'nama' => $menu->nama_menu,
                'harga' => $menu->harga,
                'qty' => 1,
                'gambar' => $menu->gambar

            ];

        }



        session()->put('cart',$cart);



        return back();

    }





    // HALAMAN KERANJANG
    public function cart()
    {

        $cart = session()->get('cart',[]);


        return view('cart',compact('cart'));

    }





    // CHECKOUT
    public function checkout()
    {

        $cart = session()->get('cart',[]);



        if(count($cart)==0){

            return back();

        }



        $total = 0;



        foreach($cart as $item){

            $total += $item['harga'] * $item['qty'];

        }




        // SIMPAN ORDER

        $order = Order::create([

            'user_id'=>auth()->id(),

            'total_harga'=>$total,

            'status'=>'pending'

        ]);





        // SIMPAN DETAIL ORDER

        foreach($cart as $id=>$item){


            OrderItem::create([

                'order_id'=>$order->id,

                'menu_id'=>$id,

                'jumlah'=>$item['qty'],

                'harga'=>$item['harga']

            ]);

        }





        // KOSONGKAN CART

        session()->forget('cart');




        return redirect('/')

        ->with('success','Pesanan berhasil dibuat');

    }





    // HAPUS CART

    public function deleteCart($id)
    {

        $cart = session()->get('cart',[]);



        unset($cart[$id]);



        session()->put('cart',$cart);



        return back();

    }


}
