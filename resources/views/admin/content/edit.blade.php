@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Edit {{ $page->en }} Content Block</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container py-5'>
  <h1 class="special-admin-header">Edit Content Block</h1>
  <div style="margin: 130px 0;">
    <div class="p-3 mb-3">
      <div class="card w-100">
        <div class="card-body position-relative">
          <h5 class="mb-4">Edit block: {{ $content->format }}</h5>
          
          @if ($content->format !== 'contact_collection')
          <form 
          action="{{ url("administration/content/$page->link/update/$content->id") }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="row update-form"
          data-format="{{ $content->format }}"
          >
          @csrf
          @method('PUT')
          @endif

          @if ($content->image_id)
            <div class="mb-3">
              <label class="form-label d-block">Content main image</label>
              @if( $content->image() )
                <img style="max-height:200px;" class="img-fluid" src="{{ url($content->image()->src) }}">
                <input type="hidden" name="old_image" value="{{ $content->image_id }}">
              @else
                <img id="output-img" class="img-fluid" src="" style="max-height:200px;">
              @endif
            </div>
            <div class="mb-3">
              <input 
                type="file" 
                class="change-img form-control @error('image') is-invalid @enderror" 
                name="image" 
                id="image"
              >
              @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
          @endif

{{-------------------------------------------------------- FORMAT START --------------------------------------------------------}}
          @switch($content->format)
            @case('headline_text')
                @for ($i = 0; $i < $deContent->count(); $i++) @php $ranking = $i + 1; @endphp
                  <div class="mb-3">
                    @if ($ranking <= 1)
                      <x-helpers.title-group 
                        :ranking="$ranking" 
                        :deContent="$deContent[$i]" 
                        :enContent="$enContent[$i] ?? null" 
                        :ruContent="$ruContent[$i] ?? null" 
                        :additive="'cont.'"
                      />
                    @endif
                    <x-helpers.content-group 
                      :ranking="$ranking" 
                      :deContent="$deContent[$i]" 
                      :enContent="$enContent[$i] ?? null" 
                      :ruContent="$ruContent[$i] ?? null" 
                      :additive="'cont.'"
                    />
                  </div>
                @endfor
              @break
            @case('download')
                <div id="iframe" class="preview-file">
                  <iframe src="{{ url($content->url_link) }}"></iframe>
                  <button class="cancel" type="button"><x-icons.cancel_circel :size="50" :clr="'F00'" /></button>
                </div>
                <div class="mb-5">
                  <label class="form-label">Download display name</label>
                  <input class="form-control" type="text" name="btn" value="{{ $content->btn }}">
                </div>

                <div class="mb-1 d-flex">
                  <label class="form-label mt-2">Download file</label><br>
                  <button type="button" class="show-iframe ms-3 btn btn-dark">Preview current</button>
                </div>
                <div class="mb-3">
                  <input 
                  type="file" 
                  class="form-control @error('url_link') is-invalid @enderror" 
                  name="url_link" 
                  id="url_link"
                >
                  @error('url_link')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
                </div>
              @break
            @case('x_link')
              <div class="mb-3">
                  <x-helpers.title-group 
                    :ranking="1" 
                    :deContent="$deContent->first()" 
                    :enContent="$enContent->first() ?? null" 
                    :ruContent="$ruContent->first() ?? null"
                    :additive="'cont.'" 
                  />
                  <x-helpers.content-group 
                    :ranking="1" 
                    :deContent="$deContent->first()" 
                    :enContent="$enContent->first() ?? null" 
                    :ruContent="$ruContent->first() ?? null"
                    :additive="'cont.'" 
                  />
                  <div class="my-3 input-group">
                    <label class="input-group-text bg-warning-subtle">Button link to the page:</label>
                    <select class="form-select" name="url_link" style="max-width: 300px;">
                      @foreach ($pages as $item)
                        <option 
                          value="{{ $item->id }}"{{ $item->id == $content->url_link ? ' selected' : '' }}
                        >{{ $item->en }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              @break
            @case('text')
              <div class="mb-3">
                  <x-helpers.title-group 
                    :ranking="1" 
                    :deContent="$deContent->first()" 
                    :enContent="$enContent->first() ?? null" 
                    :ruContent="$ruContent->first() ?? null" 
                    :additive="'cont.'"
                  />
                  <x-helpers.content-group 
                    :ranking="1" 
                    :deContent="$deContent->first()" 
                    :enContent="$enContent->first() ?? null" 
                    :ruContent="$ruContent->first() ?? null" 
                    :additive="'cont.'"
                  />
                </div>
              @break
            @case('subheading')
              <div class="mb-3">
                  <x-helpers.title-group 
                    :ranking="1" 
                    :deContent="$deList->first()" 
                    :enContent="$enList->first() ?? null" 
                    :ruContent="$ruList->first() ?? null" 
                    :additive="'list.'"
                  />
                  @for ($i = 1; $i <= 2; $i++)
                    <x-helpers.item-group 
                      :i="$i" 
                      :deItem="$deList->first()->{'item_' . $i}" 
                      :enItem="$enList->first()->{'item_' . $i} ?? null" 
                      :ruItem="$ruList->first()->{'item_' . $i} ?? null" 
                      :deId="$deList[$i]->id ?? null" 
                      :enId="$enList[$i]->id ?? null" 
                      :ruId="$ruList[$i]->id ?? null" 
                    />
                  @endfor
                </div>
              @break
            @case('buttons')
              <div class="mb-3">
                <div class="my-3">
                  <label class="form-label">Title from existing translation (priority 2):</label>
                  <select id="select-wordsname" class="form-select" name="words_name.de.list.{{ $deList->first()->id }}">
                    @foreach ($words as $item)
                      <option 
                        value="{{ $item->name }}"{{ $item->name == $deList->first()->words_name ? ' selected' : '' }}
                      >{{ $item->en }}</option>
                    @endforeach
                  </select>
                  <input type="hidden" name="words_name.en.list.{{ $enList->first()->id }}">
                  <input type="hidden" name="words_name.ru.list.{{ $ruList->first()->id }}">
                </div>
                  <x-helpers.title-group
                    :label="'Custom title (priority 1)'" 
                    :ranking="1" 
                    :deContent="$deList->first()" 
                    :enContent="$enList->first() ?? null" 
                    :ruContent="$ruList->first() ?? null" 
                    :additive="'list.'"
                  />
                  <div class="my-3">
                    <label class="form-label">Linked main page (must have subpages):</label>
                    <select class="form-select" name="url_link">
                      @foreach ($pages->where('any_pages', true) as $p)
                        <option 
                          value="{{ $p->id }}"{{ $p->id == $content->url_link ? ' selected' : '' }}
                        >{{ $p->en }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              @break
            @case('cards')
                <div class="mb-3">
                  <p class="text-danger">Function not available at the moment.</p>
                </div>
              @break
            @case('details')
                <div class="mb-3">
                  <x-helpers.title-group 
                    :ranking="1" 
                    :deContent="$deContent->first()" 
                    :enContent="$enContent->first() ?? null" 
                    :ruContent="$ruContent->first() ?? null" 
                    :additive="'cont.'"
                  />
                </div>
              @break
            @case('map')
                <div class="mb-3">
                  <x-helpers.title-group 
                    :ranking="1" 
                    :deContent="$deContent->first()" 
                    :enContent="$enContent->first() ?? null" 
                    :ruContent="$ruContent->first() ?? null" 
                    :additive="'cont.'"
                  />
                  <label class="form-label">Map link (priority 1 otherwise company information)</label>
                  <input class="form-control" type="text" name="url_link" value="{{ $content->url_link }}">
                </div>
              @break
            @case('cross_list')
                <div class="mb-3">
                  @for ($i = 0; $i < $deContent->count(); $i++) @php $ranking = $i + 1; @endphp
                    <div class="mb-3">
                      @if ($ranking <= 1)
                        <x-helpers.title-group 
                          :ranking="$ranking" 
                          :deContent="$deContent[$i]" 
                          :enContent="$enContent[$i] ?? null" 
                          :ruContent="$ruContent[$i] ?? null" 
                          :additive="'cont.'"
                        />
                      @endif
                      <x-helpers.content-group 
                        :ranking="$ranking" 
                        :deContent="$deContent[$i]" 
                        :enContent="$enContent[$i] ?? null" 
                        :ruContent="$ruContent[$i] ?? null" 
                        :additive="'cont.'"
                      />
                    </div>
                  @endfor
                  @for ($idx = 1; $idx <= 20; $idx++)
                      <x-helpers.item-group 
                        :i="$idx" 
                        :deItem="$deList->first()->{'item_' . $idx} ?? null" 
                        :enItem="$enList->first()->{'item_' . $idx} ?? null" 
                        :ruItem="$ruList->first()->{'item_' . $idx} ?? null" 
                        :deId="$deList->first()->id ?? null" 
                        :enId="$enList->first()->id ?? null" 
                        :ruId="$ruList->first()->id ?? null" 
                      />
                  @endfor
                </div>
              @break
            @case('contact_collection')
                <div class="mb-3">
                  <p class="my-3 text-danger">This block is composed of company informations.</p>
                  @php
                    $formOn = App\Models\Publish::where('page_id', $page->id)->where('name', "$content->format.form")->first();
                  @endphp
                  <form id="pForm" action="{{ url("administration/content/$page->link/update/visible/$formOn->id") }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="public" value="{{ ! $formOn->public ? '1' : '0' }}">
        
                    <div class="form-check form-switch" style="max-width: max-content">
                      <input class="form-check-input" type="checkbox" role="switch" id="public" {{ $formOn->public ? 'checked' : '' }}>
                      <label class="form-check-label" for="public">
                        <span 
                          class="post-public {{ $formOn->public ? 'post-true' : 'post-false' }} position-relative top-0 left-0">
                            Contact form {{ $formOn->public ? '' : 'not ' }}online
                        </span>
                      </label>
                    </div>
                  </form>
                </div>
              @break
            @case('headline_list')
                <div class="mb-3">
                  <x-helpers.title-group 
                    :ranking="1" 
                    :deContent="$deList->first()" 
                    :enContent="$enList->first() ?? null" 
                    :ruContent="$ruList->first() ?? null" 
                    :additive="'list.'"
                  />
                  @for ($idx = 1; $idx <= 20; $idx++)
                    <x-helpers.item-group 
                      :i="$idx" 
                      :deItem="$deList->first()->{'item_' . $idx} ?? null" 
                      :enItem="$enList->first()->{'item_' . $idx} ?? null" 
                      :ruItem="$ruList->first()->{'item_' . $idx} ?? null" 
                      :deId="$deList->first()->id ?? null" 
                      :enId="$enList->first()->id ?? null" 
                      :ruId="$ruList->first()->id ?? null" 
                    />
                  @endfor
                </div>
              @break
            @case('image_overlap')
              <div class="mb-3">
                <label class="form-label d-block">Content image 2</label>
                <img style="max-height:200px;" class="img-fluid" src="{{ url($deContent->first()->image()->src) }}">
                <input type="hidden" name="content.old_image" value="{{ $deContent->first()->image()->id }}">
              </div>
              <div class="mb-5">
                <input 
                  type="file" 
                  class="change-img form-control @error('image') is-invalid @enderror" 
                  name="content.image" 
                  id="image"
                >
                @error('image')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
                <div class="mb-3">
                  <x-helpers.title-group 
                    :ranking="1" 
                    :deContent="$deContent->first()" 
                    :enContent="$enContent->first() ?? null" 
                    :ruContent="$ruContent->first() ?? null" 
                    :additive="'cont.'"
                  />
                  <x-helpers.content-group 
                    :ranking="1" 
                    :deContent="$deContent->first()" 
                    :enContent="$enContent->first() ?? null" 
                    :ruContent="$ruContent->first() ?? null" 
                    :additive="'cont.'"
                  />
                  <div class="my-3 input-group">
                    <label class="input-group-text bg-warning-subtle">Button link to the page:</label>
                    <select class="form-select" name="url_link" style="max-width: 300px;">
                      @foreach ($pages as $item)
                        <option 
                          value="{{ $item->id }}"{{ $item->id == $content->url_link ? ' selected' : '' }}
                        >{{ $item->en }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                </div>
              @break
            @case('strip')
              <div class="mb-3">
                <div class="mb-3" style="background: black">
                  <label class="form-label d-block text-white ps-1">Strip image (png)</label>
                  <img style="max-height:200px;" class="img-fluid" src="{{ url($deList->first()->image()->src) }}" >
                  <input type="hidden" name="list.old_image" value="{{ $deList->first()->image()->id }}">
                </div>
                <div class="mb-5">
                  <input 
                    type="file" 
                    class="change-img form-control @error('list.image') is-invalid @enderror" 
                    name="list.image" 
                    id="image"
                  >
                  @error('list.image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
                </div>
                <h4 class="my-3">Enumeration:</h4>
                @for ($i = 0; $i < $deList->count(); $i++) @php $ranking = $i + 1; @endphp
                  @for ($idx = 1; $idx <= 5; $idx++)
                    <x-helpers.item-group 
                      :i="$idx" 
                      :deItem="$deList[$i]->{'item_' . $idx} ?? null" 
                      :enItem="$enList[$i]->{'item_' . $idx} ?? null" 
                      :ruItem="$ruList[$i]->{'item_' . $idx} ?? null" 
                      :deId="$deList[$i]->id ?? null" 
                      :enId="$enList[$i]->id ?? null" 
                      :ruId="$ruList[$i]->id ?? null" 
                    />
                  @endfor
                @endfor
              </div>
              @break
            @case('imprint')
              <div class="mb-3">
                @for ($i=0; $i<$deContent->count(); $i++) @php $ranking = $i + 1; @endphp
                <div class="mb-3 pt-4 position-relative">
                <a href="{{ url("administration/content/$page->link/remove/add/Content/de:{$deContent[$i]->id}/en:{$enContent[$i]->id}/ru:{$ruContent[$i]->id}") }}" class="remove-content rm-add" onClick></a>
                  <x-helpers.title-group 
                    :ranking="$ranking" 
                    :deContent="$deContent[$i]" 
                    :enContent="$enContent[$i] ?? null" 
                    :ruContent="$ruContent[$i] ?? null"
                    :additive="'cont.'" 
                  />
                  <br>
                  <x-helpers.content-group 
                    :ranking="$ranking" 
                    :deContent="$deContent[$i]" 
                    :enContent="$enContent[$i] ?? null" 
                    :ruContent="$ruContent[$i] ?? null"
                    :additive="'cont.'"  
                  />
                </div>
              @endfor
              </div>
              @break
            @case('headline_image')
                <div class="mb-3">
                  @for ($i=0; $i<$deContent->count(); $i++) @php $ranking = $i + 1; @endphp
                    <div class="mb-3 pt-4 position-relative">
                    <a href="{{ url("administration/content/$page->link/remove/add/Content/de:{$deContent[$i]->id}/en:{$enContent[$i]->id}/ru:{$ruContent[$i]->id}") }}" class="remove-content rm-add" onClick></a>
                      <x-helpers.title-group 
                        :ranking="$ranking" 
                        :deContent="$deContent[$i]" 
                        :enContent="$enContent[$i] ?? null" 
                        :ruContent="$ruContent[$i] ?? null"
                        :additive="'cont.'" 
                      />
                      <br>
                      <x-helpers.content-group 
                        :ranking="$ranking" 
                        :deContent="$deContent[$i]" 
                        :enContent="$enContent[$i] ?? null" 
                        :ruContent="$ruContent[$i] ?? null"
                        :additive="'cont.'"  
                      />
                    </div>
                  @endfor
                <div class="mb-3">
                  @if ($deList->count() >= 1)
                  <h4 class="mt-5">Enumeration:</h4>
                  @endif
                  @for ($i = 0; $i < $deList->count(); $i++) @php $ranking = $i + 1; @endphp
                    <div class="mb-3 pt-4 position-relative">
                      <a href="{{ url("administration/content/$page->link/remove/add/List/de:{$deList[$i]->id}/en:{$enList[$i]->id}/ru:{$ruList[$i]->id}") }}" class="remove-content rm-add" onClick></a>
                        <x-helpers.title-group 
                          :ranking="$ranking" 
                          :label="'List headline title'"
                          :deContent="$deList[$i]" 
                          :enContent="$enList[$i] ?? null" 
                          :ruContent="$ruList[$i] ?? null" 
                          :additive="'list.'"
                          :classes="' h5'"
                        />
                        <br>
                      @for ($idx = 1; $idx <= 20; $idx++)
                        <x-helpers.item-group 
                          :i="$idx" 
                          :deItem="$deList[$i]->{'item_' . $idx} ?? null" 
                          :enItem="$enList[$i]->{'item_' . $idx} ?? null" 
                          :ruItem="$ruList[$i]->{'item_' . $idx} ?? null" 
                          :deId="$deList[$i]->id ?? null" 
                          :enId="$enList[$i]->id ?? null" 
                          :ruId="$ruList[$i]->id ?? null" 
                        />
                      @endfor
                    </div>
                  @endfor

                  <div class="my-4 mb-5">
                    <a 
                      href="{{ url("administration/content/$page->link/add/$content->id/Content") }}" 
                      class="btn btn-success text-white"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                        <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" fill="#FFF" />
                      </svg> add content
                    </a>

                    <a 
                      href="{{ url("administration/content/$page->link/add/$content->id/List") }}" 
                      class="btn btn-success text-white ms-2"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                        <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" fill="#FFF" />
                      </svg> add content list
                    </a>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Page linking button (not duty):</label>
                    <select class="form-select" name="btn">
                      <option value="">Choose a link</option>
                      @foreach ($pages as $p)
                        <option 
                          value="{{ $p->id }}"{{ $p->id == $content->btn ? ' selected' : '' }}
                        >{{ $p->en }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="my-3">
                    <label class="form-label">External linking (not duty):</label>
                    <input class="form-control" type="text" name="url_link" value="{{ $content->url_link }}">
                  </div>
                </div>
                </div>
              @break
            @default
          @endswitch

{{-------------------------------------------------------- FORMAT END --------------------------------------------------------}}
            <div class="d-flex justify-content-between">
              <div class="mb-4 ms-3">
                <a href="{{ url("/administration/content/$page->link") }}" class="mt-3 me-2 btn btn-danger">
                  Back and discard
                </a>
                <button type="reset" class="px-5 mt-3 me-2 btn btn-dark">Reset</button>
                <button type="submit" class="px-5 mt-3 btn btn-primary">Update</button>
              </div>
            </div>

            @if ($content->format !== 'contact_collection')
          </form>
          @endif
  
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  (() => {
    'use strict'
    const importantAccEl = document.querySelector('#collapseImportant');
    const importBtn = document.querySelector('.important-btn');

    const init = () => {
      checkStorage();
      // importBtn.addEventListener('click', toggleStore);
    }

    const checkStorage = () => {
      const impStore = localStorage.getItem("important");

      if (impStore !== null && Boolean(impStore)) {
        importantAccEl.classList.add('close-bar');
      }
    }

    const toggleStore = () => {
      setTimeout(() => {
        if (importantAccEl.classList.contains('show')) {
          localStorage.setItem("important", 1);
        } else {
          localStorage.removeItem("important");
        }
      }, 500);
    }

    init();
  })()
</script>
<script>
  (() => {
    'use strict'
    const iframeEl = document.querySelector('#iframe') || false;
    const showFrameBtn = document.querySelector('.show-iframe') || false;
    const closeFrameBtn = document.querySelector('.cancel') || false;
    const switchFormEl = document.querySelector('#pForm') || false;
    const switcher = document.querySelector('#public') || false;

    const init = () => {
      if (showFrameBtn) {
        showFrameBtn.addEventListener('click', toggleIframe);
        closeFrameBtn.addEventListener('click', toggleIframe);
      }

      if (switcher) {
        switcher.addEventListener('change', () => switchFormEl.submit());
      }
    }

    const toggleIframe = () => {
      const result = ['block', 'none'];
      iframeEl.style.display = result[Number(iframeEl.style.display === 'block')];
    }

    init();
  })()
</script>
<script>
  (() => {
    'use strict'
    const formItem = document.querySelectorAll('.update-form');
    const aRemoveContent = document.querySelectorAll('.rm-add');
    const MSG = 'Are you sure you want to delete this content object and its contents?';

    const init = () => {
      formItem.forEach((formEl) => formEl.addEventListener('submit', checkFormat));
      if (aRemoveContent){
        aRemoveContent.forEach((a) => a.addEventListener('click', removeQuest));
      }
    }

    const checkFormat = (e) => {
      const format = e.currentTarget.dataset.format;

      if (format === 'cards') {
        e.preventDefault();
        alert('Function not available at the moment.');
      }
    }

    const removeQuest = (e) => {
      if (!confirm(MSG)) e.preventDefault();
    }

    init();
  })()
</script>
<script>
  (() => {
    'use strict'
    const inputImgItem = document.querySelectorAll('.change-img');
    const selectEl = document.querySelector('#select-wordsname');

    const init = () => {
      inputImgItem.forEach((inE) => inE.addEventListener('change', showImg));
      if (selectEl) {
        fillHiddenTypes(selectEl);
        selectEl.addEventListener('change', (e) => fillHiddenTypes(e.target));
      }
    }

    const fillHiddenTypes = (el) => {
      const hiddenItem = el.parentElement.querySelectorAll('[type="hidden"]');
      hiddenItem.forEach((el) => el.value = el.value);
    }

    const showImg = (e) => {
      const file = e.target.files[0];
      const reader = new FileReader();
      const prevEl = e.target.parentElement.previousElementSibling.querySelector('img');

      reader.addEventListener('load', () => {
        prevEl.src = reader.result;
      }, false);

      if (file) reader.readAsDataURL(file);
    }

    init();
  })()
</script>
@endsection