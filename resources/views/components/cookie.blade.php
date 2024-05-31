
{{-- <div class="cookie position-fixed top-0 start-0 w-100 h-100"> --}}
<div class="cookie position-fixed top-0 start-0 w-100 h-100 d-none">
  <div class="row w-100 trans-two g-0 pt-3 px-3 pb-4 pb-lg-3 position-absolute bottom-0 start-0">
      <div class="col-lg-9">
          <div class="d-flex align-items-center mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" height="36" viewBox="0 -960 960 960" width="36" fill="#000"><path d="M420-360h120l-23-129q20-10 31.5-29t11.5-42q0-33-23.5-56.5T480-640q-33 0-56.5 23.5T400-560q0 23 11.5 42t31.5 29l-23 129Zm60 280q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Z"/></svg>
              <span class="ps-2 text-black">{{ __('messages.words.policy_settings') }}</span>
          </div>
          <div class="text-break">
              <p>{{ __('messages.words.data_protect_txtstart') }} 
                {{ __('messages.words.data_protect_txtstarttwo') }} 
                {{ __('messages.words.data_protect_txtstartthree') }} 
                <a href="{{ url((strlen($path) > 1 ? "$path/" : $path) . 'datenschutz') }}">{{ __('messages.words.data_protect') }}</a>
                . {{ __('messages.words.data_protect_txtend') }}
              </p>
          </div>
      </div>
      <div class="col-lg-3 d-flex justify-content-center flex-column ps-lg-4">
          <button id="cookie-accept" type="button" class="trans-two btn btn-success w-100 mb-2">{{ __('messages.words.accept') }}</button>
          <button id="cookie-reject" type="button" class="trans-two btn btn-dark w-100">{{ __('messages.words.reject') }}</button>
      </div>
  </div>
</div>

<script type="text/javascript">
(() => {
  'use strict';
  
  const init = () => {
    if (getCookieValue('Cookie')) document.querySelector('.cookie').style.display = 'none';
  }

  const getCookieValue = (a) => {
    const b = document.cookie.match('(^|;)\\s*' + a + '\\s*=\\s*([^;]+)');
    return b ? b.pop() : '';
  }

  init();
})()
</script>