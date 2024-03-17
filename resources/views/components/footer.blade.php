<footer>
    <h3>-------------------------------------------FOOTER-------------------------------------------</h3>
    <ul>
        <li>link</li>
        <li>{{ $content }}</li>
        <li>{{ $path }}</li>
        <li>link</li>
    </ul>
    
    <div class="text-white bg-blue-dark footer-sec-two">
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