{{-- contact form --}}

<div class="wrapper">
    <div class="mb-3 py-5">

        <form 
        method="POST" 
        action="/kontakt"
        class="row g-3 col-lg-6"
        >
        @csrf
        <div>
            <label for="name" class="form-label">Name*</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>           
        <div>
            <label for="email" class="form-label">Email*</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>           
        <div>
            <label for="reference" class="form-label">Betreff*</label>
            <input type="text" name="reference" class="form-control @error('reference') is-invalid @enderror" id="reference" value="{{ old('reference') }}" required>
            @error('reference')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <label for="msg" class="form-label">Nachricht*</label>
            <textarea rows="6" class="form-control @error('msg') is-invalid @enderror" name="msg" id="msg" placeholder="Ihre Nachricht an uns" required>{{ old('msg') }}</textarea>
            @error('msg')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <div class="form-check">
                <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms">
                <label class="form-check-label" for="terms">
                Ich habe die Datenschutz-Richtlinien zur Kenntnis genommen und akzeptiere diese.*
                </label>
                @error('terms')
                    <div class="invalid-feedback terms-fb">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Abschicken</button>
        </div>
        </form>

    </div>
</div>