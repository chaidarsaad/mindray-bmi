<div>
    @if (!empty($about->phone_number))
        <div class="whatsapp-popup">
            <a href="https://wa.me/+62{{ $about->phone_number }}" target="_blank">
                <i class="fa-brands fa-square-whatsapp whatsapp-popup-fa" style="color: #0105da"></i>
            </a>
        </div>
    @endif

</div>
