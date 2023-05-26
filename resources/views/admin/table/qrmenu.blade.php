@extends('layouts.admin')
@section('title', 'rqmenu')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-6">
      <div class="card mt-5">
        <div class="card-body">
          <canvas class="mx-4" id="qrcode"></canvas>
        </div>
       <div class="card-footer">
        <button class="btn btn-primary" id="printButton" onclick="printQRCode()"><i data-feather="download"></i> Download QR Code</button>
       </div>
      </div>
    </div>
  </div>
</div>
<input type="text" hidden id="url" value="{{$url}}">
<script src="{{ asset('js/qrious-master/dist/qrious.min.js') }}"></script>
<script>
    var url = document.getElementById('url');
    var value = url.value;

    var qr = new QRious({
      element: document.getElementById('qrcode'),
      value: value, // URL yang ingin diubah menjadi QR code
      
      size: 200
    });
    console.log(value,">>>>>>>>>>>>>>>>>url")
    function printQRCode() {
      var canvas = document.getElementById('qrcode');
      
      canvas.toBlob(function(blob) {
        var url = URL.createObjectURL(blob);

        var a = document.createElement('a');
        a.href = url;
        a.download = 'qrcode.png'; // Nama file yang ingin diunduh
        a.click();

        URL.revokeObjectURL(url);
      }, 'image/png'); // Format gambar yang diinginkan (misalnya 'image/png' atau 'image/jpeg')

    }
  </script>
@endsection