@props(['id'=> '','name','type'=>'text', 'lable' => false,  'value' => '','placeholder'=> ''])
<div class="col">
    @if ($lable)
        <label for="{{$id}}" class="text-capitalize ">{{__($lable) }}</label>
    @endif
    <input type="{{ $type }}"
           name="{{ $name }}"
           value="{{ old($name, $value) }}"
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
           id="{{$id}}"
           placeholder="{{__($placeholder)}}"

        >
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
