@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Edit {{ $page->name }} Header</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container py-5'>
  <h1 class="special-admin-header">Edit {{ $page->name }} Content</h1>
  <div style="margin: 130px 0;" class="row">

    @foreach ($contents as $content)
      @switch($content->format)
        @case('text')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('buttons')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('strip')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('cards')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('has_subpages')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('headline_list')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('headline_text')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('image_overlap')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('x_link')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('details')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('download')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('contact_collection')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('office_hours')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('cross_list')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('map')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('headline_image')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('image_solo')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('subheading')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @case('blog_posts')
            <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
          @break
        @default   
      @endswitch
    @endforeach

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
    const RMCONTENT = 'Are you sure you want to delete this block?';
    const inputRankEl = document.querySelectorAll('[name="new_ranking"]');
    const rmBtnItem = document.querySelectorAll('.remove-content');

    const init = () => {
      inputRankEl.forEach((inEl) => inEl.addEventListener('change', submitRanking));
      rmBtnItem.forEach((btn) => btn.addEventListener('click', submitRemove));
    }

    const submitRanking = (e) => {
      e.currentTarget.parentNode.parentNode.submit();
    }

    const submitRemove = (e) => {
      if (window.confirm(RMCONTENT)) {
        e.currentTarget.parentNode.submit();
      }
      e.preventDefault();
    }

    init();
  })()
</script>
@endsection