@extends('layouts.app')

{{--------------------> Metadata <--------------------}}
@section('meta')
<meta name="description" content="Herzlich willkommen bei Zahnarztpraxis Dr. Fotescu in Dresden | Ihr Zahnarzt für nette, kompetente und profesionelle Zahnmedizin | Zahnheilkunde auf dem höhsten Niveau.">
<meta name="keywords" content="zahnarztpraxis, zahnarztpraxis-dresden, zahnarzt, zahnarzt-dresden, zahnarzt-dr-fotescu">
@endsection

{{--------------------> Link <--------------------}}
@section('link')
<link rel="stylesheet" href="{{ asset('assets/css/splide.min.css') }}">
@endsection

{{--------------------> Title <--------------------}}
@section('title')
<title>Zahnarztpraxis Dr. Sebastian Fotescu</title>
@endsection

{{--------------------> Content <--------------------}}
@section('content')
<section class="header">
  @include('components.splidejs', [
    'src' => [
      'assets/img/splide-zahnarzt-dr-sebastian-fotescu-dresden.webp',
      'assets/img/splide_2-zahnarzt-dr-sebastian-fotescu-dresden.webp',
      'assets/img/splide_3-zahnarzt-dr-sebastian-fotescu-dresden.webp',
    ]
  ])
  <h1>Zahnarztpraxis<br/>Dr. Sebastian Fotescu</h1>
</section>


<h2>-------------HOME-------------</h2>
<h2>Eingefügter Inhalt aus HOME</h2>
<h2>lang: {{ substr(app()->getLocale(), 0, 2); }}</h2>
<hr>
ROUTE -> {{  str_replace(config('app.url') . ':8000', '', url()->current()); }}
<br>
<hr>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sed vero voluptates non nemo similique. Distinctio vitae eaque repudiandae sint totam et, nam quisquam labore perferendis architecto non nihil neque accusamus? test</p>
<h2>-------------HOME END-------------</h2>
@endsection

{{--------------------> Script <--------------------}}
{{-- @push('scripts') --}}
{{-- @endpush --}}