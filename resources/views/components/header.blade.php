<section class="header{{ $src ? '' : ' header-no-src' }}">
  @if($isSlideshow)
    <x-slideshow :src="$src" :infos="$infos" :aos="$aos" />
  @else
    @if($src)
      @php
        $alt = $src[0]->title . '-' . __("messages.words.nav_title") . '-' . $infos->city . '-' . $src[0]->ext;
        $alt = preg_replace('/[. ( -)]+/', '-', mb_strtolower($alt));
      @endphp
    {{-- @elseif (!$isSlideshow) --}}
      <div class="img-box-header">
        <img 
          class="static-img" 
          src="{{ asset($src[0]->src) }}" 
          alt="{{ $alt }}"
          {!! $aos::right(100, 0) !!}
        >
      </div>
    {{-- @else
      <div>Bearbeiten (evtl.)! header.blade</div> --}}
    @endif
  @endif
  
  @php
    $title = '';

    switch ($currPageValues->link) {
      case 'home':
        $splitArr = explode(' ', (__('messages.words.main_title')));
        $title = $splitArr[0] . ($locale === 'de' ? '' : ' ' . $splitArr[1]) . '<br/>';

        for($i = ($locale === 'de' ? 1 : 2); $i < count($splitArr); $i++) {
          $title .= ' ' . $splitArr[$i];
        }
        break;
      case 'blog':
        $title = __('messages.words.page_title_blog');
        break;
      default:
        $title = __("messages.title.$currPageValues->link");
        break;
    }
  @endphp
  <h1 {!! $aos::left(100) !!}>{!! ucwords($title) !!}</h1>
</section>