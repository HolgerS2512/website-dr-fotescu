{{-- card section --}}

<div class="wrapper">
  <div class="mb-3 py-5">
    <div class="row justify-content-center">
      @for ($i = 0; $i < $content->count(); $i++)
        
        <div class="info-card">
          <div>

            <div class="d-flex mb-4">
              @isset ($content[$i]->image()->src)
              @php
                $alt = $content[$i]->image()->title . '-' . __("messages.words.nav_title") . '-' . $infos->city . '-' . $content[$i]->image()->ext;
                $alt = preg_replace('/[. ( -)]+/', '-', mb_strtolower($alt));
              @endphp
                <img src="{{ $content[$i]->image()->src }}" width="48" height="auto" alt="{{ $alt }}">
              @endif
              <span class="ms-2">
                {{ $content[$i]->title }}
              </span>
            </div>

            <div>
              @if ($content[$i]->content)
                <p style="line-height: 1.725;">{{ $content[$i]->content }}</p>
              @else

                @php
                  foreach ($list as $attr) {
                    if ($attr->ranking === $content[$i]->ranking) {
                      $listEl = $attr;
                    }
                  }
                @endphp

                @switch($listEl->title)

                  @case('list')
                    <ul class="card-list p-0">
                      @for ($idx = 1; $idx <= 20; $idx++)
                        @if($listEl->{'item_' . $idx})
                          <li>
                            @isset($listEl->image()->src)
                              @php
                                $alt = $content[$i]->image()->title . '-' . __("messages.words.nav_title") . '-' . $infos->city . '-' . $content[$i]->image()->ext;
                                $alt = preg_replace('/[. ( -)]+/', '-', mb_strtolower($alt));
                              @endphp
                              <img width="18" height="18" src="{{ url($listEl->image()->src) }}" alt="{{ $alt }}">
                            @endisset
                            {{ $listEl->{'item_' . $idx} }}
                          </li>
                        @endif
                      @endfor
                    </ul>
                    @break

                  @case('opening')
                    @foreach ($opening as $day)
                      <div class="opening-card">
                        {{ __("messages.words.$day->day") }}&nbsp;&nbsp;
                        <span>
                          {!! str_replace('.00', '', $day->open) . '&ndash;' . str_replace('.00', '', $day->close) !!} {{ __('messages.words.time') }}
                          @if (isset($day->open_2) && isset($day->close_2))
                            &nbsp;&nbsp;
                            {!! str_replace('.00', '', $day->open_2) . '&ndash;' . str_replace('.00', '', $day->close_2) !!} {{ __('messages.words.time') }}
                          @endif
                        </span>
                      </div>
                    @endforeach
                    @break

                  @case('infos')
                    <span class="d-block mb-2">
                      {{ __('messages.words.tel') }}<br>
                      <a class="mb-3 pt-2" href="tel:{!! str_replace(' ', '', $infos->phone) !!}">{!! $infos->phone !!}</a>
                    </span>

                    <span class="d-block mb-2">
                      {{ __('messages.words.mail') }}<br/>
                      <a class="mb-3 pt-2" href="mailto:{!! $infos->mail !!}?subject=allgemeine Anfrage&body=Liebes%20Praxisteam,%0A[SCHILDERUNG ANLIEGEN]%0A%0AMit%20freundlichen%20Grüßen">{!! $infos->mail !!}</a>
                    </span>

                    <span class="d-block mb-2">
                      {{ __('messages.words.approach') }}<br/>
                      {!! $infos->location !!} <br>
                      <a 
                        class="mb-3 pt-2" 
                        href="{!! $infos->maps !!}"
                        target="_blank" rel="noopener noreferrer"
                      >
                        {!! $infos->address !!}, {!! $infos->zip !!} {!! $infos->city !!}
                      </a>
                    </span>
                    @break 
                    
                @endswitch
                
              @endif
            </div>

          </div>
        </div>

      @endfor
    </div>
  </div>
</div>