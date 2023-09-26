@extends('layouts.app')
@section('title', 'menu')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<section>
    <div class="container">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <a class="btn btn-info position-relative" id="btnRedirect" href="{{ route('cart',['table'=>$meja,'cust'=>$cust]) }}" >
                                    <i class="fas fa-shopping-cart fa-fw"></i>
                                    <!-- Counter - Messages -->
                                    <span style="left: 43px;" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="nilai">
                                        {{-- <span ></span> --}}
                                      </span>
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
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6">
                                                <form action="">
                                                    <div class="form-group">
                                                        <select class="category form-control" name="" id="">
                                                            <option value="">-pilih category-</option>
                                                            <option value="0">all</option>
                                                            @foreach ($category as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span id="load"></span>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center" id="products">
                                            @foreach ($data as $item)
                                                <div class="col-lg-4 col-md-6 col-12 mb-5">
                                                    <div class="card">
                                                        <img class="card-img-top object-fit-cover height-13rem" src="{{$item->image_url}}" alt="{{$item->image_url}}">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{$item->name}}</h5>
                                                            <p class="card-text">{{ $item->categoryproduct->name }}</p>
                                                            <p>{{'Rp ' . number_format($item->price, 0, ',', '.')}}</p>
                                                            <button data-id="{{$item->id}}" data-price="{{$item->price}}" data-name="{{$item->name}}" class="btn btn-primary add-to-cart"><i data-feather="plus"></i></button>
                                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                                                <i data-feather="eye"></i>
                                                              </button>
                                                              <span class="jumlah-{{ $item->id }}" data-id="{{$item->id}}"></span>

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
   <!-- Bottom Navbar -->
<nav style="height: 62px;border-radius: 26px;" class="navbar navbar-dark bg-light shadow navbar-expand fixed-bottom">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
            <a href="{{ route('menu.food',['table'=>$meja,'cust'=>$cust]) }}" class="nav-link text-center text-secondary">
                <i class="fa fa-home"></i>
                <span class="small d-block">Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('cart',['table'=>$meja,'cust'=>$cust]) }}" class="nav-link text-center text-secondary">
                <i class="fa fa-shopping-cart"></i>
                <span class="small d-block">Cart</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('orderlist',['table'=>$meja,'cust'=>$cust])}}" class="nav-link text-center text-secondary">
                <i class="fa fa-book" aria-hidden="true"></i>
                <span class="small d-block">Order list</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('payment',['table'=>$meja,'cust'=>$cust])}}" class="nav-link text-center text-secondary">
                <i class="fa fa-credit-card" aria-hidden="true"></i>
                <span class="small d-block">Bayar Pesanan</span>
            </a>
        </li>
    </ul>
</nav>
</section>
<script>
    $(document).ready(function() {

        $('.add-to-cart').off('click').on('click', function() {
        console.log('ACTIVE ADD CART');
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
             // Konversi existingItem.qty menjadi angka sebelum penambahan
                var qty = parseInt(existingItem.qty);
                // Jika produk sudah ada, tambahkan 1 ke jumlahnya
                existingItem.qty = qty + 1;

        alert('Jumlah item = '+existingItem.qty);
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

       function addcart(){
        alert('active');
       }

    // Fungsi untuk mendapatkan daftar produk di keranjang
    function getCartItems() {
        // Ambil data keranjang dari localStorage
        var cartItems = localStorage.getItem('cartItems');
        cartItems = cartItems ? JSON.parse(cartItems) : [];

        // Lakukan manipulasi DOM atau tindakan lainnya untuk menampilkan daftar produk di keranjang
        console.log('Daftar produk di keranjang:', cartItems);

    }

    // Panggil fungsi getCartItems saat halaman dimuat
    getCartItems();
    // Fungsi untuk menambahkan produk ke keranjang


    });


    $('.category').change(function() {
        var nilaiInput = $(this).val();
       console.log(nilaiInput,">>>>>>nilai select");
       console.log({{$meja}},"meja");

        // Tampilkan loading
        $('#load').append('<div id="loading" class="d-flex"><div class="loader mx-2"></div><p>Loading...</p></div>');

        if(nilaiInput == 0){
            window.location.reload();
        }else{
            $.ajax({
            url: "{{route('menu.food',['table'=>$meja,'cust'=>$cust])}}",
            method: 'GET',
            data: { data:{category:nilaiInput} },
            success: function(response) {
                $('#loading').remove();
                $('body').html(response);
            },
            error: function(error) {
                $('#loading').remove();
                console.log('Terjadi kesalahan saat menyimpan data keranjang.');
                console.log(error);
            }
            });
        }
    });


    // $('#btnRedirect').click(function() {
    //         $.ajax({
    //             url: "{{ route('cart',['table'=>$meja,'cust'=>$cust]) }}", // Ganti dengan URL tujuan Anda
    //             type: 'GET',
    //             success: function(response) {
    //                 // Ganti konten halaman dengan hasil dari permintaan AJAX
    //                 $('body').html(response);
    //             }
    //         });
    //     });
    </script>
    <style>
        .loader {
          border: 5px solid #8bc1f3;
          border-radius: 50%;
          border-top: 5px solid #f78787;
          width: 20px;
          height: 20px;
          -webkit-animation: spin 2s linear infinite; /* Safari */
          animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
          0% { -webkit-transform: rotate(0deg); }
          100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
        </style>
@endsection
