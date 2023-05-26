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
                                                            <button data-id="{{$item->id}}" data-price="{{$item->price}}" data-name="{{$item->name}}" class="btn btn-primary add-to-cart"><i data-feather="shopping-cart"></i></button>
                                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                                                <i data-feather="eye"></i>
                                                              </button>
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

        // Tambahkan ID produk ke dalam keranjang
        cartItems.push({id:productId,price:price,name:name});

        // Simpan kembali data keranjang ke localStorage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        var itemCount = countLocalStorageItems();
        console.log('Jumlah data dalam localStorage: ' + itemCount);

        $("#nilai").text(itemCount);
        console.log('Produk berhasil ditambahkan ke keranjang.');
        // Lakukan manipulasi DOM atau tindakan lainnya jika diperlukan
    });

    // Fungsi untuk menghapus produk dari keranjang
    $('.remove-from-cart').on('click', function() {
        var productId = $(this).data('id');
        
        // Ambil data keranjang dari localStorage
        var cartItems = localStorage.getItem('cartItems');
        cartItems = cartItems ? JSON.parse(cartItems) : [];

        // Hapus ID produk dari keranjang
        cartItems = cartItems.filter(function(item) {
        return item !== productId;
        });

        // Simpan kembali data keranjang ke localStorage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        countLocalStorageItems();
        console.log('Produk berhasil dihapus dari keranjang.');
        // Lakukan manipulasi DOM atau tindakan lainnya jika diperlukan
    });

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
    });

    // $(document).ready(function() {
    //      // Menangani tombol "Add to Cart"
    //     $(".add-to-cart").click(function() {
    //         var productId = $(this).data("id");
            
    //         // Mengirim permintaan AJAX untuk menambahkan produk ke keranjang
    //         $.ajax({
    //         url: "/api/add-to-cart",
    //         method: "POST",
    //         data: {id: productId},
    //         success: function(response) {
    //             // Memperbarui tampilan keranjang setelah produk ditambahkan
    //             updateCartView(response);
    //         }
    //         });
    //     });
        
    //     // Menangani tombol "Update Cart"
    //     $("#cart-items").on("click", ".update-cart", function() {
    //         var productId = $(this).data("id");
    //         var quantity = $(this).siblings(".quantity").val();
    //         console.log(quantity,">>>>QTY")
    //         // Mengirim permintaan AJAX untuk memperbarui jumlah produk dalam keranjang
    //         $.ajax({
    //         url: "/api/update-cart",
    //         method: "POST",
    //         data: {id: productId, quantity: quantity},
    //         success: function(response) {
    //             console.log(response,"response>>>>")
    //             // Memperbarui tampilan keranjang setelah jumlah produk diperbarui
    //             updateCartView(response);
    //         }
    //         });
    //     });
        
    //     // Menangani tombol "Remove from Cart"
    //     $("#cart-items").on("click", ".remove-from-cart", function() {
    //         var productId = $(this).data("id");
            
    //         // Mengirim permintaan AJAX untuk menghapus produk dari keranjang
    //         $.ajax({
    //         url: "/api/remove-from-cart",
    //         method: "POST",
    //         data: {id: productId},
    //         success: function(response) {
    //             // Memperbarui tampilan keranjang setelah produk dihapus
    //             updateCartView(response);
    //         }
    //         });
    //     });
            
    //         // Memperbarui tampilan keranjang
    //         function updateCartView(cart) {
    //             console.log(cart?.cart,">>>>>>CART DALAM VIEW");

    //             // var fruits = ['Apple', 'Banana', 'Orange'];

    //             // console.log(fruits,">>>PRUID")
    //             // $.each(fruits, function(index, fruit) {
    //             // console.log(index, fruit, ">>>>>>FRUIT EACH");
    //             // });

    //             $("#cart-items").html("");
    //             $.each(cart?.cart, function(index, item) {
    //                 console.log(item.name,">>>>ITEM NAME")
    //             var cartItem = $("<li>").html(item.name + " - IDR" + item.price + " x " + item.quantity);
    //             var updateButton = $("<button>").addClass("update-cart").text("Update");
    //             var removeButton = $("<button>").addClass("remove-from-cart").text("Remove");
    //             var quantityInput = $("<input>").addClass("quantity").attr("type", "number").val(item.quantity);
    //             cartItem.append(quantityInput, updateButton, removeButton);
    //             $("#cart-items").append(cartItem);
    //             });
    //         }
    //     });
    </script>
    
@endsection