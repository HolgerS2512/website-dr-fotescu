<section class="header">
  @if($isSlideshow)
    <x-slideshow :src="$src" />
  @elseif (!$isSlideshow)
    <div class="img-box-header">
      <img 
        class="slideshow-img" 
        src="{{ asset($src[0]->image) }}" 
        alt="{{ str_replace(' ', '-', strtolower($src[0]->title)) . '-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden' }}"
      >
    </div>
  @endif
  
  @php
    $title = '';

    switch ($currPageValues->link) {
      case 'home':
        $splitArr = explode(' ', (__('messages.words.nav_title')));
        $title = array_reverse($splitArr)[0] . '<br/>';
        for($i = 0; $i < count($splitArr) - 1; $i++) {
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