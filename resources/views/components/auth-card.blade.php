<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-500 md:bg-gray-500 relative bg-center bg-cover bg-blend-multiply" style="background-image: url('{{ asset('/assets/img/auth/login-desktop.png') }}');">
    <div>
        {{-- {{ $logo }} --}}
    </div>

    <div class="w-full sm:max-w-md bg-white h-full md:h-fit overflow-hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 px-6 pt-4 pb-9 card-shadow">
        {{ $slot }}
    </div>
</div>
