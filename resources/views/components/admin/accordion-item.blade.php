<div id="aside-bar-main" class="accordion-item">
  <h2 class="accordion-header">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $link }}" aria-expanded="false" aria-controls="flush-collapse{{ $link }}">
      {{ $title }}
    </button>
  </h2>
  <div id="flush-collapse{{ $link }}" class="accordion-collapse collapse" data-bs-parent="#aside-bar">
    @if (isset($item->dropdown) && $item->dropdown)
      @foreach ($item->dropdown as $dropdown)

      @include('components.admin.accordion-item-special', [
        'title' => $dropdown->title,
        'link' => $dropdown->link ?? lcfirst($dropdown->title),
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