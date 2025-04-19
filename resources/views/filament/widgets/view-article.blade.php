<div>
    <div class="text-sm mb-2">
        Ditulis oleh: {{ optional($record->user)->name ?? 'Admin' }} |
        {{ $record->created_at->translatedFormat('l, d F Y') }}
    </div>

    <img src="{{ asset('storage/' . $record->image) }}" alt="{{ $record->judul }}" class="w-full h-auto rounded mb-4">

    <div class=" max-w-none">
        {!! $record->content !!}
    </div>
</div>

<script>
    setTimeout(() => {
        (document.querySelector('[data-modal-container]') ?? window).scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }, 100);
</script>
