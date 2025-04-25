@push('styles')
    <style>
        .whatsapp-chat {
            position: fixed;
            bottom: 80px;
            right: 15px;
            background: #0105da;
            border-radius: 9999px;
            padding: 0.25rem 0.75rem;
            box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 0.1);
            font-size: 0.75rem;
            font-weight: bold;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            user-select: none;
            z-index: 100;
        }

        .whatsapp-chat a {
            color: white;
            font-size: 1.25rem;
            text-decoration: none;
        }
    </style>
@endpush


<div>
    @if (!empty($about->phone_number))
        <div class="whatsapp-chat">
            <span>HUBUNGI KAMI</span>
            <a aria-label="WhatsApp chat" href="https://wa.me/+62{{ $about->phone_number }}" target="_blank"
                rel="noopener noreferrer">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
        {{-- <div class="whatsapp-popup">
            <a href="https://wa.me/+62{{ $about->phone_number }}">
                <p>HUBUNGI KAMI</p>
            </a>
            <a href="https://wa.me/+62{{ $about->phone_number }}" target="_blank">
                <i class="fa-brands fa-square-whatsapp whatsapp-popup-fa" style="color: #0105da"></i>
            </a>
        </div> --}}
    @endif
</div>
