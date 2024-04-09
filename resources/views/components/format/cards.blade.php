{{-- card section --}}

<div class="wrapper wrapper-480-box">
  <div class="mb-3 py-5">
    <div class="row justify-content-center">
      @for ($i = 0; $i < $content->count(); $i++)
        @foreach ($images as $image)
          @php
            if ($image->id === $content[$i]->image_id) $src = $image->image
          @endphp
        @endforeach
        
        <div class="info-card">
          <div>

            <div class="d-flex mb-4">
              @isset ($src)
                <img src="{{ $src }}" width="48" height="auto" alt="">
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
                  foreach ($list as $model) {
                    if ($model->ranking === $content[$i]->ranking) {
                      $listEl = $model;
                    }
                  }
                @endphp

                @switch($listEl->title)

                  @case('list')
                    <ul class="card-list p-0">
                      @for ($idx = 1; $idx <= 20; $idx++)
                        @if($listEl->{'item_' . $idx})
                          <li>
                            <img width="18" height="18" src="{{ url($listEl->list_image) }}" alt="">
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