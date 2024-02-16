<div id="admin-bar" class="text-bg-dark">
  <div class="d-none-992 py-3">
    <h2 class="ms-2">Edit page</h2>
    <button id="aside-nav" type="button" class="btn btn-primary px-3">
      <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" Fill="#FFF" /></svg>
    </button>
  </div>
  <div class="accordion accordion-flush" id="aside-bar">

  @php
    $data = [
      (object) [
        'title' => 'Home',
      ],
      (object) [
        'title' => 'Blog',
      ],
      (object) [
        'title' => 'Practice & Team',
        'link' => 'team',
      ],
      (object) [
        'title' => 'Contact',
      ],
    ];
  @endphp

  @foreach ($data as $item)

    @include('components.admin.accordion-item', [
      'title' => $item->title,
      'link' => $item->link ?? lcfirst($item->title),
    ])

  @endforeach

  </div>
</div>

