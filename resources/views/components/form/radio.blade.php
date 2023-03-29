@props(['name', 'lable', 'options', 'checked' => false])

<fieldset class="form-group row mt-4 ">
    <legend class="col-form-label col-sm-2 float-sm-left pt-0 text-capitalize">{{ __("$lable") }}</legend>
    <div class="col-sm-10 ">




            @foreach ($options as $value => $text)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="{{ $name }}" id="gridRadios1"
                    value="{{ $value }}  "
                    {{ $attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)]) }}>
                <label class="form-check-label" for="gridRadios1">
                    {{ $text }}
                </label>      </div>
                @endforeach


        @error($name)
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</fieldset>

