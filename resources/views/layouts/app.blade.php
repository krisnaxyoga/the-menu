<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/dashboard_assets/css/styles.css" rel="stylesheet" />
    {{-- <link href="/dashboard_assets/cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" /> --}}
    <link href="/dashboard_assets/cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="/images/logo.png" />
    <script data-search-pseudo-elements defer src="/dashboard_assets/cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script> --}}

    @stack('style')
    {{-- <title>Login</title> --}}
  </head>
  <body class="bg-warning">
    <nav class="navbar navbar-light bg-warning">
      <div class="container d-flex justify-content-center mb-3">
        <img src="/images/themenu.png" alt="" style="width:150px">
      </div>
    </nav>
  <div> 
    <main>
        @yield('content')
    </main>
  </div>
   <!-- Bottom Navbar -->
<nav style="height: 62px;border-radius: 26px;" class="navbar navbar-dark bg-light shadow navbar-expand fixed-bottom">
  <ul class="navbar-nav nav-justified w-100">
      <li class="nav-item">
          <a href="{{ route('menu.food',['table'=>$meja,'cust'=>$cust]) }}" class="nav-link text-center text-warning">
              <i class="fa fa-home"></i>
              <span class="small d-block">Home</span>
          </a>
      </li>
      <li class="nav-item">
          <a href="{{ route('cart',['table'=>$meja,'cust'=>$cust]) }}" class="nav-link text-center text-warning">
              <i class="fa fa-shopping-cart"></i>
              <span class="small d-block">Cart</span>
          </a>
      </li>
      <li class="nav-item">
          <a href="{{route('orderlist',['table'=>$meja,'cust'=>$cust])}}" class="nav-link text-center text-warning">
              <i class="fa fa-book" aria-hidden="true"></i>
              <span class="small d-block">Order list</span>
          </a>
      </li>
  </ul>
</nav>
    <script src="/dashboard_assets/code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/dashboard_assets/cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/assets/demo/chart-area-demo.js"></script>
    <script src="/dashboard_assets/assets/demo/chart-bar-demo.js"></script>
    <script src="/dashboard_assets/assets/demo/chart-pie-demo.js"></script>
    <script src="/dashboard_assets/cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/assets/demo/datatables-demo.js"></script>
    <script src="/dashboard_assets/cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/assets/demo/date-range-picker-demo.js"></script>
    <script>
        $(document).ready(function (){
            
        });
    </script>
    @stack('script')
    
  </body>
</html>