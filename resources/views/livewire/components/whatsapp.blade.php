@push('styles')
    <style>
        .whatsapp-popup {
            display: flex;
            flex-direction: column;
            /* Menyusun elemen secara vertikal */
            align-items: center;
            /* Menyelaraskan elemen di tengah */
        }

        .whatsapp-popup p {
            color: #0105da;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            /* Memberikan jarak antara tulisan dan ikon */
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
