<div class="accordion-item">
  <h2 class="accordion-header">
    <button class="accordion-button collapsed acc-btn-two" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $link }}" aria-expanded="false" aria-controls="{{ $link }}">
      <small>Sub {{ $parent_name }}</small> : {{ $name }}
    </button>
  </h2>
  <div id="{{ $link }}" class="accordion-collapse collapse" data-bs-parent="#aside-bar-main">
    <div class="accordion-body">
      <a href="{{ url('/'.'header/' . $link) }}" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links"> 
        <div>Section 1 : Header</div>
        <x-icons.image :size="24" :clr="'FFF'" />
      </a>
    </div>
    <div class="accordion-body">
      <a href="{{ url('/'.'content/' . $link) }}" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links">
        <div>Section 2 : Content</div>
        <x-icons.segment :size="24" :clr="'FFF'" />
      </a>
    </div>
  </div>
</div>