{{-- Contact collection section (address, office hours, contact form) --}}

<div class="wrapper">
  <div class="{{ $rang === 1 ? 'pt-5 mt-5' : '' }} pb-3" style="margin-bottom: 120px">
    <div class="row row-gap-3">


      <div class="col-sm-11 col-xxl-10 offset-sm-1 offset-xxl-2">
        <div class="mb-3 h2" {!! $aos::left() !!}>
          <b>{{ __('messages.words.make_appointment') }}</b>
        </div>
      </div>

      <div class="col-12 col-lg-4 offset-sm-1 offset-xxl-2 address-col">
        <div {!! $aos::left(200) !!}>
          <p>{{ __('messages.words.main_title') }}</p>
          <p>{{ $infos->location }}</p>
          <p>{{ $infos->address }}</p>
          <p>{{ $infos->zip . ' ' . $infos->city }}</p>
          <br>
          <p>
            {{ __('messages.words.tel_long') }}:
            <a 
              href="tel:{{ str_replace(' ', '', $infos->phone) }}"
              title="{{ str_replace(' ', '', $infos->phone) }}"
            >
            {{ $infos->phone }}
            </a>
          </p>
          <p>
            {{ __('messages.words.mail') }}:
            <a 
              href="mailto:{{ $infos->mail }}"
              title="{{ $infos->mail }}"
            >
            {{ $infos->mail }}
            </a>
          </p>
        </div>

        <div>
          <div class="mb-4 mt-5 pb-1 h4" {!! $aos::left() !!}>
            <b>{{ __('messages.words.word_office_hours') }}</b>
          </div>

          @for($i=0; $i < $opening->count(); $i++)
            <div {!! $aos::left(200 * $i) !!}>
              <b>{{ __("messages.words.{$opening[$i]->day}") }}</b>
              <p class="mb-3">

                @if ($opening[$i]->open && $opening[$i]->close)
                  {{ $opening[$i]->open }} - {{ $opening[$i]->close }}
                @endif

                @if ($opening[$i]->open_2 && $opening[$i]->close_2)
                  <span class="mx-1">{{ explode(' ', __('messages.words.opening_hours_additional'))[0] }}</span>
                  {{ $opening[$i]->open_2 }} - {{ $opening[$i]->close_2 }}
                @endif

              </p>
            </div>
          @endfor

          <div {!! $aos::left($opening->count() * 200) !!}>
            <p class="mb-3">{{ __('messages.words.opening_hours_additional') }}</p>
          </div>
        </div>
      </div>

      @if ($form)
        <div class="col-sm-11 offset-sm-1 offset-lg-0 col-lg-7 col-xxl-6 my-3">
          <div class="contact-form" {!! $aos::right() !!}>
            <form 
            method="POST" 
            action="{{ route('contact') }}"
            class="row g-3"
            >
            @csrf
            <div class="col-sm-6">
              <select class="form-select" name="gender" required>
                <option value="w" selected>{{ __('messages.words.gender_w') }}</option>
                <option value="m">{{ __('messages.words.gender_m') }}</option>
                <option value="d">{{ __('messages.words.gender_d') }}</option>
              </select> 
              @error('gender')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-sm-6">
                <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" placeholder="{{ __('messages.words.first_name') }}*" required>
                @error('firstname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>   
            <div class="col-sm-6">
                <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" placeholder="{{ __('messages.words.last_name') }}*" required>
                @error('lastname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-sm-6">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{ __('messages.words.mail') }}*" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-sm-6">
                <input type="tel" name="phone" pattern="[0-9]*" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ __('messages.words.tel_long') }}*" value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-sm-6">
                <input type="text" name="reference" class="form-control @error('reference') is-invalid @enderror" placeholder="{{ __('messages.words.regarding') }}*" value="{{ old('reference') }}" required>
                @error('reference')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <textarea rows="4" class="form-control @error('msg') is-invalid @enderror" name="msg" placeholder="{{ __('messages.words.your_msg') }}*" required>{{ old('msg') }}</textarea>
                @error('msg')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <div class="form-check">
                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms">
                    <label class="form-check-label" for="terms">
                      {{ __('messages.words.terms_start') }} <a href="{{ url((app()->getLocale() === 'de' ? '' : '/'. app()->getLocale()) . '/datenschutz') }}">{{ __('messages.words.terms_link') }}</a> {{ __('messages.words.terms_end') }}*
                    </label>
                    @error('terms')
                        <div class="invalid-feedback terms-fb">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">{{ __('messages.words.send_btn') }}</button>
            </div>
            </form>
          </div>
        </div>
      @endif


    </div>
  </div>
</div>