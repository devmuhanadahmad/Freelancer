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
        <x-form.input name="name" lable="Title Project" :value="$project->name" required  />
    </div>
</div><br>

<div class="row">
    <div class="col-md-12">
        <x-form.textarea lable="Description" name="notes" :value="$project->notes" required />
    </div>
</div><br>

 <!--name select-->
 <div >
    <label for="inputName" class="control-label">Sub Category </label>
    <select name="category_id" @class([
       'form-control ','SlectBox','is-invalid'=>$errors->has('category_id')
    ])
     onclick="console.log($(this).val())"
        onchange="console.log('change is firing')">
        <!--placeholder-->
        <option value="" selected disabled>Primary Category</option>
        @foreach ($categories as $parent)
            <option value="{{ $parent->id }}" @selected(old('category_id',$project->category_id) == $parent->id)>
                {{ $parent->name }}</option>
        @endforeach
        @error('category_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </select>
</div>

<div class="form-row">
    <div class="col-md-12">
        <x-form.input name="skills" type="text" lable="Skills" :value="implode(',',$skills)" required />
    </div>
</div><br>


<div class="form-row">
    <div class="col-md-12">
        <x-form.input name="tags" type="text" lable="tags"   :value="implode(',',$tags)" required />
    </div>
</div><br>

<div class="form-row">
    <div class="col-md-6">
        <x-form.input name="budget" type="number" lable="Budget" :value="$project->budget"  required/>
    </div>
    <div class="col-md-6">
        <x-form.status lable="Type" name="type" :value="$project->type" required :option="['hourly' => 'Hourly', 'fixed' => 'Fixed']" />
    </div>
</div><br>

<div class="form-row">
    <div class="col-md-6">
        <x-form.input name="days_number" type="number" lable="Days Number" :value="$project->days_number" required />
    </div>
    <div class="col-md-6">
        <x-form.status lable="Status" name="status" :value="$project->type" required :option="['open' => 'Open', 'in-progress' => 'In progress','closed' => 'Closed']" />
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
@push('css')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush
@push('js')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
 var inputElm = document.querySelector('[name=tags]'),
 tagify = new Tagify(inputElm);

 var inputElm = document.querySelector('[name=skills]'),
 tagify = new Tagify(inputElm);

</script>
@endpush
