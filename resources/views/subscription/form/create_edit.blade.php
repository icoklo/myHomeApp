<div class="form-group row">
    <label class="col-sm-3"> {{ __('translations.poll_interval').':' }} </label>
    <div class="col-sm-9">
        <select class="form-control" name="poll_interval">
            @foreach($intervals as $key => $value)
                <option value="{{ $value }}"
                @if( isset($userInformation) AND $userInformation->poll_interval_2 == $value)
                    selected
                @elseif( old('poll_interval') == $value)
                    selected
                @endif
                >
                {{ $key }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group weather">
    <p> {{ __('translations.configuration').':' }} </p>

    <div class="form-group row">
        <label class="col-sm-3"> {{ __('translations.city').':' }} </label>
        <div class="col-sm-9">
            <select class="form-control" name="configuration[city]">
                @foreach($cities as $c)
                    <option value="{{ $c }}"
                    @if( array_key_exists('city', $userInformationConfig) AND $userInformationConfig['city'] == $c)
                        selected
                    @elseif( old('city') == $value)
                        selected
                    @endif
                    >
                    {{ $c }}
                </option>
            @endforeach
        </select>
    </div>
</div>
</div>

<div class="form-group currency-list">
<p> {{ __('translations.configuration').':' }} </p>
<div class="form-group row">
    <label class="col-sm-3"> {{ __('translations.bank').':' }} </label>
    <div class="col-sm-9">
        <select class="form-control" name="configuration[bank]">
            @foreach($banks as $b)
                <option value="{{ $b }}"
                @if( array_key_exists('bank', $userInformationConfig) AND $userInformationConfig['bank'] == $b)
                    selected
                @elseif( old('configuration[bank]') == $value)
                    selected
                @endif
                >
                {{ $b }}
            </option>
        @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3"> {{ __('translations.currency').':' }} </label>
    <div class="col-sm-9">
        <select class="form-control" name="configuration[currency]">
            @foreach($currency as $cur)
                <option value="{{ $cur }}"
                @if( array_key_exists('currency', $userInformationConfig) AND $userInformationConfig['currency'] == $cur)
                    selected
                @elseif( old("configuration[currency]") == $cur)
                    selected
                @endif
                >
                {{ $cur }}
            </option>
        @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3"> {{ __('translations.category').':' }} </label>
    <div class="col-sm-9">
        <select class="form-control" name="configuration[category]">
            @foreach($categories as $cat)
                <option value="{{ $cat }}"
                @if( array_key_exists('category', $userInformationConfig) AND $userInformationConfig['category'] == $cat)
                    selected
                @elseif( old("configuration[currency]") == $cat)
                    selected
                @endif
                >
                {{ $cat }}
            </option>
        @endforeach
        </select>
    </div>
</div>
</div>

<div class="form-group row mb-0">
    <div class="col-sm-6 offset-sm-3">
        <button type="submit" class="btn btn-primary">
            {{ __('translations.save') }}
        </button>
    </div>
</div>
