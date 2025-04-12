@push('styles')
    <style>
        .whatsapp-popup {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .whatsapp-popup p {
            color: #0105da;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .whatsapp-popup-fa {
            font-size: 2rem;
        }
    </style>
@endpush


<div>
    @if (!empty($about->phone_number))
        <div class="whatsapp-popup">
            <a href="https://wa.me/+62{{ $about->phone_number }}">
                <p>HUBUNGI KAMI</p>
            </a>
            <a href="https://wa.me/+62{{ $about->phone_number }}" target="_blank">
                <i class="fa-brands fa-square-whatsapp whatsapp-popup-fa" style="color: #0105da"></i>
            </a>
        </div>
    @endif
</div>
