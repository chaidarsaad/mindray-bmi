<div>
    <div class="mb-2">
        Ditulis oleh: {{ optional($record->user)->name ?? 'Admin' }} |
        {{ $record->created_at->translatedFormat('l, d F Y') }}
    </div>

    <img src="{{ Storage::url($record->image) }}" alt="{{ $record->judul }}" class="w-full h-auto rounded mb-4">

    <div class="max-w-none">
        {!! $record->content !!}
    </div>
</div>
