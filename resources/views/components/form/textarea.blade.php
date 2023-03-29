@props([
    'name', 'lable' => false, 'type','value'=>''
    ])
<div class="col-12">
    @if ($lable)
    <label for="" class="text-capitalize ">{{ __($lable) }}</label>
@endif
    <textarea name="{{$name}}"
              id=""
              placeholder=""
              {{$attributes->class(['form-control','is-invalid'=>$errors->has($name)])}} rows="6">{{old('$name',$value)}}</textarea>
    @error($name)
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
