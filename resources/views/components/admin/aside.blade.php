<div id="admin-bar" class="text-bg-dark">
  <div class="d-none-992 py-3">
    <h2 class="ms-2">Edit page</h2>
    <button id="aside-nav" type="button" class="btn btn-primary px-3">
      <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" Fill="#FFF" /></svg>
    </button>
  </div>
  <div class="p-3 border-top">
    <a 
      href="{{ url('administration/dashboard') }}"
      class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover d-flex justify-content-between"
      style="line-height: 2.25"
    >
      Dashboard
      <x-icons.home :clr="'fff'" :size="'30'" />
    </a>
  </div>
  <div class="accordion accordion-flush" id="aside-bar">

    <x-admin.accordion-item-posts :posts="$posts" :name="'Blog posts'" />

    <x-admin.accordion-item-translation :name="'Translation'" :link="'translation'" />

    @foreach ($pages as $page)

      @include('components.admin.accordion-item', [
        'name' => $page->en,
        'link' => $page->link,
        'id' => $page->id,
        'any_pages,' => $page->any_pages,
        'pages' => $pages,
        'subpages' => $subpages,
      ])

    @endforeach

  </div>
</div>

