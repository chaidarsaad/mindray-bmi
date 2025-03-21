@section('title')
    BMI | Daftar
@endsection

@push('styles')
@endpush

<div id="wrapper">
    <section class="flat-spacing-10"
        style="
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
  ">
        <div class="container">
            <div class="form-register-wrap">
                <a href="{{ route('home') }}" wire:navigate.ignore
                    style="width: 120px; display: block; margin: 0 auto; margin-bottom: 18px;">
                    <img src="{{ asset('assets/images/logo/bmi.webp') }}" alt="logo" />
                </a>
                <h5 class="mb_18 text-center">Daftar</h5>
                <div>
                    <form wire:submit.prevent="register" accept-charset="utf-8" data-mailchimp="true">
                        <div class="tf-field style-1 mb_15">
                            <input oninput="this.value = this.value.toLowerCase()" wire:model.lazy="name"
                                class="tf-field-input tf-input" placeholder="Masukkan nama" type="text"
                                id="property1" name="name" />
                            <label class="tf-field-label fw-4 text_black-2" for="property1">Nama *</label>
                        </div>

                        <div class="tf-field style-1 mb_15">
                            <input wire:model.lazy="email" class="tf-field-input tf-input" placeholder="Masukkan email"
                                type="email" id="property3" name="email" />
                            <label class="tf-field-label fw-4 text_black-2" for="property3">Email *</label>
                        </div>

                        <div class="tf-field style-1 mb_15">
                            <input wire:model.lazy="password" class="tf-field-input tf-input"
                                placeholder="Masukkan password" type="password" id="property4" name="password" />
                            <label class="tf-field-label fw-4 text_black-2" for="property4">Password *</label>
                        </div>

                        <div class="tf-field style-1 mb_30">
                            <input wire:model.lazy="password_confirmation" class="tf-field-input tf-input"
                                placeholder="Masukkan konfirmasi password" type="password" id="property5" />
                            <label class="tf-field-label fw-4 text_black-2" for="property5">Konfirmasi Password
                                *</label>
                        </div>
                        <div class="mb_20">
                            <button type="submit" wire:loading.attr="disabled"
                                class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">
                                Daftar
                            </button>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('login') }}" wire:navigate.ignore class="tf-btn btn-line">Sudah punya
                                akun? masuk
                                disini<i class="icon icon-arrow1-top-left"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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
