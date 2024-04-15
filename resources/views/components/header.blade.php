<section class="header">
  @if($isSlideshow)
    <x-slideshow :src="$src" :infos="$infos" />
  @else
    @if($src)
      @php
        $alt = $src[0]->title . '-' . __("messages.words.nav_title") . '-' . $infos->city . '-' . $src[0]->ext;
        $alt = preg_replace('/[. ( -)]+/', '-', mb_strtolower($alt));
      @endphp
    {{-- @elseif (!$isSlideshow) --}}
      <div class="img-box-header">
        <img 
          class="slideshow-img" 
          src="{{ asset($src[0]->src) }}" 
          alt="{{ $alt }}"
        >
      </div>
    @else
      <div style="margin-top:300px;">Noch bearbeiten! header.blade.php</div>
      {{-- data-aos-offset="0" data-aos="fade-right" data-aos-delay="100" data-aos-duration="750" --}}
    @endif
  @endif
  
  @php
    $title = '';

    switch ($currPageValues->link) {
      case 'home':
        $splitArr = explode(' ', (__('messages.words.nav_title')));
        $revArr = array_reverse($splitArr);

        $counter = 1;
        switch ($locale) {
          case 'de':
            $title = $revArr[0] . '<br/>';
            break;
          case 'en':
            $title = $revArr[1] . ' ' . $revArr[0] . '<br/>';
            $counter = 2;
            break;
          case 'ru':
            $title = $revArr[1] . ' ' . $revArr[0] . '<br/>';
            $counter = 2;
            break;
        }

        for($i = 0; $i < count($splitArr) - $counter; $i++) {
          $title .= ($i === 0 ? '' : ' ') . $splitArr[$i];
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
  <h1>{!! ucwords($title) !!}</h1>
</section>