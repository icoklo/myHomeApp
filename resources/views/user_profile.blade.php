@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('translations.profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', ['id' => $user->id ]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <div class="form-group label-floating {{ ($errors->has('email')) ? 'has-error' : '' }}">
                                <label class="control-label"> {{ __('auth.email') }} </label>
                                <input type="email" name="email"
                                @if( isset($user) )
                                    value="{{ $user->email }}"
                                @else
                                    value="{{ old('email') }}"
                                @endif
                                class="form-control">
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                            <div class="form-group label-floating {{ ($errors->has('password')) ? 'has-error' : '' }}">
                                <label class="control-label">{{ __('auth.password') }}</label>
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <div class="form-group label-floating {{ ($errors->has('password')) ? 'has-error' : '' }}">
                                <label class="control-label">{{ __('auth.confirm_password') }}</label>
                                <input type="password" name="password_confirmation"
                                value="{{ old('password_confirmation') }}" class="form-control">
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                            <div class="form-group label-floating {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
                                <label class="control-label"> {{ __('auth.name') }} </label>
                                <input type="text" name="name" class="form-control"
                                @if( isset($user) )
                                    value="{{ $user->name }}"
                                @else
                                    value="{{ old('name') }}"
                                @endif
                                >
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <div class="form-group label-floating {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
                                <label class="control-label"> {{ __('auth.phone') }} </label>
                                <input type="text" name="phone" class="form-control"
                                @if( isset($user) )
                                    value="{{ $user->phone }}"
                                @else
                                    value="{{ old('phone') }}"
                                @endif
                                >
                            </div>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                            <div class="form-group label-floating {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
                                <label class="control-label"> {{ __('auth.birthday') }} </label>
                                <input type="date" name="birthday" class="form-control"
                                @if( isset($user) )
                                    value="{{ $user->birthday }}"
                                @else
                                    value="{{ old('birthday') }}"
                                @endif
                                >
                            </div>
                            @if ($errors->has('birthday'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                            @endif
                            <div class="form-group">
                                <label for="icon">{{ __('users.icon') }}</label>
                                <input type="file" name="icon">
                            </div>
                            @if( isset($user) AND isset($user->icon) )
                                <img src="{{ asset('storage/'.$user->icon) }}" alt="icon">
                            @endif
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('translations.save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
