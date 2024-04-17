{{-- form download section --}}

<div class="wrapper">
  <div class="mb-3 py-5">
    <div class="row">

      <div class="col-12 col-sm-11 col-lg-10 offset-sm-1 offset-lg-2">
        <form 
          action="{{ route('download') }}" 
          method="POST"
          class="download-link"
        >
          @csrf
          <input type="hidden" name="name" value="{{ $content->btn }}">
          <input type="hidden" name="path" value="{{ $content->url_link }}">

          <button type="submit" title="{{ __('messages.words.download_form') }}">
            {{ __('messages.words.download_form') }}

            @if ( ! is_null($content->image()) )
              <div>
                <img 
                  src="{{ asset("{$content->image()->src}") }}" 
                  alt="{{ preg_replace('/[. ( -)]+/', '-', mb_strtolower("{$content->image()->title}-" . __("messages.words.nav_title") . '-' . $infos->city . '-' . $content->image()->ext)) }}"
                  width="100"
                  height="100"
                  class="ms-3"
                >
              </div>
            @endif
          </button>
        </form>

        {{-- <a 
          href="{{ route('download') }}"
          title="{{ __('messages.words.download_form') }}"
          class="download-link"
        >
          {{ __('messages.words.download_form') }}
          @if ( ! is_null($content->image()) )
            <div>
              <img 
                src="{{ asset("{$content->image()->src}") }}" 
                alt="{{ preg_replace('/[. ( -)]+/', '-', mb_strtolower("{$content->image()->title}-" . __("messages.words.nav_title") . '-' . $infos->city . '-' . $content->image()->ext)) }}"
                width="100"
                height="100"
                class="ms-3"
              >
            </div>
          @endif
        </a> --}}
      </div>
      
    </div>
  </div>
</div>