@extends('layouts.app')

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

                        <div class="">
                            @foreach($bookmarks as $bookmark)
                                <a href="{{$bookmark->url}}" target="_blank">
                                    <img src={{ asset('storage/'.$bookmark->icon) }} alt="{{$bookmark->name}}" title="{{$bookmark->name}}" style="width:20%;"/>
                                </a>
                            @endforeach
                        </div>

                        <div id="subscriptions" class="">
                            @foreach($subscriptions as $subscription)
                                <div id="{{ $subscription->name }}">
                                    <p> {{ $subscription->name.':' }}
                                        <span id="{{ $subscription->name }}" data-interval="{{ $subscription->getOriginal('poll_interval') }}">

                                        </span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(){

        refreshWeather();
        refreshDate();
        function refreshWeather()
        {
            var interval = $('span#Vrijeme').data('interval');

            setInterval(function() {
                var weather = ['Suncano', 'Oblacno', 'Pada snijeg'];
                $('span#Vrijeme').html(weather[Math.floor(Math.random() * weather.length)]);
            }, interval * 1000);
        }

        function refreshDate()
        {
            var interval = $('span#Datum').data('interval');
            setInterval(function() {
                $('span#Datum').html(Math.floor(Math.random() * 10));
            }, interval * 1000);
        }
    });
    </script>
@endsection
