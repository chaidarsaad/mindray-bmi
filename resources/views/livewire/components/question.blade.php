<div>
    @if ($questions->isNotEmpty())
        <section class="flat-spacing-11">
            <div class="container">
                <div class="tf-accordion-wrap d-flex justify-content-between">
                    <div class="content">
                        <h5 class="mb_24">Pertanyaan</h5>
                        <div class="flat-accordion style-default has-btns-arrow mb_60">
                            @foreach ($questions as $question)
                                <div class="flat-toggle">
                                    <div class="toggle-title">
                                        {{ $question->question }}
                                    </div>
                                    <div class="toggle-content">
                                        <p>{{ $question->answer }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
