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
        <x-form.input name="name" lable="Title Project" :value="$role->name" required  />
    </div>
</div><br>

<div class="form-group">
    @foreach (app('abilities') as $ability=>$lablel )
    <div class="form-check">
        <input type="checkbox"  name="abilities[]" label="Role Nmae" value="{{$ability}}" class="form-check-input" id="flexCheckDefault" @if(in_array($ability,($role->abilities ?? []))) checked @endif >
        <label class="form-check-lable" for="flexCheckDefault">
            {{$lablel}}
        </label>
    </div>
    @endforeach
</div>


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
