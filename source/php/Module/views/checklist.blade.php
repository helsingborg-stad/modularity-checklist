<div class="{{ $classes }} {{ isset($font_size) ? $font_size : '' }}">
    @if (!$hideTitle && !empty($post_title))
        <h4 class="box-title">{!! apply_filters('the_title', $post_title) !!}</h4>
    @endif

    <ul class="checklist">
        @foreach($items as $item)
            <li>
                <span class="checklist__item {!! $item['checked'] ? 'checklist__item--checked' : '' !!}">{{ $item['text'] }}</span>
            </li>
        @endforeach
    </ul>
</div>
