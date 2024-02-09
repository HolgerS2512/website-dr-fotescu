@extends('layouts.app')

{{--------------------> Metadata <--------------------}}
@section('meta')
<meta name="description" content="Kontakt | Herzlich willkommen bei Zahnarztpraxis Dr. Fotescu in Dresden | Ihr Zahnarzt für nette, kompetente und profesionelle Zahnmedizin | Zahnheilkunde auf dem höhsten Niveau.">
<meta name="keywords" content="zahnarztpraxis, zahnarztpraxis-dresden, zahnarzt, zahnarzt-dresden, zahnarzt-dr-fotescu, zahnarzt-kontakt">
@endsection

{{--------------------> Title <--------------------}}
@section('title')
<title>Kontakt | Zahnarztpraxis Dr. Fotescu</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
    <div class='container'>
        <form 
            method="POST" 
            action="/kontakt"
            class="row g-3 col-lg-6"
        >
            @csrf
            <div>
                <label for="name" class="form-label">Name*</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
                <div class="invalid-feedback">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>           
            <div>
                <label for="email" class="form-label">Email*</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
                <div class="invalid-feedback">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>           
            <div>
                <label for="reference" class="form-label">Betreff*</label>
                <input type="text" name="reference" class="form-control @error('reference') is-invalid @enderror" id="reference" value="{{ old('reference') }}" required>
                <div class="invalid-feedback">
                    @error('reference')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div>
                <label for="msg" class="form-label">Nachricht*</label>
                <textarea rows="6" class="form-control @error('msg') is-invalid @enderror" name="msg" id="msg" placeholder="Ihre Nachricht an uns" required>{{ old('msg') }}</textarea>
                <div class="invalid-feedback">
                    @error('msg')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div>
                <div class="form-check">
                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms">
                    <label class="form-check-label" for="terms">
                    Ich habe die Datenschutz-Richtlinien zur Kenntnis genommen und akzeptiere diese.*
                    </label>
                    <div class="invalid-feedback terms-fb">
                        @error('terms')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Abschicken</button>
            </div>
        </form>
    </div>
@endsection



