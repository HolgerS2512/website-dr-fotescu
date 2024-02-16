<div class="accordion-item">
  <h2 class="accordion-header">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $title }}" aria-expanded="false" aria-controls="flush-collapse{{ $title }}">
      {{ $title }}
    </button>
  </h2>
  <div id="flush-collapse{{ $title }}" class="accordion-collapse collapse" data-bs-parent="#aside-bar">
    <div class="accordion-body">
      <a href="{{ route(lcfirst($title) . '.header') }}" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links">
        <div>Section 1 : Image | Slides</div>
        <x-icons.image :size="24" :clr="'FFF'" />
      </a>
    </div>
    <div class="accordion-body">
      <a href="" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links">
        <div>Section 2 : Current Info</div>
        <x-icons.segment :size="24" :clr="'FFF'" />
      </a>
    </div>
    <div class="accordion-body">
      <a href="" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links">
        Section 3 : Info Cards
        <x-icons.cards :size="24" :clr="'FFF'" />
      </a>
    </div>
    <div class="accordion-body">
      <a href="" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links">
        Section 4 : Buttons
        <x-icons.action-key :size="24" :clr="'FFF'" />
      </a>
    </div>
  </div>
</div>