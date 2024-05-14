<div class="my-3 input-group">
  <label class="input-group-text {{ $list->{"item_$i"} ? 'bg-warning-subtle' : 'bg-danger-subtle' }}">Button {{ $i }} link to the page:</label>
  <select class="form-select" name="{{ "item.$i.btn" }}" style="max-width: 300px;">

    <option value="">Choose a page</option>
    <hr />
    <optgroup label="Subpages">
      @foreach ($subpages as $item)
        <option 
          value="{{ "item_$i" }}"{{ $item->link == $list->{"item_$i"} ? ' selected' : '' }}
        >{{ $item->en }}</option>
      @endforeach
    </optgroup>

  </select>
</div>

