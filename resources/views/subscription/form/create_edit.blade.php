<div class="form-group row label-floating {{ ($errors->has('email')) ? 'has-error' : '' }}">
    <label class="col-sm-3 control-label"> {{ __('translations.bookmark_name') }} </label>
    <div class="col-sm-9">
        <input type="text" name="name"
        @if( isset($bookmark) )
            value="{{ $bookmark->name }}"
        @else
            value="{{ old('name') }}"
        @endif
        class="form-control">
    </div>
</div>
<div class="form-group row label-floating {{ ($errors->has('email')) ? 'has-error' : '' }}">
    <label class="col-sm-3 control-label"> {{ __('translations.poll_interval').':' }} </label>
    <div class="col-sm-9">
        <input type="text" name="poll_interval"
        @if( isset($bookmark) )
            value="{{ $bookmark->name }}"
        @else
            value="{{ old('name') }}"
        @endif
        class="form-control">
    </div>
</div>
