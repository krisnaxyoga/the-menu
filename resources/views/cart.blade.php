@extends('layouts.app')
@section('title', 'welcome')
@section('content')

<section>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6 col-md-12">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                    </div>
                                    <ul id="cart-items">

                                    </ul>
                                    <hr>
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
    getCartItems();
    
     function getCartItems() {
        alert('halo');
        // Ambil data keranjang dari localStorage
        var cartItems = localStorage.getItem('cartItems');
        cartItems = cartItems ? JSON.parse(cartItems) : [];
        // updateCartView(cartItems);
        // Lakukan manipulasi DOM atau tindakan lainnya untuk menampilkan daftar produk di keranjang
        console.log('Daftar produk di keranjang:', cartItems);
    }

    // Panggil fungsi getCartItems saat halaman dimuat
  

    function updateCartView(cartItems) {
                console.log(cartItems,">>>>>>CART DALAM VIEW");

                $("#cart-items").html("");
                $.each(cartItems, function(index, item) {
                    console.log(item.name,">>>>ITEM NAME")
                var cartItem = $("<li>").html(item.name + " - IDR" + item.price + " x " + );
                var updateButton = $("<button>").addClass("update-cart").text("Update");
                var removeButton = $("<button>").addClass("remove-from-cart").text("Remove");
                var quantityInput = $("<input>").addClass("quantity").attr("type", "number").val();
                cartItem.append(quantityInput, updateButton, removeButton);
                $("#cart-items").append(cartItem);
                });
            }
    });
</script>
@endsection