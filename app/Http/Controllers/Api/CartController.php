<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;


class CartController extends Controller
{
    public function menu(){
        $data = Product::with('categoryproduct')->get();
        return response()->json([
            'menu' => $data
        ]);
    }
    public function checkout(Request $request){
        $cartItems =  $request->data;
        
            $order = new Order;
            $order->customer_id =  $cartItems['cust'];
            $order->product_id =  $cartItems['idproduct'];
            $order->table_id =  $cartItems['table'];
            $order->subtotal = $cartItems['price'];
            $order->qty =  $cartItems['qty'];
            $order->is_active = 1;
            $order->save();

            $cust = Customer::find($cartItems['cust']);
            $cust->is_active = 1;
            $cust->save();
            
        
        return response()->json(['success' => true]);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->id;

        // Ambil produk dari database berdasarkan ID
        $product = Product::find($productId);

        // Tambahkan produk ke keranjang (session atau tabel database)
        // Sesuaikan logika ini dengan metode penyimpanan yang Anda gunakan
        // Misalnya, jika menggunakan session:
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' =>$productId,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }
        session()->put('cart', $cart);

        // Kirim data keranjang yang diperbarui sebagai respon JSON
        return response()->json([
            'cart' => $cart
        ]);
    }

    public function updateCart(Request $request)
    {
        $productId = $request->id;
        $quantity = $request->quantity;

        $product = Product::find($productId);
        // Perbarui jumlah produk dalam keranjang (session atau tabel database)
        // Sesuaikan logika ini dengan metode penyimpanan yang Anda gunakan
        // Misalnya, jika menggunakan session:
        $cart = session()->get('cart',);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        // Kirim data keranjang yang diperbarui sebagai respon JSON
        return response()->json([
            'cart' => $cart
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('id');

        // Hapus produk dari keranjang (session atau tabel database)
        // Sesuaikan logika ini dengan metode penyimpanan yang Anda gunakan
        // Misalnya, jika menggunakan session:
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        // Kirim data keranjang yang diperbarui sebagai respon JSON
        return response()->json([
            'cart' => $cart
        ]);
    }
}
