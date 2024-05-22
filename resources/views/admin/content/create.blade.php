@extends('layouts.admin')

{{--------------------> Title <--------------------}}
@section('title')
<title>Create {{ $page->en }} Content Block</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<div class='container py-5'>
  <h1 class="special-admin-header">Create {{ $page->en }} Content Block</h1>
  <div style="margin: 130px 0;">
    <div class="p-3 mb-3">
      <div class="card w-100">
        <div class="card-body position-relative">
          <h5 class="mb-4">Create new content block</h5>

          <form 
            action="{{ url("administration/content/$page->link/store") }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="row create-form needs-validation" novalidate
          >
          @csrf
            <div class="col-12">
              <div class="mb-4">
                <img id="show-img" class="mw-100 mb-3" height="200" width="auto" src="" alt="">
                <select id="choose" name="format" class="form-select" aria-label="format">
                  <option selected>Choose the format</option>
                  @foreach ($format as $item)
                    <option 
                      value="{{ "$item->name#$item->blueprint" }}"
                    >
                      {{ $item->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="px-2 mw-100">
              <hr>
            </div>

            <section id="img" class="col-12 blueprint" style="display:none;">
              <div class="mb-3">
                <p class="form-label">Image</p>
                <img id="output-img" class="mw-100 mb-3" height="200" width="auto" src="">
              </div>
              <div class="mb-5">
                <input 
                  type="file" 
                  class="change-img form-control @error('image') is-invalid @enderror" 
                  name="image" 
                  id="image"
                >
                @error('image')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
            </section>

            <section id="list-img" class="col-12 blueprint" style="display:none;">
              <div class="mb-3">
                <p class="form-label">List image</p>
                <img id="output-img" class="mw-100 mb-3" height="200" width="auto" src="">
              </div>
              <div class="mb-5">
                <input 
                  type="file" 
                  class="change-img form-control @error('list_image') is-invalid @enderror" 
                  name="list_image" 
                  id="list_image"
                >
                @error('list_image')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
            </section>

            <section id="content-img" class="col-12 blueprint" style="display:none;">
              <div class="mb-3">
                <p class="form-label">Subimage</p>
                <img id="output-img" class="mw-100 mb-3" height="200" width="auto" src="">
              </div>
              <div class="mb-5">
                <input 
                  type="file" 
                  class="change-img form-control @error('content_image') is-invalid @enderror" 
                  name="content_image" 
                  id="content_image"
                >
                @error('content_image')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
            </section>

            <section id="title-content" class="col-12 blueprint" style="display:none;">
              <div class="mb-3">
                <label class="form-label">Title (Custom priority 1)</label>
                <x-helpers.i-group :flag="'de'" 
                  :name="'title.de.cont'" 
                  :value="old('title.de.cont')" 
                />
                
                <x-helpers.i-group :flag="'en'" 
                  :name="'title.en.cont'" 
                  :value="old('title.en.cont')"
                />
                
                <x-helpers.i-group :flag="'ru'" 
                  :name="'title.ru.cont'" 
                  :value="old('title.ru.cont')" 
                />
              </div>
            </section>

            <section id="content" class="col-12 blueprint" style="display:none;">
              <div class="mb-3">
                <label class="form-label mt-3">Content</label>
                <x-helpers.t-group :flag="'de'" 
                  :name="'content.de.cont'" 
                  :value="old('content.de.cont')" 
                />
                
                <x-helpers.t-group :flag="'en'" 
                  :name="'content.en.cont'" 
                  :value="old('content.en.cont')" 
                />
                
                <x-helpers.t-group :flag="'ru'" 
                  :name="'content.ru.cont'" 
                  :value="old('content.ru.cont')" 
                />
              </div>
            </section>

            <section id="title-list" class="col-12 blueprint" style="display:none;">
              <div class="mb-3">
                <label class="form-label">List title (Custom priority 1)</label>
                <x-helpers.i-group :flag="'de'" 
                  :name="'title.de.list'" 
                  :value="old('title.de.list')" 
                />
                <x-helpers.i-group :flag="'en'" 
                  :name="'title.en.list'" 
                  :value="old('title.en.list')"
                />
                <x-helpers.i-group :flag="'ru'" 
                  :name="'title.ru.list'" 
                  :value="old('title.ru.list')" 
                />
              </div>
            </section>

            <section id="list" class="col-12 blueprint" style="display:none;">
              <div class="mb-3">
                <x-helpers.item-blank />
              </div>
            </section>

            <section id="words-list" class="col-12 blueprint" style="display:none;">
              <div class="my-3">
                <label class="form-label">Title from existing translation (priority 2)</label>
                <select id="select-wordsname" class="form-select" name="words_name.list">
                  <option value="" selected>Choose a title</option>
                  @foreach ($words as $item)
                    <option 
                      value="{{ $item->name }}"
                    >{{ $item->en }}</option>
                  @endforeach
                </select>
              </div>
            </section>

            <section id="words" class="col-12 blueprint" style="display:none;">
              <div class="my-3">
                <label class="form-label">Title from existing translation (priority 2)</label>
                <select id="select-wordsname" class="form-select" name="words_name.cont">
                  <option value="" selected>Choose a title</option>
                  @foreach ($words as $item)
                    <option 
                      value="{{ $item->name }}"
                    >{{ $item->en }}</option>
                  @endforeach
                </select>
              </div>
            </section>

            <section id="subpage" class="col-12 blueprint" style="display:none;">
              <div class="my-3">
                <label class="form-label">Linked main page (must have subpages)</label>
                <select class="form-select" name="subpage">
                  <option  selected disabled value="">Choose a relationship</option>
                  @foreach ($pages->where('any_pages', true) as $p)
                    <option 
                      value="{{ $p->id }}"
                    >{{ $p->en }}</option>
                  @endforeach
                </select>
              </div>
            </section>

            <section id="pagelist" class="col-12 blueprint" style="display:none;">
              <div class="my-3 input-group">
                <label class="input-group-text bg-warning-subtle">Button relationship</label>
                <select class="form-select" name="pagelist" style="max-width: 300px;">
                  <option selected disabled value="">Choose a page</option>
                  @foreach ($pages as $item)
                    <option 
                      value="{{ $item->id }}"
                    >{{ $item->en }}</option>
                  @endforeach
                </select>
              </div>
            </section>

            <section id="btnlist" class="col-12 blueprint" style="display:none;">
              <div class="my-3 input-group">
                <label class="input-group-text bg-warning-subtle">Button relationship</label>
                <select class="form-select" name="btnlist" style="max-width: 300px;">
                  <option selected disabled value="">Choose a page</option>
                  @foreach ($pages as $item)
                    <option 
                      value="{{ $item->id }}"
                    >{{ $item->en }}</option>
                  @endforeach
                </select>
              </div>
            </section>

            <section id="btn" class="col-12 blueprint" style="display:none;">
              <div class="my-3 input-group">
                <label class="input-group-text">Download display name</label>
                <input class="form-control" type="text" name="btn" value="">
              </div>
            </section>

            <section id="file" class="col-12 blueprint" style="display:none;">
              <div class="my-3">
                <label class="form-label ps-1">File upload</label>
                <input 
                type="file" 
                class="form-control @error('file') is-invalid @enderror" 
                name="file" 
              >
                @error('file')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
            </section>

            <section id="url-link" class="col-12 blueprint" style="display:none;">
              <div class="my-3">
                <label class="form-label ps-1">Map iframe link (Only fill in if a destination other than your company.)</label>
                <input 
                type="text"
                class="form-control @error('url_link') is-invalid @enderror" 
                name="url_link" 
              >
                @error('url_link')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
            </section>

            {{-- <section id="extra-content" class="col-12 blueprint" style="display:none;">
              <div class="mb-3">
                <label class="form-label">Title</label>
                <x-helpers.i-group :flag="'de'" 
                  :name="'title.de.cont'" 
                  :value="old('title.de.cont')" 
                />
                
                <x-helpers.i-group :flag="'en'" 
                  :name="'title.en.cont'" 
                  :value="old('title.en.cont')"
                />
                
                <x-helpers.i-group :flag="'ru'" 
                  :name="'title.ru.cont'" 
                  :value="old('title.ru.cont')" 
                />
              </div>

              <div class="mb-3">
                <label class="form-label mt-3">Content</label>
                <x-helpers.t-group :flag="'de'" 
                  :name="'content.de.cont'" 
                  :value="old('content.de.cont')" 
                />
                
                <x-helpers.t-group :flag="'en'" 
                  :name="'content.en.cont'" 
                  :value="old('content.en.cont')" 
                />
                
                <x-helpers.t-group :flag="'ru'" 
                  :name="'content.ru.cont'" 
                  :value="old('content.ru.cont')" 
                />
              </div>
            </section>

            <section id="extra-list" class="col-12 blueprint" style="display:none;">
              <div class="mb-3">
                <label class="form-label">List title</label>
                <x-helpers.i-group :flag="'de'" 
                  :name="'title.de.list'" 
                  :value="old('title.de.list')" 
                />
                <x-helpers.i-group :flag="'en'" 
                  :name="'title.en.list'" 
                  :value="old('title.en.list')"
                />
                <x-helpers.i-group :flag="'ru'" 
                  :name="'title.ru.list'" 
                  :value="old('title.ru.list')" 
                />
              </div>

              <div class="mb-3">
                <x-helpers.item-blank />
              </div>
            </section>

            <section id="extra" class="my-4 mb-5 blueprint" style="display: none">
              <button
                type="button" 
                data-add="content"
                class="btn btn-success text-white add-extra"
              >
                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                  <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" fill="#FFF" />
                </svg> add content
              </button>

              <button
                type="button" 
                data-add="list"
                class="btn btn-success text-white ms-2 add-extra"
              >
                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                  <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" fill="#FFF" />
                </svg> add content list
              </button>
            </section> --}}

            <div class="d-flex justify-content-between">
              <div class="mb-4 ms-3">
                <a href="{{ url("/administration/content/$page->link") }}" class="mt-3 me-2 btn btn-danger">
                  Back and discard
                </a>
                <button type="reset" class="px-5 mt-3 me-2 btn btn-dark reset-btn">Reset</button>
                <button type="submit" class="px-5 mt-3 btn btn-primary">Save</button>
              </div>
            </div>

          </form>
  
        </div>
      </div>
    </div>
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
    const URL = "{{ url('assets/img/formats') }}";
    const chooseEl = document.querySelector('#choose');
    const showImg = document.querySelector('#show-img');
    const inputImgItem = document.querySelectorAll('.change-img');
    const blueprintItem = document.querySelectorAll('.blueprint');
    const extraBtn = document.querySelectorAll('.add-extra');
    const formEl = document.querySelector('.create-form');
    const resetBtn = document.querySelector('.reset-btn');

    const init = () => {
      activateBlock(chooseEl);
      chooseEl.addEventListener('change', (e) => activateBlock(e.currentTarget));
      inputImgItem.forEach((inE) => inE.addEventListener('change', showInputImg));
      extraBtn.forEach((btn) => btn.addEventListener('click', showExtraEl));
      resetBtn.addEventListener('click', resetForm);
    }

    const activateBlock = (el) => {
      closeVisibleSec();
      closeHiddenItems();
      setValueArr(el.value);
      setImage(el.value);
    }

    const setValueArr = (elVal) => {
      const fieldVars = elVal.substring(elVal.indexOf('#') + 1).split('.');
      showHiddenSec(fieldVars);
    }

    const showHiddenSec = (fields = []) => {
      blueprintItem.forEach((sec) => {
        if (fields.includes(sec.id)) {
          sec.style.display = 'block';
          if (sec.id === 'list') listSize(sec, fields);
        }
      });
    }

    const listSize = (el = {}, fields = []) => {
      fields.forEach((str) => {
        if (str.includes('item')) {
          setHiddenItems(el.querySelectorAll('.item'), Number((str.split(':'))[1]));
        }
      });
    }

    const setHiddenItems = (items = {}, num = 20) => {
      items.forEach((item) => {
        if (item.dataset.size > num) {
          item.style.display = 'none';
        }
      });
    }

    const closeHiddenItems = () => {
      const all = document.querySelectorAll('.item');
      all.forEach((el) => el.style.display = 'block');
    }

    const closeVisibleSec = () => {
      blueprintItem.forEach((sec) => {
        sec.querySelectorAll('input').forEach((el) => el.value = "");
        sec.querySelectorAll('textarea').forEach((el) => el.value = "");
        sec.querySelectorAll('select').forEach((el) => el.value = "");
        sec.style.display = 'none';
      });
    }

    const setImage = (elVal) => {
      const name = '/' + elVal.substring(0, elVal.indexOf('#')) + '.jpg';
      if (showImg.src && name) {
        showImg.src = `${URL}${name}`;
      }
    }

    const showExtraEl = (e) => {
      const name = e.currentTarget.dataset.add;

      blueprintItem.forEach((sec) => {
        if (sec.id === `extra-${name}`) {
          createNewEl(sec, e.currentTarget);
        }
      });
    }

    const createNewEl = (secEl, btnEl) => {
      const cloneEl = secEl.cloneNode(true);
      cloneEl.style.display = 'block';
      formEl.insertBefore(cloneEl, btnEl.parentElement);
    }

    const showInputImg = (e) => {
      const file = e.target.files[0];
      const reader = new FileReader();
      const prevEl = e.target.parentElement.previousElementSibling.querySelector('img');

      reader.addEventListener('load', () => {
        prevEl.src = reader.result;
      }, false);

      if (file) reader.readAsDataURL(file);
    }

    const resetForm = () => window.location.reload();

    init();
  })()
</script>
@endsection