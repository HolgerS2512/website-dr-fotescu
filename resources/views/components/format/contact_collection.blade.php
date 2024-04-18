{{-- Address section --}}

<div class="wrapper">
  <div class="{{ $rang === 1 ? 'pt-5' : '' }} pb-3" style="margin-bottom: 160px">
  {{-- <div class="{{ $rang === 1 ? 'my-5 pt-5' : 'mb-3' }} pb-3"> --}}
    <div class="row row-gap-5">
      

      {{-- <div class="col-12 col-sm-11 col-lg-10 offset-sm-1 offset-lg-2 address-col"> --}}
      <div class="col-sm-11 offset-sm-1 offset-lg-2 address-col">
        <div class="mb-4 pb-1 h2" {!! $aos::left() !!}>
          <b>{{ __('messages.words.make_appointment') }}</b>
        </div>
      {{-- </div> --}}
      </div>

      <div class="col col-sm-10 offset-sm-1 offset-lg-2 col-xl-4 address-col">
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
          <div class="mb-4 mt-5 pb-1 h2" {!! $aos::left() !!}>
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

      <div class="col-sm-10 offset-sm-1 offset-lg-2 col-xl-6 offset-xl-0 my-3 d-xl-flex justify-content-center">
        <form 
        method="POST" 
        action="/kontakt"
        class="row g-3 contact-form"
        >
        @csrf
        <div>
            <label for="name" class="form-label">Name*</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>           
        <div>
            <label for="email" class="form-label">Email*</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>           
        <div>
            <label for="reference" class="form-label">Betreff*</label>
            <input type="text" name="reference" class="form-control @error('reference') is-invalid @enderror" id="reference" value="{{ old('reference') }}" required>
            @error('reference')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <label for="msg" class="form-label">Nachricht*</label>
            <textarea rows="6" class="form-control @error('msg') is-invalid @enderror" name="msg" id="msg" placeholder="Ihre Nachricht an uns" required>{{ old('msg') }}</textarea>
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
                Ich habe die Datenschutz-Richtlinien zur Kenntnis genommen und akzeptiere diese.*
                </label>
                @error('terms')
                    <div class="invalid-feedback terms-fb">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Abschicken</button>
        </div>
        </form>
      </div>


    </div>
  </div>
</div>