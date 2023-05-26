<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MenuController extends Controller
{
    public function index(Request $request,$meja){

        $data = Product::all();
        return view('menu',compact('data'));
    }

    public function addToCart(Request $request)
    {
        $idproduct = $request->id;
        // Ambil produk dari database berdasarkan ID
        $product = Product::find($idproduct);

        // Tambahkan produk ke keranjang session atau tabel database
        // Sesuaikan logika ini dengan metode penyimpanan yang Anda gunakan
        // Misalnya, jika menggunakan session:
        $cart = session()->get('cart', []);
        if (isset($cart[$idproduct])) {
            $cart[$idproduct]['qty']++;
        } else {
            $cart[$idproduct] = [
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1
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
        $quantity = $request->qty;

        // Perbarui jumlah produk dalam keranjang (session atau tabel database)
        // Sesuaikan logika ini dengan metode penyimpanan yang Anda gunakan
        // Misalnya, jika menggunakan session:
        $cart = session()->get('cart', []);
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
