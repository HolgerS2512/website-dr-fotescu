{{-- <header class="fixed-top navigation"> --}}
<header class="navigation">
    <ul class="info-strip">
        <li class="info-title">
            <a href="{{ url('/') }}" title="dr-fotescu-zahnarztpraxis-dresden">{{ __('messages.words.nav_title') }}</a>
            @php
                // dump(__("messages[words].nav_title"));
            @endphp
        </li>
        <li class="info-contact">
            <img class="phone-img" src="{{ asset('assets/svg/phone.svg') }}" alt="zahnarzt-dr-fotescu-dresden-telefonsymbol">
            <a class="info-phone" href="tel:+493514117383" title="telefonnummer-dr-fotescu-zahnarztpraxis-dresden">
                &nbsp;+ 49 351 411 73 83
            </a>
        </li>
        <li>
            <ul class="lang-menu">
                <li>
                    <a class="active" href="{{ url('/') }}" title="startseite-deutsch-dr-fotescu-zahnarztpraxis-dresden">DE</a>
                </li>
                <li>
                    <a href="{{ url('/en') }}" title="startseite-englisch-dr-fotescu-zahnarztpraxis-dresden">EN</a>
                </li>
                <li>
                    <a href="{{ url('/ru') }}" title="startseite-russisch-dr-fotescu-zahnarztpraxis-dresden">RU</a>
                </li>
            </ul>
        </li>
    </ul>
    <nav>
        SVG-LOGO
        <ul>
            <li>link</li>
            <li>{{ $active }}</li>
            <li>link</li>
        </ul>
    </nav>
</header>