@extends('layouts.app')

<style>
.card-body div
{
    margin-bottom: 40px;
}
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ trans('translations.home_page') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (!empty($message))
                            <div class="alert alert-success" role="alert">
                                {{ $message }}
                            </div>
                        @endif
                        <div class="col-sm-12">
                            <a href="{{ route('bookmarks.index') }}" class="btn btn-secondary">
                                {{ trans('translations.bookmarks') }}
                            </a>
                            <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">
                                {{ trans('translations.subscriptions') }}
                            </a>
                            <a href="{{ route('users.edit', ['id' => auth()->user()->id ]) }}" class="btn btn-secondary" style="float:right;">
                                {{ trans('translations.profile') }}
                            </a>
                        </div>

                        <div class="offset-sm-3">
                            @foreach($bookmarks as $bookmark)
                                <a href="{{$bookmark->url}}" target="_blank">
                                    <img src={{ asset('storage/'.$bookmark->icon) }} alt="{{$bookmark->name}}" title="{{$bookmark->name}}" style="width:20%;"/>
                                </a>
                            @endforeach
                        </div>

                        <div id="subscriptions" class="">
                            @foreach($subscriptions as $subscription)
                                <div class="form-group row">
                                    <label class="col-sm-2"> {{ $subscription->name.':' }} </label>

                                    <div class="col-sm-10" id="{{ str_slug($subscription->name, '_') }}"
                                        data-interval="{{ $subscription->pivot->poll_interval_2 }}"
                                        @if($subscription->name == 'Vrijeme')
                                            data-city="{{ $city }}"
                                        @endif
                                        >

                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/home.js') }}" ></script>
@endsection
