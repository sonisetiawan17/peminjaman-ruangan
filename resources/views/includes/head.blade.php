<meta charset="utf-8" />
<title>@yield('title')</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Mulish:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<link href="/assets/css/default/app.min.css" rel="stylesheet" />
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<style>
    body {
        font-size: 13px;
        background-color: #f8fafc;
        font-family: 'Poppins', sans-serif;
    }

    .head {
        padding: 15px;
    }

    .card-content {
        padding: 20px;
    }

    .bg-gradient {
        background: rgb(215,222,255);
        background: radial-gradient(circle, rgba(215,222,255,1) 42%, rgba(246,250,253,1) 100%);
    }

    .tgl_info {
        color: rgb(221, 26, 26);
        font-size: 12px;
        font-style: italic;
        padding-top: 10px;
    }

    .button-primary {
        padding: 8px 12px;
        background-color: #5465ff;
        color: white;
        border-radius: 2px;
        transition-duration: 300ms;
        font-size: 13px;
    }

    .button-primary:hover {
        background-color: #5465ffb3;
    }

    .button-ghost {
        padding: 8px 12px;
        background-color: rgb(215, 216, 218, 0.7);
        color: rgb(8, 8, 8);
        text-decoration: none;
        transition-duration: 300ms;
        border-radius: 2px;
        font-size: 13px;
    }

    .button-ghost:hover {
        background-color: rgba(215, 216, 218, 0.5);
        text-decoration: none;
        color: rgb(8, 8, 8);
    }

    .breadcrumb-item:hover {
        text-decoration: none !important;
    }

    .text-small {
        font-size: 13.5px;
        border-radius: 2px;
    }

    .panel-heading h4 {
        font-size: 17px !important;
        font-weight: 500 !important;
        padding: 8px 0 !important;
    }

    .blue-gradient {
        background: rgb(88, 184, 255);
        background: linear-gradient(132deg, rgba(88, 184, 255, 1) 0%, rgba(0, 82, 255, 1) 100%);
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    }

    .yellow-gradient {
        background: rgb(251, 188, 6);
        background: linear-gradient(132deg, rgba(251, 188, 6, 1) 0%, rgba(233, 187, 0, 1) 100%);
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    }

    .red-gradient {
        background: rgb(255, 115, 115);
        background: linear-gradient(132deg, rgba(255, 115, 115, 1) 0%, rgba(255, 0, 0, 1) 100%);
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    }

    .green-gradient {
        background: rgb(64, 210, 42);
        background: linear-gradient(132deg, rgba(64, 210, 42, 1) 0%, rgba(33, 176, 31, 1) 100%);
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    }

    .active {
        color: #5465ff;
        font-weight: 600;
    }
</style>
@stack('css')
