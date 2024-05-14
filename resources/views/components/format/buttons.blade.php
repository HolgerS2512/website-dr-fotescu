{{-- button section --}}

<div class="wrapper">
  <div class="mb-3 py-5">

    <div class="buttons">
      @php
        $li = 0;
      @endphp
      @foreach ($list as $row)
        <h2 {!! $aos::right(0, 100) !!}>{{ $row->title ? $row->title : __("messages.words.$row->words_name") }}</h2>
        <div class="btn-flex">
        @for ($itemIdx = 1; $itemIdx <= 20; $itemIdx++)
          @php
            $url = '';
            $alt = '';
            $title = '';
            $href = '';
            $li++;
            $offset = 0;

            if ($li > 5) {
              $li = 1;
              $offset = 200;
            }

            if (!is_null($row->{'item_' . $itemIdx})) {
              $page = $pages->where('link', $row->{'item_' . $itemIdx})->first();
              if (is_null($page)) {
                foreach ($pages->where('any_pages', true) as $p) {
                  $page = $p->subpages->where('link', $row->{'item_' . $itemIdx})->first();
                }
              }

              $title = $page->{$locale};
              $href = $locale === 'de' ? '' : $locale . '/';
              $href .= $page->weblink;
              $image = $row->itemImage($row->{'item_' . $itemIdx} . '.format.button');
            } else {
              return;
            }

            if (!is_null($image)) {
              $url = isset($image->src) && !empty($image->src) ? url($image->src) : '';
            }
          @endphp

          <figure {!! $aos::upLeft($li * 200, $offset) !!}>
            <img src="{{ $url }}" alt="{{ str_replace('-format-button', '', $image->getAlt()) }}" width="250" height="250">
            <figcaption>
              <h3 class="text-nowrap">{{ $title }}</h3>
            </figcaption>
            <a 
              href="{{ url($href) }}" 
              title="{{ $title }}"
            >{{ __('messages.words.read') }}</a>
          </figure>
          @endfor
        </div>

      @endforeach

    </div>

  </div>
</div>