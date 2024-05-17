{{-- special [ long title | title ] & image section (overlap) --}}
{{-- headline --}}
{{-- image  --}}{{-- [ headline | text | list item with headline ]  --}}
{{-- [ button ?? button | list item | link ] --}}

<div class="wrapper {{ $rang === 1 ? ' mt-5 pt-2' : ' pt-5' }}">
  <div class="{{ $rang === 1 ? 'mt-5 pt-5 ' : '' }}mb-3">
    <div class="row g-lg-0">
      <div class="col-auto px-md-3 offset-md-1 offset-xxl-3 hl-img-title">
        @if ( ! is_null($content->{$locale}) )
          @foreach ($content->{$locale} as $row)
            @if ( ! is_null($row->title) )
              <h2 {!! $aos::right() !!}>
                <b>{!! $row->title !!}</b>
              </h2>
            @endif
          @endforeach
        @endif
      </div>
    </div>
  </div>
</div>

@if ( ! is_null($content->image()) )
  <div class="wrapper no-wrapper-992">
    <div class="headline-image mb-5 pb-xxl-5 ps-xxl-5">
      <div class="mb-3 mb-xxl-0 img-box offset-md-1 px-md-3 offset-xxl-0 px-xxl-0">
        <img
          width="600" height="400"
          class="img-fluid z-1" loading="lazy"
          src="{{ url( $content->image()->src ) }}" 
          alt="{{ $content->image()->getAlt() }}"
          {!! $aos::upRight(200, 200) !!}
        >
      </div>
@endif

    <div class="text-wrapper-max992 text-box offset-md-1 px-md-3 offset-xxl-0 px-xxl-0">

      @if ( ! is_null($content->{$locale}) )
        @foreach ($content->{$locale} as $row)
          @if ( ! is_null($row->content) )
            @php
              $headline = false;

              if ( str_contains($row->content, '<headline>') ) {
                $headline = substr($row->content, strlen('<headline>'));
              }
            @endphp
            @if ($headline)
              <h3 class="z-2 textblack" {!! $aos::left(100 * $loop->index, 100) !!}>{!! $headline !!}</h3>
            @else
              <p class="z-2 hi-img-p" {!! $aos::left(100 * $loop->index, 100) !!}>
                {!! $row->content !!}
                @if ( ! is_null($content->url_link) )
                  <br>
                  <a 
                    href="{{ $content->url_link }}"
                    target="_blank" rel="noopener noreferrer"
                  >{{ $content->url_link }}</a>
                @endif
              </p>
            @endif
          @endif
        @endforeach
      @endif

      @if ( ! is_null($content->{$locale . 'List'}) )
        @foreach ($content->{$locale . 'List'} as $row)
          @if ( ! is_null($row->title) )
            <h3 class="z-2 textblack mb-0 pt-3" {!! $aos::right(200) !!}>{!! $row->title !!}</h3>
          @endif
          <ul class="z-2 square-list hl-img-list" {!! $aos::left(300) !!}>
            @for ( $i=1; $i < 20; $i++ )
              @if ( empty($row->{'item_' . $i}) ) @break @endif
              <li {!! $aos::left(100 * $i) !!}>
                <p>{{ $row->{'item_' . $i} }}</p>
              </li>
            @endfor
          </ul>
        @endforeach
      @endif

      @if ($content->btn)
        @php
          if (str_contains($content->btn, 'subpage')) {
            $page = $subpages->find(str_replace('subpage.', '', $content->btn));
          } else {
            $page = $pages->find($content->btn);
          }
        @endphp
        <div class="z-2 my-4" {!! $aos::right(200, 200) !!}>
          <a 
            class="x-btn ms-xxl-5 mb-md-5 mt-md-3 mt-xxl-5"
            href="{{ url( ($locale === 'de' ? '' : $locale . '/') . $page->weblink ) }}"
            title="{{ $page->{$locale} }}"
          >{{ $page->{$locale} }}</a>
        </div>
      @endif

    </div>
  </div>
</div>
