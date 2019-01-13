@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('translations.show_subscriptions') }}</div>

            <div class="card-body">
                <div class="form-group row mb-0">
                    <div class="col-sm-6 offset-sm-4" style="margin-bottom: 20px">
                        <a href="{{ route('subscriptions.create') }}" class="btn btn-primary" style="float:right">
                            {{ __('translations.add_new') }}
                        </a>
                    </div>
                </div>

                <div class="form-group">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('translations.ordinal_number') }}</th>
                                <th scope="col">{{ __('translations.name') }}</th>
                                <th scope="col">{{ __('translations.poll_interval') }}</th>
                                <th scope="col" colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscriptions as $subscription)
                                <tr>
                                    <td> {{ $subscription->ordinalNumber }}</td>
                                    <td> {{ $subscription->name }} </td>
                                    <td> {{ $subscription->poll_interval_human }} </td>
                                    <td>
                                        <a href="{{ route('subscriptions.edit', ['id' => $subscription->id]) }}">
                                            {{ __('translations.edit') }}
                                        </a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('subscriptions.destroy', ['id' => $subscription->id]) }}">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-link">{{ __('translations.delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
