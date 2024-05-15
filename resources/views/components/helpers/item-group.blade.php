<label class="form-label">Item {{ $i }}</label>
<x-helpers.i-group :flag="'de'" 
  :name="'item.de.' . $i . (isset($deId) ? '.list.' . $deId : '')" 
  :value="old('item.de.' . $i . (isset($deId) ? '.list.' . $deId : '')) ?? $deItem"  
/>

<x-helpers.i-group :flag="'en'" 
  :name="'item.en.' . $i . (isset($enId) ? '.list.' . $enId : '')" 
  :value="old('item.en.' . $i . (isset($enId) ? '.list.' . $enId : '')) ?? $enItem"  
/>

<x-helpers.i-group :flag="'ru'" 
  :name="'item.ru.' . $i . (isset($ruId) ? '.list.' . $ruId : '')" 
  :value="old('item.ru.' . $i . (isset($ruId) ? '.list.' . $ruId : '')) ?? $ruItem"  
/>