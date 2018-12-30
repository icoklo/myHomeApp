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
                    <div>
                        <a href="" class="btn btn-secondary">
                            {{ trans('translations.bookmarks') }}
                        </a>
                        <a href="" class="btn btn-secondary">
                            {{ trans('translations.subscriptions') }}
                        </a>
                        <a href="{{ route('users.edit', ['id' => auth()->user()->id ]) }}" class="btn btn-secondary" style="float:right;">
                            {{ trans('translations.profile') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
