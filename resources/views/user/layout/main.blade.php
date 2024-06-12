<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ala Cafe Jember @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('logo/logo-adit.png') }}">
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/owl.theme.default.min.css') }}">
    <!-- fancybox -->
    <link rel="stylesheet" href="{{ asset('user/assets/css/jquery.fancybox.min.css') }}">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="{{ asset('user/assets/css/fontawesome.min.css') }}">
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('user/assets/css/responsive.css') }}">
    <!-- color -->
    <link rel="stylesheet" href="{{ asset('user/assets/css/color.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('user/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/preloader.js') }}"></script>
</head>
<body>
    <!-- preloader -->
    <div class="preloader">
        <div class="container">
            <div class="dot dot-1"></div>
            <div class="dot dot-2"></div>
            <div class="dot dot-3"></div>
        </div>
    </div>
    <!-- end preloader -->
    @include('user.partials.header')
    @yield('content')
    @include('user.partials.footer')
    <!-- progress -->
    <div id="progress">
        <span id="progress-value"><i class="fa-solid fa-arrow-up"></i></span>
    </div>

    <!-- Bootstrap Js -->
    <script src="{{ asset('user/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/owl.carousel.min.js') }}"></script>
    <!-- fancybox -->
    <script src="{{ asset('user/assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/custom.js') }}"></script>

    <script src="{{ asset('user/assets/js/jquery.nice-select.min.js') }}"></script>

    <!-- Form Script -->
    <script src="{{ asset('user/assets/js/contact.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/assets/js/sweetalert.min.js') }}"></script>

    @yield('script')

    @if(Session::get('login'))
    <script>
        swal("Berhasil!", "Anda Berhasil Login", "success");

    </script>
    @endif

    @if(Session::get('loginerror'))
    <script>
        swal("Gagal!", "Email atau Password Salah", "error");

    </script>
    @endif

    @if(Session::get('register'))
    <script>
        swal("Berhasil!", "Anda Berhasil Register", "success");

    </script>
    @endif

    @if(Session::get('updateprofil'))
    <script>
        swal("Berhasil!", "Anda Berhasil Update Profil", "success");

    </script>
    @endif

    @if(Session::get('logout'))
    <script>
        swal("Berhasil!", "Anda Berhasil Logout", "success");

    </script>
    @endif


    @if(Session::get('linkkadaluarsa'))
    <script>
        swal("Gagal!", "Link Sudah Kadaluarsa", "error");

    </script>
    @endif

    @if(Session::get('resetpasswordberhasil'))
    <script>
        swal("Berhasil!", "Password Berhasil Diubah", "success");

    </script>
    @endif

    @if(Session::get('linkresetdikirim'))
    <script>
        swal("Berhasil!", "Link Reset Password Telah Dikirim Ke Email Anda", "success");

    </script>
    @endif

    @if(Session::get('emailtidakditemukan'))
    <script>
        swal("Gagal!", "Email Tidak Ditemukan", "error");

    </script>
    @endif

    @if(Session::get('storecart'))
    <script>
        swal("Berhasil!", "Produk Berhasil Ditambahkan Ke Keranjang", "success");

    </script>
    @endif


    @if(Session::get('updatecart'))
    <script>
        swal("Berhasil!", "Keranjang Berhasil Diupdate", "success");

    </script>
    @endif

    @if(Session::get('deletecart'))
    <script>
        swal("Berhasil!", "Produk Berhasil Dihapus Dari Keranjang", "success");

    </script>
    @endif

    @if(Session::get('kosongcart'))
    <script>
        swal("Gagal!", "Keranjang Masih Kosong", "error");
    </script>
    @endif

    @if(Session::get('logindulu'))
    <script>
        swal("Gagal!", "Silahkan Login Terlebih Dahulu", "error");
    </script>
    @endif

</body>
