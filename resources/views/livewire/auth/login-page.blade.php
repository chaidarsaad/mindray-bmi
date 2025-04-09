@section('title')
    USG Mindray | Masuk
@endsection

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
                <a href="{{ route('home') }}" style="width: 120px; display: block; margin: 0 auto; margin-bottom: 18px;">
                    <img src="{{ asset('assets/images/logo/bmi.webp') }}" alt="logo" />
                </a>
                <h5 class="mb_18 text-center">Masuk</h5>
                <div>
                    <form wire:submit.prevent="login" class="" id="login-form" accept-charset="utf-8">
                        <div class="tf-field style-1 mb_15">
                            <input oninput="this.value = this.value.toLowerCase()" wire:model.lazy="name"
                                class="tf-field-input tf-input" placeholder="Masukkan nama" type="text"
                                id="property3" />
                            <label class="tf-field-label fw-4 text_black-2" for="property3">Nama *</label>
                        </div>
                        <div class="tf-field style-1 mb_30">
                            <input wire:model.lazy="password" class="tf-field-input tf-input"
                                placeholder="Masukkan password" type="password" id="property4" name="password" />
                            <label class="tf-field-label fw-4 text_black-2" for="property4">Password *</label>
                        </div>

                        <div class="mb_20">
                            <button type="submit"
                                class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">
                                Masuk
                            </button>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('register') }}" class="tf-btn btn-line">Belum punya
                                akun?
                                daftar
                                disini</a>
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
