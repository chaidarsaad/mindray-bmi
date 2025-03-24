@section('title')
    BMI | Detail Akun
@endsection

<div>
    <div id="wrapper">
        @if (session('notify-success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Toastify({
                        text: "{{ session('notify-success') }}",
                        duration: 4000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "green",
                    }).showToast();
                });
            </script>
        @endif

        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /Navbar -->

        <!-- page-title -->
        @livewire('components.page-title')
        <!-- /page-title -->

        {{-- my-account --}}
        <section class="flat-spacing-11">
            <div class="container">
                <div class="row">
                    @livewire('components.sidebar-dashboard')
                    <div class="col-lg-9">
                        <div class="my-account-content account-edit">
                            <div class="">
                                <form class="" wire:submit.prevent="updateProfile" id="form-password-change">
                                    <div class="tf-field style-1 mb_15">
                                        <input oninput="this.value = this.value.toLowerCase()" type="text"
                                            wire:model="name" class="tf-field-input tf-input" placeholder=" "
                                            type="text" id="property1">
                                        <label class="tf-field-label fw-4 text_black-2" for="property1">
                                            Nama</label>
                                    </div>

                                    <div class="tf-field style-1 mb_15">
                                        <input wire:model="email" class="tf-field-input tf-input" placeholder=" "
                                            type="email" id="property3" name="email">
                                        <label class="tf-field-label fw-4 text_black-2" for="property3">Email</label>
                                    </div>

                                    <span>(kosongkan password jika tidak ingin diubah)</span>
                                    <div class="tf-field style-1 mb_30">
                                        <input wire:model.lazy="password" class="tf-field-input tf-input" placeholder=""
                                            type="password" id="property5" name="password">
                                        <label class="tf-field-label fw-4 text_black-2" for="property5">
                                            Password baru</label>
                                    </div>

                                    <div class="tf-field style-1 mb_30">
                                        <input wire:model.lazy="password_confirmation" class="tf-field-input tf-input"
                                            placeholder=" " type="password" id="property6" name="password">
                                        <label class="tf-field-label fw-4 text_black-2" for="property6">Konfirmasi
                                            password</label>
                                    </div>
                                    <div class="mb_20">
                                        <button type="submit"
                                            class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- /my-account --}}

        <!-- Footer -->
        @livewire('components.footer')
        <!-- /Footer -->
    </div>

    <!-- whatsapp -->
    @livewire('components.whatsapp')
    <!-- /whatsapp -->

    <!-- mobile menu -->
    @livewire('components.mobile-menu')
    <!-- /mobile menu -->

    <!-- shoppingCart -->
    @livewire('components.sidebar-shopping-cart')
    <!-- /shoppingCart -->
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("notify-error", event => {
                const message = event.detail.message || "Terjadi kesalahan, coba lagi.";

                Toastify({
                    text: message,
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "red",
                }).showToast();
            });
        });
    </script>
@endpush
