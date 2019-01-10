@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="min-width: 60%;">
                <div class="card-header">{{ __('translations.create_subscription') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('subscriptions.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-3"> {{ __('translations.information').':' }} </label>
                        <div class="col-sm-9">
                            <select class="form-control" name="information">
                                @foreach($informations as $information)
                                    <option value={{ $information->id }}
                                        @if( old('information') == $information->id)
                                            selected
                                        @endif
                                        >
                                        {{ $information->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @include('subscription.form.create_edit')
                    <div class="form-group weather">
                        <p> {{ __('translations.configuration').':' }} </p>

                        <div class="form-group row">
                            <label class="col-sm-3"> {{ __('translations.city').':' }} </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="city">
                                    @foreach($cities as $c)
                                        <option value={{ $c }}
                                        @if( old('information') == $information->id)
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
                        <label class="col-sm-3"> {{ __('translations.currency').':' }} </label>
                        <div class="col-sm-9">
                            <select class="form-control" name="bank">
                                @foreach($banks as $b)
                                    <option value={{ $c }}
                                    @if( old('information') == $information->id)
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
                            <select class="form-control" name="currency">
                                @foreach($currency as $c)
                                    <option value={{ $c }}
                                    @if( old('information') == $information->id)
                                        selected
                                    @endif
                                    >
                                    {{ $c }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3"> {{ __('translations.currency').':' }} </label>
                        <div class="col-sm-9">
                            <select class="form-control" name="category">
                                @foreach($categories as $c)
                                    <option value={{ $c }}
                                    @if( old('information') == $information->id)
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

                    <div class="form-group row mb-0">
                        <div class="col-sm-6 offset-sm-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('translations.save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/subscriptions.js') }}" ></script>
@endsection
