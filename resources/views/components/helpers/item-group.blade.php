<label class="form-label">Item {{ $i }}</label>
<x-helpers.i-group :flag="'de'" 
  :name="'item.de.' . $i . (isset($deItem) ? '' : '.new')" 
  :value="old('item.de.' . $i . (isset($deItem) ? '' : '.new')) ?? $deItem"  
/>

<x-helpers.i-group :flag="'en'" 
  :name="'item.en.' . $i . (isset($enItem) ? '' : '.new')" 
  :value="old('item.en.' . $i . (isset($enItem) ? '' : '.new')) ?? $enItem"  
/>

<x-helpers.i-group :flag="'ru'" 
  :name="'item.ru.' . $i . (isset($ruItem) ? '' : '.new')" 
  :value="old('item.ru.' . $i . (isset($ruItem) ? '' : '.new')) ?? $ruItem"  
/>