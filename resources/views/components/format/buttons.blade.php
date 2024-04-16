{{-- button section --}}

<div class="wrapper">
  <div class="mb-3 py-5">

    <div class="buttons">
      @php
        $li = 0;
      @endphp
      @foreach ($list as $attr)
        <h2 {!! $aos::right(0, 100) !!}>{{ $attr->title }}</h2>
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

            if (!is_null($attr->{'item_' . $itemIdx})) {
              $page = $pages->where('link', $attr->{'item_' . $itemIdx})->first();
              if (is_null($page)) {
                foreach ($pages->where('any_pages', true) as $p) {
                  $page = $p->subpages->where('link', $attr->{'item_' . $itemIdx})->first();
                }
              }
              $title = $page->{$locale};
              $href = $locale === 'de' ? '' : $locale . '/';
              $href .= $page->weblink;
              $image = $attr->itemImage($attr->{'item_' . $itemIdx} . '.format.button');
            } else {
              return;
            }

            if (!is_null($image)) {
              $url = isset($image->src) && !empty($image->src) ? url($image->src) : '';
              $alt = str_replace('.format.button', '', $image->title) . '-' . __("messages.words.nav_title") . '-' . $infos->city . '-' . $image->ext;
              $alt = preg_replace('/[. ( -)]+/', '-', mb_strtolower($alt));
            }
          @endphp

          <figure {!! $aos::upLeft($li * 200, $offset) !!}>
            <img src="{{ $url }}" alt="{{ $alt }}" width="250" height="250">
            <figcaption>
              <h3>{{ $title }}</h3>
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