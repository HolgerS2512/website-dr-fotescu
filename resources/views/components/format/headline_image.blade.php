{{-- special [ long title | title ] & image section (overlap) --}}
{{-- headline --}}
{{-- image  --}}{{-- [ headline | text | list item with headline ]  --}}
{{-- [ button ?? button | list item | link ] --}}

<div class="wrapper {{ $rang === 1 ? ' mt-5 pt-2' : '' }}">
  <div class="{{ $rang === 1 ? 'mt-5 pt-5 ' : '' }}mb-3">
    <div class="row">

      <div class="col-auto offset-sm-1 offset-lg-3 offset-xxl-4 headline-img-offset">
        @if ( ! is_null($content->{$locale}) )
          @foreach ($content->{$locale} as $row)
            @if ( ! is_null($row->title) )
              <h2 {!! $aos::left() !!}>
                <b>{!! $row->title !!}</b>
              </h2>
            @endif
          @endforeach
        @endif
      </div>

    </div>
  </div>
</div>

<div class="wrapper no-wrapper-992">
  <div class="headline-image mb-5 pb-lg-5 ps-xl-5">
    <div class="mb-3 mb-lg-0 img-box offset-sm-1 px-sm-3 ps-lg-5 ms-lg-5 offset-lg-0 pe-lg-0 mb-lg-5 pb-lg-5">
      <img
        width="600" height="400"
        class="img-fluid z-1" loading="lazy"
        src="{{ url( $content->image()->src ) }}" 
        alt="{{ $content->image()->getAlt() }}"
        {!! $aos::upRight(200, 200) !!}
      >
    </div>

    <div class="text-wrapper-max992 text-box offset-sm-1 px-sm-3 offset-lg-0 px-lg-0">

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
              <h3 class="z-2 textblack" {!! $aos::right(200) !!}>{!! $headline !!}</h3>
            @else
              <p class="z-2 hi-img-p" {!! $aos::right(200) !!}>{!! $row->content !!}</p>
            @endif
          @endif
        @endforeach
      @endif

      @if ( ! is_null($content->{$locale . 'List'}) )
        @foreach ($content->{$locale . 'List'} as $row)
          <ul class="z-2 square-list hl-img-list">
            @for ( $i=1; $i < 20; $i++ )
              @if ( is_null($row->{'item_' . $i}) ) @break @endif
              <li {!! $aos::left(200 * $i) !!}>
                <p>{{ $row->{'item_' . $i} }}</p>
              </li>
            @endfor
          </ul>
        @endforeach
      @endif

      @if ($content->btn)
        @php
          $page = $pages->find($content->btn);
        @endphp
        <div class="z-2 mt-4" {!! $aos::right(200, 200) !!}>
          <a 
            class="x-btn ms-lg-5 mt-lg-5"
            href="{{ url( ($locale === 'de' ? '' : $locale . '/') . $page->weblink ) }}"
            title="{{ $page->{$locale} }}"
          >{{ $page->{$locale} }}</a>
        </div>
      @endif

    </div>
  </div>
</div>