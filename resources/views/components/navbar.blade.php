<header class="fixed-top navigation">
    <div class="bg-blue w-100">
        <div class="wrapper">
            <ul class="info-strip">
                <li class="info-title">
                    <a href="{{ $path }}" title="{{ __('messages.title.home') }} {{ __('messages.words.nav_title') }}">{{ __('messages.words.nav_title') }}</a>
                </li>
                <li class="info-contact">
                    <a 
                        class="d-flex"
                        href="tel:{{ str_replace(' ', '', $infos->phone) }}" 
                        title="{{ str_replace(' ', '', $infos->phone) }}"
                    >
                        <img class="phone-img" src="{{ asset('assets/svg/phone.svg') }}" alt="{{ 'mobile-' . __("messages.words.nav_title") . '-' . $infos->city . '-svg' }}" width="32" height="36">
                        <span class="info-phone">&nbsp;{{ $infos->phone }}</span>
                    </a>
                </li>
                <li class="lang-stretch">
                    <ul class="lang-menu">
                        <li>
                            <a {{ app()->getLocale() === 'de' ? 'class=active' : '' }} 
                                href="{{ url('/') }}"
                                hreflang="de-DE"
                                title="DE"
                            >DE</a>
                        </li>
                        <li>
                            <a {{ app()->getLocale() === 'en' ? 'class=active' : '' }}
                                href="{{ url('/en') }}" 
                                hreflang="en-GB"
                                title="EN"
                            >EN</a>
                        </li>
                        <li>
                            <a {{ app()->getLocale() === 'ru' ? 'class=active' : '' }}
                                href="{{ url('/ru') }}"
                                hreflang="ru-RU"
                                title="RU"
                            >RU</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <nav>
        <div class="wrapper h-100 nav-wrapper">
            <div class="brand py-1 pe-1">
                <img 
                    src="{{ asset('assets/img/logo.png') }}" 
                    alt="{{ 'logo-' . __("messages.words.nav_title") . '-' . $infos->city . '-png' }}" 
                    width="61" height="60"
                >
            </div>

            <h2 class="additive-link">
                <a href="{{ $path }}" title="{{ __('messages.words.nav_title') }}">{{ __('messages.words.nav_title') }}</a>
            </h2>
            
            <input type="checkbox" id="toggle">
            <label class="toggle" for="toggle">
                <span></span>
                <span></span>
                <span></span>
            </label>

            <div class="menu">
                <ul>
                    @foreach ($pages as $page)
                        @php if ($active === 'home') $active = "/$active"; @endphp
                        
                        @if ( ! ($page->link === 'imprint' || $page->link === 'privacy') )
                            <li>
                                @if ( ! $page->any_pages )
                                    <a 
                                    href="{{ url((strlen($path) > 1 ? "$path/" : $path) . ($page->weblink === 'home' ? '' : $page->weblink)) }}" 
                                    title="{{ $page->{$locale} }}"
                                    class="{{ $active === '/' . $page->weblink ? 'active' : '' }}">
                                    {{ $page->{$locale} }} 
                                    </a>
                                @else
                                    @php
                                        $counter = 0;
                                        foreach ($subpages as $sPage) {
                                            if ($sPage->page_id === $page->id) ++$counter;
                                        }
                                    @endphp

                                    <input type="checkbox" id="x{{ $page->id }}-toggle" class="x-toggle-id">
                                    <label class="x-toggle" for="x{{ $page->id }}-toggle">
                                        <span><span></span></span>
                                        <a 
                                            href="{{ url((strlen($path) > 1 ? "$path/" : $path) . $page->weblink) }}" 
                                            title="{{ $page->{$locale} }}"
                                            class="x-point{{ $active === '/'.$page->weblink || str_contains($active, $page->weblink) ? ' active' : '' }}"
                                        >
                                            {{ $page->{$locale} }}
                                        </a>
                                    </label>
                                    <div class="d-none sub-menu">
                                        <ul class="x{{ $counter }}-ul{{ app()->getLocale() === 'ru' ? ' ru-menu' : '' }}">
                                            @foreach ($subpages as $sPage)
                                            @if ($sPage->page_id === $page->id)
                                            <li class="x-list{{ $active === '/' . $sPage->weblink ? ' active' : '' }}">
                                                <a 
                                                href="{{ url((strlen($path) > 1 ? "$path/" : $path) . $sPage->weblink) }}" 
                                                title="{{ $sPage->{$locale} }}"
                                                id="{{ $loop->last ? 'x-link-last' : '' }}{{ $loop->first ? 'x-link-first' : '' }}"
                                                class="x-link">
                                                {{ $sPage->{$locale} }}
                                                </a>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>

<script>
(() => {
    const header = document.querySelector('.navigation');
    const toggle = header.querySelector('#toggle');
    const xtoggleItem = header.querySelectorAll('.x-toggle-id');
    const subItem = header.querySelectorAll('.sub-menu');

    const init = () => {
        toggle.checked = false;
        xtoggleItem.forEach(el => toggleXmenu(el));
        window.addEventListener('load', docReady);
    }

    const toggleXmenu = (el) => {
        const liItem = el.parentNode.querySelectorAll('li');
        const isMobileScreen = window.screen.width <= 991.998;
        const check = [];
        
        liItem.forEach(li => check.push(li.classList.contains('active')));
        el.checked = isMobileScreen ? check.some(el => el) : false;
    }

    const docReady = () => {
        subItem.forEach((sub) => {
            if (sub.classList.contains('d-none')) {
                sub.classList.remove('d-none');
            }
        });
    }

    init();
})()
</script>