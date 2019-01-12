<div class="form-group row label-floating {{ ($errors->has('email')) ? 'has-error' : '' }}">
    <label class="col-sm-3 control-label"> {{ __('translations.bookmark_name') }} </label>
    <div class="col-sm-9">
        <input type="name" name="name" required
        @if( isset($bookmark) )
            value="{{ $bookmark->name }}"
        @else
            value="{{ old('name') }}"
        @endif
        class="form-control">
    </div>
</div>
@if ($errors->has('name'))
    <span class="help-block">
        <strong>{{ $errors->first('name') }}</strong>
    </span>
@endif

<div class="form-group row label-floating {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
    <label class="col-sm-3 control-label"> {{ __('translations.url') }} </label>
    <div class="col-sm-9">
        <input type="text" name="url" class="form-control" required
        @if( isset($bookmark) )
            value="{{ $bookmark->url }}"
        @else
            value="{{ old('url') }}"
        @endif
        >
    </div>
</div>
@if ($errors->has('url'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('url') }}</strong>
    </span>
@endif
<div class="form-group row label-floating {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
    <label class="col-sm-3 control-label"> {{ __('translations.description') }} </label>
    <div class="col-sm-9">
        <textarea name="description" class="form-control" >
@if( isset($bookmark) ){{$bookmark->description}}
@else {{old('description')}}
@endif
        </textarea>
    </div>
</div>
@if ($errors->has('description'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('description') }}</strong>
    </span>
@endif
<div class="form-group row">
    <label class="col-sm-3 control-label" for="icon">{{ __('translations.icon') }}</label>
    <div class="col-sm-9">
        <input type="file" name="icon">
    </div>
</div>
@if( isset($bookmark) AND isset($bookmark->icon) )
    <div class="offset-sm-3 form-group">
        <img src="{{ asset('storage/'.$bookmark->icon) }}" alt="icon">
    </div>
@endif
<div class="form-group row label-floating {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
    <label class="col-sm-3 control-label"> {{ __('translations.sort_order') }} </label>
    <div class="col-sm-9">
        <input type="text" name="sort_order" class="form-control" required
        @if( isset($bookmark) )
            value="{{ $bookmark->sort_order }}"
        @else
            value="{{ old('sort_order') }}"
        @endif
        >
    </div>
</div>
@if ($errors->has('sort_order'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('sort_order') }}</strong>
    </span>
@endif
<div class="form-group row mb-0">
    <div class="col-sm-6 offset-sm-3">
        <button type="submit" class="btn btn-primary">
            {{ __('translations.save') }}
        </button>
    </div>
</div>
