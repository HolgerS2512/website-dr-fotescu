{{-- <header class="fixed-top navigation"> --}}
<header class="navigation">
    <ul class="info-strip bg-blue">
        <li class="info-title">
            <a href="{{ $path }}" title="{{ __('messages.words.nav_title') }}">{{ __('messages.words.nav_title') }}</a>
        </li>
        <li class="info-contact">
            <a 
                class="d-flex"
                href="tel:+493514117383" 
                title="telefonnummer-dr-fotescu-zahnarztpraxis-dresden"
            >
                <img class="phone-img" src="{{ asset('assets/svg/phone.svg') }}" alt="zahnarzt-dr-fotescu-dresden-telefonsymbol">
                <span class="info-phone">&nbsp;+ 49 351 411 73 83</span>
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

    <nav>
        <div class="brand p-1">
            <img src="{{ asset('assets/img/logo.png') }}" alt="zahnarzt-dr-fotescu-dresden-zahnarztpraxis" width="61" height="60">
        </div>
        
        <ul>
            <li class="ms-1">link </li>
            <li class="ms-1 px-1 bg-primary text-white">active: ('{{ $active }}')</li>
            <li class="ms-1">link</li>
        </ul>
    </nav>
</header>