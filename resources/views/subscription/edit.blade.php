@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="min-width: 60%;">
                <div class="card-header">{{ __('translations.edit_subscription') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('subscriptions.update', ['id' => $userInformation->information_id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group row">
                            <label class="col-sm-3"> {{ __('translations.information').':' }} </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="information" disabled>
                                    @foreach($informations as $information)
                                        <option value={{ $information->id }}
                                            @if(isset($userInformation) AND $userInformation->information_id == $information->id)
                                                selected
                                            @endif
                                            >
                                            {{ $information->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="information" value="{{ $userInformation->information_id }}">

                        @include('subscription.form.create_edit')
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('js/subscriptions.js') }}" ></script>
@endsection
