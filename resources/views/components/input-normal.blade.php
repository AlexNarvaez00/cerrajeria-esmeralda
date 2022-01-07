<div {{$attributes}}>
    <!--
        class="col-md-12 col-sm-12"

        col-3 -> classesLabel
    -->
    <div class="input-group mb-3">
        <label class="input-group-text justify-content-end {{$classesLabel}}" for="{{$idInput}}">{{$texto}}</label>
        <input type="{{$type}}" class="form-control {{$activeInput}}" 
                value="{{ $valor }}" placeholder="" 
                aria-label="Username" aria-describedby="basic-addon1" 
                id="{{$idInput}}" name="{{$nombreInput}}">
         @if ($nombreError != '')
            @error($nombreError)
                <p class="col-12 text-danger ps-2"> {{$message}}</p>
            @enderror
         @endif       
    </div>
</div>