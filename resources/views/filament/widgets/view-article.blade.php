<div class="max-h-[70vh] overflow-y-auto px-4 py-2">
    <div class="text-sm mb-2">
        Ditulis oleh: {{ optional($record->user)->name ?? 'Admin' }} |
        {{ $record->created_at->translatedFormat('l, d F Y') }}
    </div>

    <img src="{{ asset('storage/' . $record->image) }}" alt="{{ $record->judul }}" class="w-full h-auto rounded mb-4">

    <div class=" max-w-none">
        {!! $record->content !!}
    </div>
</div>
