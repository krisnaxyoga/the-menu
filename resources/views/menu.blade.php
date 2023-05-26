@extends('layouts.app')
@section('title', 'login')
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
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 mt-3">Welcome The Menu</h1>
                                        @if (session()->has('message'))
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <div id="cart">
                                        <h2>Shopping Cart</h2>
                                        <ul id="cart-items">
                                          <!-- Daftar item keranjang akan ditampilkan di sini -->
                                        </ul>
                                      </div>   
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
                                                            <input type="text" hidden value="{{ $item->description }}" id="desc">
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
         // Menangani tombol "Add to Cart"
        $(".add-to-cart").click(function() {
            var productId = $(this).data("id");
            
            // Mengirim permintaan AJAX untuk menambahkan produk ke keranjang
            $.ajax({
            url: "/api/add-to-cart",
            method: "POST",
            data: {id: productId},
            success: function(response) {
                // Memperbarui tampilan keranjang setelah produk ditambahkan
                updateCartView(response);
            }
            });
        });
        
        // Menangani tombol "Update Cart"
        $("#cart-items").on("click", ".update-cart", function() {
            var productId = $(this).data("id");
            var quantity = $(this).siblings(".quantity").val();
            console.log(quantity,">>>>QTY")
            // Mengirim permintaan AJAX untuk memperbarui jumlah produk dalam keranjang
            $.ajax({
            url: "/api/update-cart",
            method: "POST",
            data: {id: productId, quantity: quantity},
            success: function(response) {
                console.log(response,"response>>>>")
                // Memperbarui tampilan keranjang setelah jumlah produk diperbarui
                updateCartView(response);
            }
            });
        });
        
        // Menangani tombol "Remove from Cart"
        $("#cart-items").on("click", ".remove-from-cart", function() {
            var productId = $(this).data("id");
            
            // Mengirim permintaan AJAX untuk menghapus produk dari keranjang
            $.ajax({
            url: "/api/remove-from-cart",
            method: "POST",
            data: {id: productId},
            success: function(response) {
                // Memperbarui tampilan keranjang setelah produk dihapus
                updateCartView(response);
            }
            });
        });
            
            // Memperbarui tampilan keranjang
            function updateCartView(cart) {
                console.log(cart?.cart,">>>>>>CART DALAM VIEW");

                // var fruits = ['Apple', 'Banana', 'Orange'];

                // console.log(fruits,">>>PRUID")
                // $.each(fruits, function(index, fruit) {
                // console.log(index, fruit, ">>>>>>FRUIT EACH");
                // });

                $("#cart-items").html("");
                $.each(cart?.cart, function(index, item) {
                    console.log(item.name,">>>>ITEM NAME")
                var cartItem = $("<li>").html(item.name + " - IDR" + item.price + " x " + item.quantity);
                var updateButton = $("<button>").addClass("update-cart").text("Update");
                var removeButton = $("<button>").addClass("remove-from-cart").text("Remove");
                var quantityInput = $("<input>").addClass("quantity").attr("type", "number").val(item.quantity);
                cartItem.append(quantityInput, updateButton, removeButton);
                $("#cart-items").append(cartItem);
                });
            }
        });
    </script>
    
@endsection