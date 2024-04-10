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
        <div class="wrapper">
            <div class="brand py-1 pe-1">
                <img 
                    src="{{ asset('assets/img/logo.png') }}" 
                    alt="{{ 'logo-' . __("messages.words.nav_title") . '-' . $infos->city . '-png' }}" 
                    width="61" height="60"
                >
            </div>
            
            <ul>
                <li class="ms-1">link </li>
                <li class="ms-1 px-1 bg-primary text-white">active: ('{{ $active }}')</li>
                <li class="ms-1">link</li>
            </ul>
        </div>
    </nav>
</header>