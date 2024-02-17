<div id="aside-bar-main" class="accordion-item">
  <h2 class="accordion-header">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $link }}" aria-expanded="false" aria-controls="flush-collapse{{ $link }}">
      {{ $name }}
    </button>
  </h2>
  <div id="flush-collapse{{ $link }}" class="accordion-collapse collapse" data-bs-parent="#aside-bar">
    @if (isset($page->dropdown) && $page->dropdown)
      @foreach ($page->dropdown as $dropdown)

      @include('components.admin.accordion-item-special', [
        'name' => $dropdown->name,
        'link' => $dropdown->link ?? lcfirst($dropdown->name),
      ])

      @endforeach
    @else
    <div class="accordion-body">
      <a href="" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links"> 
      {{-- <a href="{{ route($link . '.header') }}" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links">  --}}
        <div>Section 1 : Header</div>
        <x-icons.image :size="24" :clr="'FFF'" />
      </a>
    </div>
    <div class="accordion-body">
      <a href="" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links">
      {{-- <a href="{{ route($link . '.content') }}" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links"> --}}
        <div>Section 2 : Content</div>
        <x-icons.segment :size="24" :clr="'FFF'" />
      </a>
    </div>
    @endif

  </div>
</div>