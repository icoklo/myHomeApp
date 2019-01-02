@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="min-width: 60%;">
                <div class="card-header">{{ __('translations.create_bookmark') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('bookmarks.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        @include('bookmark.form.create_edit')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
