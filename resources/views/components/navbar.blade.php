<header class="fixed-top navigation">
    <div class="bg-blue w-100">
        <div class="wrapper">
            <ul class="info-strip">
                <li class="info-title">
                    <a href="{{ $path }}" title="{{ __('messages.words.nav_title') }}">{{ __('messages.words.nav_title') }}</a>
                </li>
                <li class="info-contact">
                    <a 
                        class="d-flex"
                        href="tel:{{ str_replace(' ', '', $infos->phone) }}" 
                        title="{{ __("messages.title.contact") }}"
                    >
                        <img class="phone-img" src="{{ asset('assets/svg/phone.svg') }}" alt="{{ 'mobile-' . __("messages.words.nav_title") . '-' . $infos->city . '-svg' }}">
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

            <div id="menu">
                <ul>
                    @foreach ($pages as $page)
                        @if ( ! ($page->link === 'imprint' || $page->link === 'privacy') )
                            <li>
                                @if ($page->link !== 'treatments')
                                    <a 
                                    href="{{ url((strlen($path) > 1 ? "$path/" : $path) . ($page->weblink === 'home' ? '' : $page->weblink)) }}" 
                                    title="{{ $page->{$locale} }}"
                                    class="{{ $active === $page->weblink ? 'menu-active' : '' }}">
                                    {{ $page->{$locale} }}
                                </a>
                                @else
                                    <ul>
                                        {{-- SUBPAGES --}}
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            {{-- <ul style="height:100%;width: 70px;position:relative;">
                <div style="position: absolute">
                    <li class="ms-1">link </li>
                <li class="ms-1 px-1 bg-primary text-white">active: ('{{ $active }}')</li>
                <li class="ms-1">link</li>
                </div>
            </ul> --}}
        </div>
    </nav>
</header>

<script>
(() => {
    const header = document.querySelector('.navigation');
    const toggle = header.querySelector('#toggle');

    const init = () => {
        toggle.checked = false;
    }

    init();
})()
</script>