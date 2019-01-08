@extends('layouts.app')

<style>
td {
    vertical-align: middle;
}
</style>
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('translations.show_subscriptions') }}</div>

            <div class="card-body">
                <div class="form-group row mb-0">
                    <div class="col-sm-6 offset-sm-4">
                        <a href="{{ route('subscriptions.create') }}" class="btn btn-primary">
                            {{ __('translations.add_new') }}
                        </a>
                    </div>
                </div>

                <div class="form-group">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('translations.name') }}</th>
                                <th scope="col">{{ __('translations.description') }}</th>
                                <th scope="col" colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($bookmarks as $bookmark)
                                <tr>
                                    <td> {{ $bookmark->id }} </td>
                                    <td> {{ $bookmark->name }} </td>
                                    <td> {{ $bookmark->description }} </td>
                                    <td>
                                        <a href="{{ route('bookmarks.edit', ['id' => $bookmark->id]) }}">
                                            {{ __('translations.edit') }}
                                        </a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('bookmarks.destroy', ['id' => $bookmark->id]) }}">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-link">{{ __('translations.delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
