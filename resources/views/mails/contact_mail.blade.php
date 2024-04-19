<p style="font-size: 20px;">Eine Anfrage über das Kontaktformular Ihrer Webseite ist bei Ihnen eingegangen.</p>

<p style="font-size: 20px;">Von:<br><br>{{ $name }}</p>

<p style="font-size: 20px;">E-Mail: {{ $email }}</p>

<p style="font-size: 20px;">Mobile: {{ $phone }}</p>

<p style="font-size: 20px;">Betreff: {{ $reference }}</p>

<p style="font-size: 20px;">Nachricht: {{ $msg }}</p>

<p>
  <a href="mailto:{{ $email }}">
    <button style="padding: 20px 24px; border: 2px solid 	#5a94cf; color: #5a94cf;background:white; cursor: pointer; font-size:20px;">Neue Mail öffnen</button>
  </a>
</p>

<img src="{{ $src }}" width="60" height="auto" alt="Logo.png">