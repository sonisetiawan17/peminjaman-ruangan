<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
</head>
@php
    $bodyClass = !empty($boxedLayout) ? 'boxed-layout' : '';
    $bodyClass .= !empty($paceTop) ? 'pace-top ' : '';
    $bodyClass .= !empty($bodyExtraClass) ? $bodyExtraClass . ' ' : '';
    $sidebarHide = !empty($sidebarHide) ? $sidebarHide : '';
    $sidebarTwo = !empty($sidebarTwo) ? $sidebarTwo : '';
    $sidebarSearch = !empty($sidebarSearch) ? $sidebarSearch : '';
    $topMenu = !empty($topMenu) ? $topMenu : '';
    $footer = !empty($footer) ? $footer : '';

    $pageContainerClass = !empty($topMenu) ? 'page-with-top-menu ' : '';
    $pageContainerClass .= !empty($sidebarRight) ? 'page-with-right-sidebar ' : '';
    $pageContainerClass .= !empty($sidebarLight) ? 'page-with-light-sidebar ' : '';
    $pageContainerClass .= !empty($sidebarWide) ? 'page-with-wide-sidebar ' : '';
    $pageContainerClass .= !empty($sidebarHide) ? 'page-without-sidebar ' : '';
    $pageContainerClass .= !empty($sidebarMinified) ? 'page-sidebar-minified ' : '';
    $pageContainerClass .= !empty($sidebarTwo) ? 'page-with-two-sidebar ' : '';
    $pageContainerClass .= !empty($contentFullHeight) ? 'page-content-full-height ' : '';

    $contentClass = !empty($contentFullWidth) || !empty($contentFullHeight) ? 'content-full-width ' : '';
    $contentClass = !empty($contentInverseMode) ? 'content-inverse-mode ' : '';
@endphp

<body class="{{ $bodyClass }}">
    @include('includes.component.page-loader')

    <div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed {{ $pageContainerClass }}">

        @include('includes.header')

        @includeWhen($topMenu, 'includes.top-menu')

        @includeWhen(!$sidebarHide, 'includes.sidebar-super')

        @includeWhen($sidebarTwo, 'includes.sidebar-right')

        <div id="content" class="content {{ $contentClass }}">
            @yield('content')
        </div>

        @includeWhen($footer, 'includes.footer')

        {{-- @include('includes.component.theme-panel') --}}

        @include('includes.component.scroll-top-btn')

    </div>

    @include('includes.page-js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (Session::has('sukses'))
        <script>
            toastr.success("{!! Session::get('sukses') !!}")
        </script>
    @elseif (Session::has('error'))
        <script>
            toastr.error("{!! Session::get('error') !!}")
        </script>
    @endif

    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> --}}
</body>

</html>
