@for ($i = 1; $i <= 20; $i++)
  <div class="mb-3 item" data-size="{{ $i }}">
    <label class="form-label mt-3">Item {{ $i }}</label>
    <x-helpers.i-group :flag="'de'" 
    :name="'item_' . $i . '.de'" 
    :value="old('item_' . $i . '.de')"  
    />

    <x-helpers.i-group :flag="'en'" 
      :name="'item_' . $i . '.en'" 
      :value="old('item_' . $i . '.en')"  
    />

    <x-helpers.i-group :flag="'ru'" 
      :name="'item_' . $i . '.ru'" 
      :value="old('item_' . $i . '.ru')"  
    />
  </div>
@endfor