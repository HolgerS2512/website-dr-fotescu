@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Edit {{ $page->en }} Content</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container py-5'>
  <h1 class="special-admin-header">Edit {{ $page->en }} Content</h1>
  <div style="margin: 130px 0;" class="row">

    <div class="col-12">
      <a 
        href="{{ url("administration/content/$page->link/create") }}" 
        class="btn btn-success text-white m-3" style="padding: 1rem 2rem"
        >
        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
          <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" fill="#FFF" />
        </svg> New block
      </a>
    </div>

    @foreach ($contents as $content)
      <x-helpers.idx-content :content="$content" :count="$contents->count()" :page="$page" />
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