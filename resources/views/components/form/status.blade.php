    @props([
    'name', 'lable' => false,'value'=>'','option'
    ])
<div class="col">
    @if ($lable)
    <label for="" class="control-label ">{{ __($lable) }}</label>
    @endif
    <select name="{{$name}}"
            {{$attributes->class(['form-control','SlectBox','is-invalid'=>$errors->has($name) ])}} onclick="console.log($(this).val())"
            onchange="console.log('change is firing')"
            >
            <!--placeholder-->
            @foreach ($option as $k=>$val)
            <option value="{{$k}}"  @selected(old('$name',$value) == $k)>{{$val}}</option>
            @endforeach
    </select>
    @error($name)
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
