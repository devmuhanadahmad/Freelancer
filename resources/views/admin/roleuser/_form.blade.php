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

<div class="row">
    <div class="col-6">
        <label for="inputName" class="control-label">User </label>
        <select name="user_id" @class([
           'form-control ','SlectBox','is-invalid'=>$errors->has('user_id')
        ])
         onclick="console.log($(this).val())"
            onchange="console.log('change is firing')">
            <!--placeholder-->
            <option value="" selected disabled>Select User</option>
            @foreach ($user as $user)
                <option value="{{ $user->id }}" @selected(old('user_id',$roleuser->user_id) == $user->id)>
                    {{ $user->name }}</option>
            @endforeach
            @error('user_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </select>
    </div>

    <div class="col-6">
        <label for="inputName" class="control-label">Role Name </label>
        <select name="role_id" @class([
           'form-control ','SlectBox','is-invalid'=>$errors->has('role_id')
        ])
         onclick="console.log($(this).val())"
            onchange="console.log('change is firing')">
            <!--placeholder-->
            <option value="" selected disabled>Select User</option>
            @foreach ($role as $role)
                <option value="{{ $role->id }}" @selected(old('role_id',$roleuser->role_id) == $role->id)>
                    {{ $role->name }}</option>
            @endforeach
            @error('role_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </select>
    </div>

</div><br><br>


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
