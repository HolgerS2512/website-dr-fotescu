<label class="form-label mt-3">Content</label>
<x-helpers.t-group :flag="'de'" 
  :name="'content.de.' . (isset($deContent) ? $deContent->id : $ranking . '.new')" 
  :value="old('content.de.' . $deContent->id) ?? $deContent->content" 
/>

<x-helpers.t-group :flag="'en'" 
  :name="'content.en.' . (isset($enContent) ? $enContent->id : $ranking . '.new')" 
  :value="old('content.en.' . (isset($enContent) ? $enContent->id : $ranking . '.new')) ?? ( isset($enContent) ? $enContent->content : '' )" 
/>

<x-helpers.t-group :flag="'ru'" 
  :name="'content.ru.' . (isset($ruContent) ? $ruContent->id : $ranking . '.new')" 
  :value="old('content.ru.' . (isset($ruContent) ? $ruContent->id : $ranking . '.new')) ?? ( isset($ruContent) ? $ruContent->content : '' )" 
/>
