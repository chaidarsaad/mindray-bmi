<footer id="footer" class="footer py-4">
    <div class="footer-wrap">
        <div class="footer-body">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="">
                        {{-- <div class="col-xl-6 col-md-8 col-12"> --}}
                        <div class="footer-infor">
                            <div class="footer-logo">
                                <img src="{{ $about->logo ? Storage::url($about->logo) : asset('assets/images/logo/bmi.webp') }}"
                                    alt="Logo" class="logo-bmi" />
                            </div>

                            <ul class="list-unstyled">
                                <li>
                                    <p>{{ $about->trusted ?: '' }}</p>
                                </li>
                                <li>
                                    <p>Alamat: <a href="">
                                            {{ $about->address }}
                                        </a>
                                    </p>
                                </li>
                                <li>
                                    <p>Email: <a href="mailto:{{ $about->email }}">{{ $about->email }}</a></p>
                                </li>
                                <li>
                                    <p>No HP: <a
                                            href="tel:+62{{ $about->phone_number }}">+62{{ $about->phone_number }}</a>
                                    </p>
                                </li>
                            </ul>
                            <ul class="d-flex justify-content-center list-unstyled gap-3 mt-3">
                                @if (!empty($about->instagram))
                                    <li>
                                        <a href="{{ $about->instagram }}" target="_blank"
                                            class="btn btn-outline-secondary rounded-circle"><i
                                                class="fa-brands fa-instagram"></i></a>
                                    </li>
                                @endif
                                @if (!empty($about->facebook))
                                    <li>
                                        <a href="{{ $about->facebook }}" target="_blank"
                                            class="btn btn-outline-success rounded-circle"><i
                                                class="fa-brands fa-facebook"></i></a>
                                    </li>
                                @endif
                                @if (!empty($about->phone_number))
                                    <li>
                                        <a href="{{ $about->phone_number }}" target="_blank"
                                            class="btn btn-outline-secondary rounded-circle"><i
                                                class="fa-brands fa-whatsapp"></i></a>
                                    </li>
                                @endif
                                @if (!empty($about->youtube))
                                    <li>
                                        <a href="{{ $about->youtube }}" target="_blank"
                                            class="btn btn-outline-success rounded-circle"><i
                                                class="fa-brands fa-youtube"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
