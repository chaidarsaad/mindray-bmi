<footer id="footer" class="footer py-4">
    <div class="footer-wrap">
        <div class="footer-body">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="">
                        {{-- <div class="col-xl-6 col-md-8 col-12"> --}}
                        <div class="footer-infor">
                            <div class="footer-logo">
                                @if (!empty($about->logo))
                                    <img src="{{ Storage::url($about->logo) }}" alt="" class="logo-bmi" />
                                @else
                                    <img src="{{ asset('assets/images/logo/bmi.webp') }}" alt="Default Logo"
                                        class="logo-bmi" />
                                @endif
                            </div>

                            <ul class="list-unstyled">
                                <li style="margin-bottom: 20px">
                                    @if (!empty($about->trusted))
                                        <p>{{ $about->trusted }}</p>
                                    @endif
                                </li>
                                <li>
                                    @if (!empty($about->address))
                                        <p>Alamat: <a href="">
                                                {{ $about->address }}
                                            </a>
                                        </p>
                                    @endif
                                </li>
                                <li>
                                    @if (!empty($about->email))
                                        <p>Email: <a href="mailto:{{ $about->email }}">{{ $about->email }}</a></p>
                                    @endif
                                </li>
                                <li>
                                    @if (!empty($about->phone_number))
                                        <p>No HP: <a
                                                href="tel:+62{{ $about->phone_number }}">+62{{ $about->phone_number }}</a>
                                        </p>
                                    @endif
                                </li>
                            </ul>
                            <ul class="d-flex justify-content-center list-unstyled gap-3 mt-3">
                                @if (!empty($about->instagram))
                                    <li>
                                        <a href="{{ $about->instagram }}" target="_blank"
                                            class="btn btn-outline-secondary rounded-circle" style="color: #0105da"><i
                                                class="fa-brands fa-instagram" style="color: #0105da"></i></a>
                                    </li>
                                @endif
                                @if (!empty($about->facebook))
                                    <li>
                                        <a href="{{ $about->facebook }}" target="_blank"
                                            class="btn btn-outline-success rounded-circle" style="color: #0105da"><i
                                                class="fa-brands fa-facebook" style="color: #0105da"></i></a>
                                    </li>
                                @endif
                                @if (!empty($about->phone_number))
                                    <li>
                                        <a href="https://wa.me/+62{{ $about->phone_number }}" target="_blank"
                                            class="btn btn-outline-secondary rounded-circle" style="color: #0105da"><i
                                                class="fa-brands fa-whatsapp" style="color: #0105da"></i></a>
                                    </li>
                                @endif
                                @if (!empty($about->youtube))
                                    <li>
                                        <a href="{{ $about->youtube }}" target="_blank"
                                            class="btn btn-outline-success rounded-circle" style="color: #0105da"><i
                                                class="fa-brands fa-youtube" style="color: #0105da"></i></a>
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
