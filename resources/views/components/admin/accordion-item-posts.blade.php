<div id="aside-bar-main" class="accordion-item">
  <h2 class="accordion-header">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#blog-posts" aria-expanded="false" aria-controls="blog-posts">
      {{ $name }}
    </button>
  </h2>
  <div id="blog-posts" class="accordion-collapse collapse" data-bs-parent="#aside-bar">

    @foreach ($posts as $post)
      <div class="accordion-body">
        <a href="{{ url('administration/post/edit/' . $post->id) }}" class="link-light link-underline-opacity-25 link-underline-opacity-100-hover acc-links">
          <div class="text-truncate" style="max-width: 220px">{{ $post->de }}</div>
          <x-icons.segment :size="24" :clr="'FFF'" />
        </a>
      </div>
    @endforeach
    
  </div>
</div>