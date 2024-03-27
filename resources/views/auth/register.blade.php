@section('title', 'Register')
<x-guest-layout>
    <x-auth-card>
        <div class="font-extrabold text-center mt-5">
            <div class="pb-3">
                <img src="{{ asset('/assets/img/auth/logo.png') }}" class="h-[50px] mx-auto" />
            </div>
            <h1 class="text-2xl mt-3">Daftar</h1>
        </div>

        <div class="text-sm text-center mt-2 mb-10">
            <p>Sudah punya akun? <a href="{{ route('login') }}"><span class="text-primary">Masuk</span></a></p>
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf
            <div class="form-section">
                <div>
                    <x-label for="name" :value="__('Nama')" />
                    <input id="name" class="auth-form-input" type="text" name="name"
                        value="{{ old('name') }}" autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />
                    <input id="email" class="auth-form-input" type="email" name="email"
                        value="{{ old('email') }}" />
                </div>

                <div class="mt-4 relative">
                    <x-label for="password" :value="__('Kata Sandi')" />
                    <input id="password" class="auth-form-input pl-10" type="password" name="password"
                        autocomplete="new-password" />
                    <div class="absolute top-[35px] left-3 cursor-pointer" id="div">
                        <i class="fa-regular fa-eye-slash text-neutral-500" id="icon"></i>
                    </div>
                </div>

                <div class="mt-4 relative">
                    <x-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
                    <input id="password_confirmation" class="auth-form-input pl-10" type="password"
                        name="password_confirmation" />
                    <div class="absolute top-[35px] left-3 cursor-pointer" id="div-sec">
                        <i class="fa-regular fa-eye-slash text-neutral-500" id="icon-sec"></i>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="mt-4">
                    <div class="flex items-center">
                        <x-label for="nik" :value="__('NIK')" />
                        <span class="text-red-700">*</span>
                    </div>
                    <input id="nik" class="auth-form-input" type="text" name="nik"
                        value="{{ old('nik') }}" />
                </div>

                <div class="mt-4">
                    <div class="flex items-center">
                        <x-label for="instansi_id" :value="__('Instansi')" />
                        <span class="text-red-700">*</span>
                    </div>
                    <select id="instansi_id" name="instansi_id"
                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>--- Pilih instansi ---</option>
                        @foreach ($instansi as $item)
                            <option value="{{ $item->id_instansi }}">{{ $item->nama_instansi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4 hidden" id="instansi">
                    <div class="flex items-center">
                        <x-label for="nama_instansi" :value="__('Nama Instansi')" />
                        <span class="text-red-700">*</span>
                    </div>
                    <input id="nama_instansi" class="auth-form-input" type="text" name="nama_instansi"
                        value="{{ old('nama_instansi') }}" />
                </div>

                <div class="mt-4">
                    <div class="flex items-center">
                        <x-label for="no_telp" :value="__('No Telepon')" />
                        <span class="text-red-700">*</span>
                    </div>
                    <input id="no_telp" class="auth-form-input" type="text" name="no_telp"
                        value="{{ old('no_telp') }}" />
                </div>

                <div class="mt-4">
                    <div class="flex items-center">
                        <x-label for="nama_organisasi" :value="__('Nama Organisasi / Pribadi')" />
                        <span class="text-red-700">*</span>
                    </div>
                    {{-- <x-label for="nama_organisasi" :value="__('Nama Organisasi / Pribadi')" /> --}}
                    <input id="nama_organisasi" class="auth-form-input" type="text" name="nama_organisasi"
                        value="{{ old('nama_organisasi') }}" />
                </div>
            </div>

            <div class="form-navigation mt-8 flex items-center justify-between gap-2">
                <button type="button"
                    class="previous py-2 w-full bg-slate-900/10 text-black rounded-lg">Kembali</button>
                <button type="button" class="next w-full py-2 bg-slate-900/10 text-black/50 rounded-lg"
                    disabled>Selanjutnya</button>
                <button type="submit" class="btn-submit w-full py-2 bg-slate-900/10 text-black/50 rounded-lg"
                    disabled>Register</button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

<script src="{{ asset('js/auth/register-script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
    integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(function() {
        var $sections = $('.form-section')

        function navigateTo(index) {
            $sections.removeClass('current').eq(index).addClass('current')
            $('.form-navigation .previous').toggle(index > 0)
            var atTheEnd = index >= $sections.length - 1;
            $('.form-navigation .next').toggle(!atTheEnd)
            $('.form-navigation [type=submit]').toggle(atTheEnd)
        }

        function curIndex() {
            return $sections.index($sections.filter('.current'))
        }

        $('.form-navigation .previous').click(function() {
            navigateTo(curIndex() - 1)
        })

        $('.form-navigation .next').click(function() {
            $('.register-form').parsley().whenValidate({
                group: 'block-' + curIndex()
            }).done(function() {
                navigateTo(curIndex() + 1)
            })
        })

        $sections.each(function(index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block' + index)
        })

        navigateTo(0)
    })
</script>

<script>
    document.getElementById("instansi_id").addEventListener("change", function() {
        const selectedValue = this.value;

        if (selectedValue == 21) {
            document.getElementById("instansi").classList.remove('hidden');
        } else {
            document.getElementById("instansi").classList.add('hidden');
        }
    });

    const div = document.getElementById("div");
    const icon = document.getElementById("icon");

    const divSec = document.getElementById("div-sec");
    const iconSec = document.getElementById("icon-sec");

    div.addEventListener("click", function () {
        icon.classList.toggle("fa-eye-slash");
        icon.classList.toggle("fa-eye");

        if (password.type === "password") {
            password.type = "text";
        } else {
            password.type = "password";
        }
    });

    divSec.addEventListener("click", function () {
        iconSec.classList.toggle("fa-eye-slash");
        iconSec.classList.toggle("fa-eye");

        if (password_confirmation.type === "password") {
            password_confirmation.type = "text";
        } else {
            password_confirmation.type = "password";
        }
    })
</script>

