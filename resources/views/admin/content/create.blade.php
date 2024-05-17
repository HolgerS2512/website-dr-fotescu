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
            class="row"
          >
          @csrf
            <div class="col-12">
              <div class="mb-4">
                <img id="show-img" class="mw-100 mb-3" height="200" width="auto" src="" alt="">
                <select required id="choose" class="form-select" aria-label="format">
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
                  class="change-img form-control @error('list-image') is-invalid @enderror" 
                  name="list-image" 
                  id="list-image"
                >
                @error('list-image')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
            </section>

            <section id="content-img" class="col-12 blueprint" style="display:none;">
              <div class="mb-3">
                <p class="form-label">Content image</p>
                <img id="output-img" class="mw-100 mb-3" height="200" width="auto" src="">
              </div>
              <div class="mb-5">
                <input 
                  type="file" 
                  class="change-img form-control @error('content-image') is-invalid @enderror" 
                  name="content-image" 
                  id="content-image"
                >
                @error('content-image')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
            </section>

            <section id="title-content" class="col-12 blueprint" style="display:none;">
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
            </section>

            <section id="list" class="col-12 blueprint" style="display:none;">
              <div class="mb-3">
                <x-helpers.item-blank />
              </div>
            </section>

            <section id="words" class="col-12 blueprint" style="display:none;">
              <div class="my-3">
                <label class="form-label">Title from existing translation (priority 2)</label>
                <select required id="select-wordsname" class="form-select" name="words_name.de.list">
                  <option selected>Choose a title</option>
                  @foreach ($words as $item)
                    <option 
                      value="{{ $item->name }}"
                    >{{ $item->en }}</option>
                  @endforeach
                </select>
                <input type="hidden" name="words_name.en.list">
                <input type="hidden" name="words_name.ru.list">
              </div>
              <div class="mb-3">
                <label class="form-label">or customize (priority 1)</label>
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

            <section id="subpage" class="col-12 blueprint" style="display:none;">
              <div class="my-3">
                <label class="form-label">Linked main page (must have subpages)</label>
                <select required class="form-select" name="url_link">
                  <option>Choose a relationship</option>
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
                <select required class="form-select" name="url_link" style="max-width: 300px;">
                  <option>Choose a page</option>
                  @foreach ($pages as $item)
                    <option 
                      value="{{ $item->id }}"
                    >{{ $item->en }}</option>
                  @endforeach
                </select>
              </div>
            </section>

            <section id="btn-name" class="col-12 blueprint" style="display:none;">
              <div class="my-3 input-group">
                <label class="input-group-text">Download display name</label>
                <input class="form-control" type="text" name="btn" value="" required>
              </div>
            </section>

            <section id="upload" class="col-12 blueprint" style="display:none;">
              <div class="my-3">
                <label class="form-label ps-1">File upload</label>
                <input 
                type="file" 
                class="form-control @error('file') is-invalid @enderror" 
                name="file" 
                required
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
                required 
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

    const init = () => {
      activateBlock(chooseEl);
      chooseEl.addEventListener('change', (e) => activateBlock(e.currentTarget));
      inputImgItem.forEach((inE) => inE.addEventListener('change', showInputImg));
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
      blueprintItem.forEach((sec) => sec.style.display = 'none');
    }

    const setImage = (elVal) => {
      const name = elVal.substring(0, elVal.indexOf('#'));
      if (showImg.src && name) {
        showImg.src = `${URL}/${name}.jpg`;
      }
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

    init();
  })()
</script>
@endsection