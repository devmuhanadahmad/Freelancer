@if ($errors->any())
<div class="alert alert-danger">
    <h5>{{ __('Error Occured') }}</h5>
    <ul>
        @foreach ($errors->all() as $err)
            <li class="text-danger">{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-row">
    <div class="col-md-12">
        <x-form.input name="name" lable="Title category" :value="$category->name" required  />
    </div>
</div><br>

<div class="row">
    <div class="col-md-12">
        <x-form.textarea lable="Description" name="notes" :value="$category->notes" required />
    </div>
</div><br>

 <!--name select-->
 <div >
    <label for="inputName" class="control-label">Sub Category </label>
    <select name="parent_id" @class([
       'form-control ','SlectBox','is-invalid'=>$errors->has('parent_id')
    ])
     onclick="console.log($(this).val())"
        onchange="console.log('change is firing')">
        <!--placeholder-->
        <option value="" selected disabled>Primary Category</option>
        @foreach ($parent as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id',$category->parent_id) == $parent->id)>
                {{ $parent->name }}</option>
        @endforeach
        @error('parent_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </select>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <x-form.status lable="Status" name="status" :value="$category->type" required :option="['active'=>'Active','inactive'=>'Inactive']" />
    </div>
</div><br>

<!--image input-->
<div class="row">
    <div class="col-md-12">
        <x-form.input lable="Image" type="file" name="image" class="dropify"
            accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
    </div>
</div> <br><br>



<div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-primary">{{ __('Save Data') }}</button>
</div>
<br><br>

