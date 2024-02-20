@php
    $path = str_replace(config('app.url'), '', url()->current());
    $active_link = $path ?: '/';
    $pages = DB::table('pages')->orderBy('ranking')->get();
    // $subpages = DB::table('subpages')->orderBy('ranking')->get();
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('assets/icons/mstile-70x70.png') }}">
        <meta name="theme-color" content="#ffffff" />
        <meta name="author" content="Holger Schatte">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/icons/favicon-32x32.ico') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/favicon-16x16.ico') }}" sizes="16x16">
        <link rel="apple-touch-icon" type="image/X-UA-Compatible" href="{{ asset('assets/icons/apple-touch-icon-180x180.png') }}">
        <link rel="android-icon" type="image/X-UA-Compatible" href="{{ asset('assets/icons/android-icon-192x192.png') }}">

        @yield('title')
        
        @vite('resources/assets/css/app.css')

        @vite('resources/assets/js/app.js')
        
    </head>

    <body>
        <x-admin.navbar :active="$active_link" />

        <div class="row g-0">
            @auth
                <div class="special-col special-col-header m-0 p-0">
                    @include('components.admin.aside', [
                        'name' => $page->name,
                        'link' => $page->link,
                        'id' => $page->id,
                        // 'subpages' => $subpages,
                      ])
                </div>
            @endauth
            
            <div class="special-col special-col-main m-0 p-0">

                <main class="panel">
                    @if(session('present'))
                        <x-modal :message="session('message')" :status="session('status')" />
                    @endif
                    
                    @yield('content')
                </main>
                
            </div>
        </div>

@auth
    <script>
        (() => {
            'use strict'
            const asideMenuBtn = document.querySelector('#aside-nav');
            const asideNavbarEl = document.querySelector('.special-col-header');
            const asideMainbarEl = document.querySelector('.special-col-main');
            const collapseItem = Array.from(document.querySelectorAll('.accordion-collapse'));
            const collapseBtnItem = Array.from(document.querySelectorAll('.accordion-button'));
        
            const init = () => {
                checkStorage();
                asideMenuBtn.addEventListener('click', toggleMenu);
                collapseBtnItem.forEach(el => el.addEventListener('click', toggleAccordion));
            }
            
            const checkStorage = () => {
                const storeToggleMenu = localStorage.getItem("adminBar");
                const storeCollapse = localStorage.getItem("collapseAccordion");
            
                if (storeToggleMenu !== null && Boolean(storeToggleMenu)) {
                    asideNavbarEl.classList.add('close-bar');
                    asideMainbarEl.classList.add('close-bar');
                }
            
                if (storeCollapse !== null && Boolean(storeCollapse)) {
                    collapseItem.forEach((el, i) => {
                        // comparePages(el);
                        if (storeCollapse === el.id) {
                            el.classList.add('show');
                        }
                    });
                }
            }
        
            const toggleMenu = () => {
                const position = getComputedStyle(asideNavbarEl).getPropertyValue('left');
                const quest = Number(position.substring(0, position.length - 2)) === 0;
                const quest2 = asideNavbarEl.classList.contains('close-bar');
            
                if (quest && !quest2) {
                    asideNavbarEl.classList.add('close-bar');
                    asideMainbarEl.classList.add('close-bar');
                    localStorage.setItem("adminBar", true);
                } else {
                    asideNavbarEl.classList.remove('close-bar');
                    asideMainbarEl.classList.remove('close-bar');
                    localStorage.removeItem("adminBar");
                }
            }

            const toggleAccordion = () => {
                const checkArr = Array(collapseItem.length);

                setTimeout(() => {
                    collapseItem.forEach((el, i) => {
                        checkArr.splice(i, i, false);
                        
                        if (el.classList.contains('show')) {
                            localStorage.setItem("collapseAccordion", el.id);
                            checkArr.splice(i, i, true);
                        }
                    });

                    if (checkArr.every(el => !el)) {
                        localStorage.removeItem("collapseAccordion");
                    }
                }, 500);
            }

            // const comparePages = (el) => {
            //     if (el.id !== 'collapseImportant') {
            //         const http = window.location.pathname.replace('/header/', '');

            //         if (http !== el.id && http.indexOf('/') === -1) {
                                                
            //             collapseItem.forEach((el, i) => {
            //                 if (http === el.id) {
            //                     el.classList.add('show');
            //                     localStorage.setItem("collapseAccordion", el.id);
            //                 } else {
            //                      el.classList.remove('show');
            //                 }
            //             });

            //         }
            //     }
            // }
        
            init();
        })()
        </script>
    @endauth
    </body>
</html>
