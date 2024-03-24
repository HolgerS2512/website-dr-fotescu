<footer>
    <div class="f-nav">
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-3 col-sm-6 order-sm-3 order-lg-1">
                    <div class="d-lg-flex justify-content-center mb-5">

                        <ul class="d-inline">
                            <span>Standort Dresden</span>
                            <hr>
                            <li>
                                <a href="{{ $infos->maps }}" target="_blank" rel="noopener noreferrer">
                                    {{ str_replace(['(', ')'], '', $infos->location) }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ $infos->maps }}" target="_blank" rel="noopener noreferrer">
                                    {{ $infos->address }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ $infos->maps }}" target="_blank" rel="noopener noreferrer">
                                    {{ $infos->zip . ' ' . $infos->city }}
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
        


                <div class="col-lg-3 col-sm-6 order-sm-1 order-lg-2">
                    <div class="d-lg-flex justify-content-center mb-5">
                        <ul class="d-inline">
                            <span>Sitemap</span>
                            <hr>
                            @foreach ($pages as $page)
                                @if ( ! $page->subpage )
                                    <li>
                                        <a 
                                            href="{{ $path . $page->weblink }}" 
                                            class="{{ $active === $page->weblink ? 'f-active' : '' }}">
                                            {{ $locale === 'de' ? $page->name : $page->{$locale . '_name'} }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
        
                <div class="col-lg-3 col-sm-6 order-sm-2 order-lg-3">
                    <div class="d-lg-flex justify-content-center mb-5">
                        <ul class="d-inline">
                            <span>{{ __('messages.words.zfatreatments') }}</span>
                            <hr>
                            @foreach ($pages as $page)
                                @if ( $page->subpage )
                                    <li>
                                        <a 
                                            href="{{ $path . $page->weblink }}" 
                                            class="{{ $active === $page->weblink ? 'f-active' : '' }}">
                                            {{ $locale === 'de' ? $page->name : $page->{$locale . '_name'} }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 order-4">
                    <div class="d-lg-flex justify-content-center mb-5">
                        <ul class="d-inline">
                            <span>Anfahrt</span>
                            <hr>
                            <iframe
                                class="my-1 mw-100"
                                src="{{ $infos->iframe }}"
                                width="280" height="220" style="border:0;" allowfullscreen loading="lazy"
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
                        href="{{ $path === '/' ? $path . 'impressum' : $path . '/impressum' }}"
                        title="{{ __('messages.title.imprint') }}"
                        class="me-1 link-hover link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover"
                    >{{ __('messages.title.imprint') }}
                    </a> &VerticalLine; <a 
                        href="{{ $path === '/' ? $path . 'datenschutz' : $path . '/datenschutz' }}"
                        title="{{ __('messages.title.privacy') }}"
                        class="ms-1 link-hover link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover"
                    >{{ __('messages.title.privacy') }}</a>
                </div>

                <div class="col-md-4 d-flex justify-content-center mb-3 m-md-0">
                    <a 
                        href="{{ $path }}"
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