@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="min-width: 60%;">
                <div class="card-header">{{ __('translations.edit_bookmark') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('subscriptions.update', ['id' => $userInformation->information_id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}

                        @include('subscription.form.create_edit')
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('js/subscriptions.js') }}" ></script>
@endsection
