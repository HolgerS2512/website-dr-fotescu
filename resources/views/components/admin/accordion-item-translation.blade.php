<div id="aside-bar-main" class="accordion-item">
  <h2 class="accordion-header">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $link }}" aria-expanded="false" aria-controls="{{ $link }}">
      {{ $name }}
    </button>
  </h2>
  <div id="{{ $link }}" class="accordion-collapse collapse" data-bs-parent="#aside-bar">

    <div class="accordion-body">
      <a href="{{ url('administration/translation/title') }}" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links">
        <div>Section 1 : Title</div>
        <x-icons.segment :size="24" :clr="'FFF'" />
      </a>
    </div>

    <div class="accordion-body">
      <a href="{{ url('administration/translation/words') }}" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links">
        <div>Section 2 : Words</div>
        <x-icons.segment :size="24" :clr="'FFF'" />
      </a>
    </div>

    <div class="accordion-body">
      <a href="{{ url('administration/translation/content') }}" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links">
        <div>Section 3 : Content</div>
        <x-icons.segment :size="24" :clr="'FFF'" />
      </a>
    </div>

    <div class="accordion-body">
      <a href="{{ url('administration/translation/list') }}" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links">
        <div>Section 4 : Content list</div>
        <x-icons.segment :size="24" :clr="'FFF'" />
      </a>
    </div>
    
  </div>
</div>