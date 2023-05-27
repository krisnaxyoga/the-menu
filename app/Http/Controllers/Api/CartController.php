<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // public function getcart(){
    //     session()->get('data');
    // }
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