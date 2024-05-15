<label class="form-label">{{ $label ?? 'Title' }}</label>
<x-helpers.i-group :flag="'de'" 
  :name="'title.de.' . ($additive ?? '') . (isset($deContent) ? $deContent->id : $ranking . '.new')" 
  :value="old('title.de.' . ($additive ?? '') . $deContent->id) ?? $deContent->title" 
/>

<x-helpers.i-group :flag="'en'" 
  :name="'title.en.' . ($additive ?? '') . (isset($enContent) ? $enContent->id : $ranking . '.new')" 
  :value="old('title.en.' . ($additive ?? '') . (isset($enContent) ? $enContent->id : $ranking . '.new')) ?? ( isset($enContent) ? $enContent->title : '' )"
/>

<x-helpers.i-group :flag="'ru'" 
  :name="'title.ru.' . ($additive ?? '') . (isset($ruContent) ? $ruContent->id : $ranking . '.new')" 
  :value="old('title.ru.' . ($additive ?? '') . (isset($ruContent) ? $ruContent->id : $ranking . '.new')) ?? ( isset($ruContent) ? $ruContent->title : '' )" 
/>

{{-- <label class="form-label">{{ $label ?? 'Title' }}</label>
<x-helpers.i-group :flag="'de'" 
  :name="'title.de.' . (isset($deContent) ? $deContent->id : $ranking . '.new')" 
  :value="old('title.de.' . $deContent->id) ?? $deContent->title" 
/>

<x-helpers.i-group :flag="'en'" 
  :name="'title.en.' . (isset($enContent) ? $enContent->id : $ranking . '.new')" 
  :value="old('title.en.' . (isset($enContent) ? $enContent->id : $ranking . '.new')) ?? ( isset($enContent) ? $enContent->title : '' )"
/>

<x-helpers.i-group :flag="'ru'" 
  :name="'title.ru.' . (isset($ruContent) ? $ruContent->id : $ranking . '.new')" 
  :value="old('title.ru.' . (isset($ruContent) ? $ruContent->id : $ranking . '.new')) ?? ( isset($ruContent) ? $ruContent->title : '' )" 
/> --}}