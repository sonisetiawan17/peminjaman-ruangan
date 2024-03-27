<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
</head>

<body>
    <nav class="fixed bg-transparent z-10 w-full">
        <div class="py-2 px-32">
            <div class="flex flex-row items-center justify-between">
                <img src="{{ asset('/assets/img/auth/logo.png') }}" class="h-[60px]" />
                <button class="button-primary text-small rounded-lg px-4">Dashboard</button>
            </div>
        </div>
    </nav>
    <main class="bg-gradient">
        <div class="pt-[77px] relative h-screen">
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[70%]">
                <div>
                    <h1 class="font-bold text-6xl text-center">Strategi Trading Crypto Untuk <span
                            class="block pt-3 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-transparent bg-clip-text h-[85px]">Gandain Uang Kalian</span></h1>
                    <p class="pt-4 font-semibold text-lg text-center">87% Murid di Akademi berhasil melipatgandakan
                        portofolionya <span class="block pt-2">dalam waktu 3 bulan menggunakan strategi kita.</span></p>
                </div>

                <div class="mt-10 text-center">
                    <button class="button-primary text-small rounded-lg px-4">Lihat Ruangan</button>
                </div>
            </div>
        </div>

        <div>
            <div class="flex flex-row items-center justify-between gap-3">
                <div class="w-[40%] h-[2px] bg-neutral-400/20"></div>
                <h1 class="text-xl uppercase font-medium tracking-wider bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-transparent bg-clip-text">Pilih Ruangan</h1>
                <div class="w-[40%] h-[2px] bg-neutral-400/20"></div>
            </div>

            <div class="mt-12 grid grid-cols-2 mx-52">
               <div class="bg-red-500">1</div>
               <div class="bg-blue-500">2</div>
            </div>
        </div>

    </main>
</body>

</html>
