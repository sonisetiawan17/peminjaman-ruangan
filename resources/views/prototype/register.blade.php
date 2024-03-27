<x-guest-layout>
    <x-auth-card>
        <div class="font-extrabold text-center text-2xl mt-5">
            <h1>Daftar</h1>
        </div>

        <div class="text-sm text-center mt-2 mb-10">
            <p>Sudah punya akun? <a href="{{ route('login') }}"><span class="text-primary">Masuk</span></a></p>
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" id="multiStepForm">
            @csrf

            <div class="step step1">
                <div>
                    <x-label for="name" :value="__('Nama')" />
    
                    <input id="name" class="mt-1 block w-full border-gray-300 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="name" value="{{ old('name') }}" autofocus />
                </div>
    
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />
    
                    <input id="email" class="mt-1 block w-full border-gray-300 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md shadow-sm" type="email" name="email" value="{{ old('email') }}" />
                </div>
    
                <div class="mt-4 relative">
                    <x-label for="password" :value="__('Kata Sandi')" />
    
                    <input id="password" class="mt-1 block w-full border-gray-300 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md shadow-sm pl-10" type="password" name="password" autocomplete="new-password" />

                    {{-- <div class="absolute top-[34px] left-3 cursor-pointer" id="div" class="div">
                        <i class="fa-regular fa-eye-slash text-neutral-500" id="icon" class="icon"></i>
                    </div> --}}
                </div>
    
                <div class="mt-4 relative">
                    <x-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
    
                    <input id="password_confirmation" class="mt-1 block w-full border-gray-300 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md shadow-sm pl-10"
                                    type="password"
                                    name="password_confirmation" />

                    {{-- <div class="absolute top-[34px] left-3 cursor-pointer" id="div2" class="div">
                        <i class="fa-regular fa-eye-slash text-neutral-500" id="icon2" class="div"></i>
                    </div>                            --}}
                </div>
            </div>

            <div class="step step2">
                <div class="mt-4">
                    <x-label for="nik" :value="__('NIK')" />
    
                    <input id="nik" class="mt-1 block w-full border-gray-300 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="nik" value="{{ old('nik') }}" />
                </div>
    
                <div class="mt-4">
                    <x-label for="no_telp" :value="__('No Telepon')" />
    
                    <input id="no_telp" class="mt-1 block w-full border-gray-300 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="no_telp" value="{{ old('no_telp') }}" />
                </div>
    
                <div class="mt-4">
                    <x-label for="alamat" :value="__('Alamat')" />
    
                    <input id="alamat" class="mt-1 block w-full border-gray-300 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="alamat" value="{{ old('alamat') }}" />
                </div>
    
                <div class="mt-4">
                    <x-label for="nama_organisasi" :value="__('Nama Organisasi')" />
    
                    <input id="nama_organisasi" class="mt-1 block w-full border-gray-300 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="nama_organisasi" value="{{ old('nama_organisasi') }}" />
                </div>
    
                <div class="mt-4">
                    <x-label for="instansi_id" :value="__('Instansi')" />
    
                    <select id="instansi" name="instansi_id" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>--- Pilih instansi ---</option>
                        @foreach ($instansi as $item)
                            <option value="{{ $item->id_instansi }}">{{ $item->nama_instansi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between gap-2">
                <button type="button" onclick="prevStep()" id="prevBtn" class="py-2 w-full bg-neutral-200 text-black rounded-lg">Kembali</button>
                <button type="button" onclick="nextStep()" id="nextBtn" class="w-full py-2 bg-slate-900/10 text-black/50 rounded-lg cursor-not-allowed">Selanjutnya</button>
                <button type="submit" id="submitBtn" style="display: none;" class="w-full py-2 bg-slate-900/10 text-black/50 rounded-lg cursor-not-allowedg">Register</button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

<script src="{{ asset('js/auth/register-script.js') }}"></script>

