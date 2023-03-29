@if (!empty($successMessage))
<div class="alert alert-success" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    {{ $successMessage }}
</div>
@endif

<div class="col">
        <label class="text-capitalize ">Name</label>
    <input type="text"
           class="form-control"
           wire:model="name"
           placeholder="Enter Name">
    @error("name")
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="col">
    <label class="text-capitalize ">Name</label>
<input type="text"
       class="form-control"
       wire:model="name"
       placeholder="Enter Name">
@error("name")
    <small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="col">
    <label class="text-capitalize ">Name</label>
<input type="text"
       class="form-control"
       wire:model="name"
       placeholder="Enter Name">
@error("name")
    <small class="text-danger">{{ $message }}</small>
@enderror
</div>









</div><br>

<div class="d-flex justify-content-center">
<button type="submit" class="btn btn-primary">ٍSave Data</button>

</div>
<br><br>
