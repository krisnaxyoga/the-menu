@extends('layouts.app')
@section('title', 'menu')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<section>
    <div class="container">

        <!-- Outer Row -->

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <a class="btn btn-info" href="{{ route('cart',$meja) }}" >
                                    <i class="fas fa-shopping-cart fa-fw"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter" id="nilai"></span>
                                </a>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 mt-3">Welcome The Menu</h1>
                                        @if (session()->has('message'))
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    </div>
                                    <div class="container">
                                        <div class="row justify-content-center" id="products">
                                            @foreach ($data as $key=>$item)
                                                <div class="col-lg-4 col-md-6 col-12 mb-5">
                                                    <div class="card">
                                                        <img class="card-img-top object-fit-cover height-13rem" src="{{$item->image_url}}" alt="{{$item->image_url}}">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{$item->name}}</h5>
                                                            <p class="card-text">{{ $item->categoryproduct->name }}</p>
                                                            <p>{{$item->price}}</p>
                                                            <button data-id="{{$item->id}}" data-price="{{$item->price}}" data-name="{{$item->name}}" class="btn btn-primary add-to-cart"><i data-feather="plus"></i></button>
                                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                                                <i data-feather="eye"></i>
                                                              </button>
                                                              <span class="jumlah-{{ $item->id }}" data-id="{{$item->id}}"></span>
                                                            {{-- <a href="#" class="btn btn-warning" onclick="alert('@php $jangkrik @endphp')"><i data-feather="eye"></i></a> --}}
                                                        <!-- Tombol untuk memicu modal -->

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $item->id }}-label" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="modal-{{ $item->id }}-label">{{$item->name}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <!-- Konten modal di sini -->
                                                                    <p>{{ $item->description }}</p>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                             
    </div>
</section>
<script>
    $(document).ready(function() {
        function countLocalStorageItems() {
        var count = 0;

        for (var i = 0; i < localStorage.length; i++) {
            var key = localStorage.key(i);
            var value = localStorage.getItem(key);

            // Lakukan pengecekan jika item yang disimpan adalah data yang diinginkan
            // Misalnya, jika item yang disimpan adalah keranjang belanja
            if (key === 'cartItems') {
            var cartItems = JSON.parse(value);
            count = cartItems.length;
            }

            // Tambahkan pengecekan untuk item-data lainnya jika diperlukan

            // Lakukan penambahan jumlah item-data
            // count += ...;

        }

        return count;
        }

    // Contoh penggunaan
    var itemCount = countLocalStorageItems();
        console.log('Jumlah data dalam localStorage: ' + itemCount);

        $("#nilai").text(itemCount);
        
       
    // Fungsi untuk menambahkan produk ke keranjang
    $('.add-to-cart').on('click', function() {
        var productId = $(this).data('id');
        var price = $(this).data('price');
        var name = $(this).data('name');
        // Ambil data keranjang dari localStorage
        var cartItems = localStorage.getItem('cartItems');
        cartItems = cartItems ? JSON.parse(cartItems) : [];

        // // Tambahkan ID produk ke dalam keranjang
        // cartItems.push({id:productId,price:price,name:name});
            
        // Mengecek apakah item sudah ada di keranjang
        var existingItem = cartItems.find(function(item) {
            return item.productId === productId;
        });

        if (existingItem) {
            // Jika item sudah ada, tambahkan kuantitasnya
            existingItem.qty += 1;
            
        alert('Jumlah Produk = '+existingItem.qty);
        } else {
            // Jika item belum ada, tambahkan item baru ke keranjang
            var newItem = {
            productId: productId,
            price:price,
            name:name,
            qty: 1
            };
            cartItems.push(newItem);
            
        alert('Produk berhasil ditambahkan ke keranjang.');
        }

        // Menyimpan keranjang yang telah diperbarui di localStorage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));

        // Simpan kembali data keranjang ke localStorage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        var itemCount = countLocalStorageItems();
        console.log('Jumlah data dalam localStorage: ' + itemCount);

        $("#nilai").text(itemCount);

        // Lakukan manipulasi DOM atau tindakan lainnya jika diperlukan
    });

    // Fungsi untuk mendapatkan daftar produk di keranjang
    function getCartItems() {
        // Ambil data keranjang dari localStorage
        var cartItems = localStorage.getItem('cartItems');
        cartItems = cartItems ? JSON.parse(cartItems) : [];

        // var qty = 0;
        // var productId = $('.jumlah').data('id');
        // var existingItem = cartItems.find(function(item) {
        //         return item.productId === productId;
        //     });
        //     $('.jumlah').append(existingItem.qty);
        console.log(existingItem,"productid in span")
       
        // Lakukan manipulasi DOM atau tindakan lainnya untuk menampilkan daftar produk di keranjang
        console.log('Daftar produk di keranjang:', cartItems);

    }

    // Panggil fungsi getCartItems saat halaman dimuat
    getCartItems();
    });

    </script>
    
@endsection