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
                                    <option value={{ $information->id }}>
                                        {{ $information->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @include('subscription.form.create_edit')
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/subscriptions.js') }}" ></script>
@endsection
