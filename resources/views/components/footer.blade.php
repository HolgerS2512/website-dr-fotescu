<footer>
    <div class="f-nav">
        <div class="wrapper">
            <div class="row">
                <div class="col-xl-3 col-sm-6 order-sm-3 order-xl-1">
                    <div class="d-xl-flex justify-content-between mb-5">

                        <ul class="d-inline">
                            <span>Standort Dresden</span>
                            <hr>
                            <li>
                                <a href="{{ $infos->maps }}" target="_blank" rel="noopener noreferrer"
                                    title="{{ str_replace(['(', ')'], '', $infos->location) }}">
                                    {{ str_replace(['(', ')'], '', $infos->location) }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ $infos->maps }}" target="_blank" rel="noopener noreferrer"
                                    title="{{ $infos->address }}">
                                    {{ $infos->address }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ $infos->maps }}" target="_blank" rel="noopener noreferrer"
                                    title="{{ $infos->zip . ' ' . $infos->city }}">
                                    {{ $infos->zip . ' ' . $infos->city }}
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
        


                <div class="col-xl-3 col-sm-6 order-sm-1 order-xl-2">
                    <div class="d-xl-flex justify-content-between mb-5">
                        <ul class="d-inline">
                            <span>Sitemap</span>
                            <hr>
                            @foreach ($pages as $page)
                                <li>
                                    <a 
                                        href="{{ url((strlen($path) > 1 ? "$path/" : $path) . ($page->weblink === 'home' ? '' : $page->weblink)) }}"
                                        title="{{ $page->{$locale} }}" 
                                        class="{{ $active === $page->weblink ? 'menu-active' : '' }}">
                                        {{ $page->{$locale} }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
        
                <div class="col-xl-3 col-sm-6 order-sm-2 order-xl-3">
                    <div class="d-xl-flex justify-content-between mb-5">
                        <ul class="d-inline">
                            <span>{{ __('messages.words.zfatreatments') }}</span>
                            <hr>
                            @foreach ($subpages as $subpage)
                                @if ( $subpage->page_id === 2 )
                                    <li>
                                        <a 
                                            href="{{ url((strlen($path) > 1 ? "$path/" : $path) . $subpage->weblink) }}"
                                            title="{{ $subpage->{$locale} }}" 
                                            class="{{ $active === $subpage->weblink ? 'menu-active' : '' }}">
                                            {{ $subpage->{$locale} }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 order-4">
                    <div class="d-xl-flex justify-content-between mb-5">
                        <ul class="d-inline" style="width: 100%">
                            <span>{{ __('messages.words.approach') }}</span>
                            <hr>
                            <iframe
                                class="my-1 mw-100"
                                src="{{ $infos->iframe }}" width="300" height="240" style="border:0;" allowfullscreen loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" alt="google-maps-link-zahnarzt-dr-fotescu-dresden" title="Google Maps">
                            </iframe>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-white bg-blue-dark f-section">
        <div class="wrapper h-100">
            <div class="row flex-row-reverse align-items-center h-100">
                <div class="col-md-4 text-center text-md-end my-3 m-md-0">
                    <a 
                        href="{{ url($path === '/' ? $path . 'impressum' : $path . '/impressum') }}"
                        title="{{ __('messages.title.imprint') }}"
                        class="me-1 link-hover link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover"
                    >{{ __('messages.title.imprint') }}
                    </a> &VerticalLine; <a 
                        href="{{ url($path === '/' ? $path . 'datenschutz' : $path . '/datenschutz') }}"
                        title="{{ __('messages.title.privacy') }}"
                        class="ms-1 link-hover link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover"
                    >{{ __('messages.title.privacy') }}</a>
                </div>

                <div class="col-md-4 d-flex justify-content-center mb-3 m-md-0">
                    <a 
                        href="{{ url($path) }}"
                        title="{{ __('messages.title.home') }}"
                        class="link-logo"
                    >
                        <img 
                            class="brand" 
                            src="{{ asset('assets/img/logo-grey.png') }}" 
                            alt="logo-grey-zahnarzt-zahnarztpraxis-dr-fotescu-dresden"
                        >
                    </a>
                </div>

                <div class="col-md-4 mb-3 m-md-0 text-center text-md-start">
                    <small style="white-space: nowrap;">
                        &copy; {{ ucfirst(__('messages.words.copyright')) }} {{ date('Y') }} Dr. Sebastian Fotescu
                    </small>
                </div>
            </div>
        </div>
    </div>
</footer>