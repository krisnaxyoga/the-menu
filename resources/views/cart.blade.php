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
                                    <a class="btn btn-warning" href="{{ route('menu.food',['table'=>$meja,'cust'=>$cust]) }}" >
                                    <i class="fas fa-undo fa-fw"></i>
                                    <!-- Counter - Messages --> Back
                                </a>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 mt-3">KERANJANG BELANJA</h1>

                                    </div>
                                    <div class="container">
                                        <div class="row justify-content-center" id="products">
                                           <div class="col-12" id="cart-items">

                                           </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
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
        var cartItems = localStorage.getItem('cartItems');
        cartItems = cartItems ? JSON.parse(cartItems) : [];

        // Lakukan manipulasi DOM atau tindakan lainnya untuk menampilkan daftar produk di keranjang
        console.log('Daftar produk di keranjang:', cartItems);
        updateCartView(cartItems);
    // Fungsi untuk menambahkan produk ke keranjang

    $('.remove-from-cart').off('click').on('click', function() {
        var productId = $(this).data('id');
        console.log(productId,"produk id<<<<<<<<<<<<<<<<")
        // alert(productId)
        // Ambil data keranjang dari localStorage
        var cartItems = localStorage.getItem('cartItems');
        cartItems = cartItems ? JSON.parse(cartItems) : [];

        // Menghapus semua item dengan productId yang sama
        cartItems = cartItems.filter(function(item) {
        return item.productId !== productId; // Ganti dengan kondisi yang sesuai untuk mencari item yang ingin dihapus
        });

        // Simpan kembali data keranjang ke localStorage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        var itemCount = countLocalStorageItems();
        console.log('Jumlah data dalam localStorage: ' + itemCount);

        $("#nilai").text(itemCount);
        updateCartView(cartItems);
        window.location.reload();
        console.log('Produk berhasil dihapus dari keranjang.');
        // Lakukan manipulasi DOM atau tindakan lainnya jika diperlukan
    });

    $('#checkout').off('click').on('click', function() {
        // alert("chekout")
        var meja = $(this).data('meja');
        var cust = $(this).data('cust');
        var cartItems = localStorage.getItem('cartItems');
        cartItems = cartItems ? JSON.parse(cartItems) : [];
        $.each(cartItems, function(index, item) {
            // Mengirim data ke server menggunakan AJAX
            var subtotal = item.qty * item.price;
            $.ajax({
            url: '/api/checkout',
            method: 'POST',
            data: { data:{idproduct:item.productId,price:subtotal,name:item.name,qty:item.qty,table:meja,cust:cust} },
            success: function(response) {
                console.log('Data keranjang berhasil disimpan ke database.');
                console.log(response,"hasil");
                localStorage.clear();
                var itemCount = countLocalStorageItems();

                $("#nilai").text(itemCount);
                window.location.reload();
                // window.location.href = 'https://www.example.com';
                // Lakukan manipulasi DOM atau tindakan lainnya jika diperlukan
            },
            error: function(error) {
                console.log('Terjadi kesalahan saat menyimpan data keranjang.');
                console.log(error);
            }
            });
            console.log(item.productId,"checkout cart item")
        });
        alert("order berhasil, mohon tunggu sebentar kami siapkan pesanan anda");
    });
    $('.qty').change(function() {
        var nilaiInput = $(this).val();
        console.log('Nilai input telah berubah:', nilaiInput);
        var productId = $(this).data('id');
        console.log(productId,"on change<<<<<<<<<<<<<<<<")
        // alert(productId)
        // Ambil data keranjang dari localStorage
        var cartItems = localStorage.getItem('cartItems');
        cartItems = cartItems ? JSON.parse(cartItems) : [];

        var existingItem = cartItems.find(function(item) {
            return item.productId === productId;
        });

        if (existingItem) {
            // Jika item sudah ada, tambahkan kuantitasnya
            existingItem.qty = nilaiInput;
        }
        // Simpan kembali data keranjang ke localStorage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        var itemCount = countLocalStorageItems();
        console.log('Jumlah data dalam localStorage: ' + itemCount);

        $("#nilai").text(itemCount);
        window.location.reload();
        console.log('Produk berhasil dihapus dari keranjang.');
        // Lakukan manipulasi DOM atau tindakan lainnya jika diperlukan
    });


            // Memperbarui tampilan keranjang
            function updateCartView(cart) {
                console.log(cart,">>>>>>CART DALAM VIEW");

                $("#cart-items").html("");
                $.each(cart, function(index, item) {
                    // console.log(item.name,">>>>ITEM NAME")
                    var subtotal = item.qty * item.price;
                    var html = '<div class="card mb-4"> <div class="card-body"><div class="d-flex justify-content-between"><div><p>'+item.name+' - IDR '+item.price+' </p>  <button data-id="'+item.productId+'" class="remove-from-cart btn btn-danger"><i class="fas fa-trash" aria-hidden="true"></i></button></div> <div> <label class="small mb-1">QTY </label> <input class="qty form-control w-2" type="number" data-id="'+item.productId+'" value="'+item.qty+'" /> </div> </div> <div class="d-flex"><p class="fw-bold">sub total :</p> <p class="text-primary">'+subtotal+'</p>  </div> </div></div>'
                // var cartItem = $("<li>").html(item.name + " - IDR" + item.price +"x"+item.qty);
                // var removeButton = $("<button>").addClass("remove-from-cart btn btn-danger").attr("data-id", ""+item.productId+"").text("Remove");
                // var quantityInput = $("<input>").addClass("qty form-control").attr("type", "number").attr("data-id", ""+item.productId+"").val(item.qty);
                // cartItem.append(quantityInput,  removeButton);

                $("#cart-items").append(html);
                });
              console.log(itemCount,">>>>>dalam view")
                if(itemCount == 0){
                    var card = '<a class="btn btn-success mb-5" href="{{ route('menu.food',['table'=>$meja,'cust'=>$cust]) }}">Ayo Order Dulu!!! </a>'
                    $("#cart-items").after(card);
                }else{
                    var button = '<button class="btn btn-primary mb-5" data-meja="{{ $meja }}" data-cust="{{ $cust }}" id="checkout">CHECKOUT</button>';

                    $("#cart-items").after(button);
                }


            }
        });

        $('#btnRedirect').click(function() {
            $.ajax({
                url: "{{ route('cart',['table'=>$meja,'cust'=>$cust]) }}", // Ganti dengan URL tujuan Anda
                type: 'GET',
                success: function(response) {
                    // Ganti konten halaman dengan hasil dari permintaan AJAX
                    $('body').html(response);
                }
            });
        });
    </script>

@endsection
