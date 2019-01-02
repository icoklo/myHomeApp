@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="min-width: 60%;">
                <div class="card-header">{{ __('translations.profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', ['id' => $user->id ]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <div class="form-group row label-floating {{ ($errors->has('email')) ? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label"> {{ __('translations.email') }} </label>
                                <div class="col-sm-9">
                                    <input type="email" name="email"
                                    @if( isset($user) )
                                        value="{{ $user->email }}"
                                    @else
                                        value="{{ old('email') }}"
                                    @endif
                                    class="form-control">
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                            <div class="form-group row label-floating {{ ($errors->has('password')) ? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">{{ __('translations.new_password') }}</label>
                                <div class="col-sm-9">
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                            </div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <div class="form-group row label-floating {{ ($errors->has('password')) ? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label">{{ __('translations.confirm_password') }}</label>
                                <div class="col-sm-9">
                                <input type="password" name="password_confirmation"
                                value="{{ old('password_confirmation') }}" class="form-control">
                            </div>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                            <div class="form-group row label-floating {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label"> {{ __('translations.user_name') }} </label>
                                <div class="col-sm-9">
                                <input type="text" name="name" class="form-control"
                                @if( isset($user) )
                                    value="{{ $user->name }}"
                                @else
                                    value="{{ old('name') }}"
                                @endif
                                >
                            </div>
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <div class="form-group row label-floating {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label"> {{ __('translations.phone') }} </label>
                                <div class="col-sm-9">
                                <input type="text" name="phone" class="form-control"
                                @if( isset($user) )
                                    value="{{ $user->phone }}"
                                @else
                                    value="{{ old('phone') }}"
                                @endif
                                >
                            </div>
                            </div>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                            <div class="form-group row label-floating {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
                                <label class="col-sm-3 control-label"> {{ __('translations.birthday') }} </label>
                                <div class="col-sm-9">
                                <input type="date" name="birthday" class="form-control"
                                @if( isset($user) )
                                    value="{{ $user->birthday }}"
                                @else
                                    value="{{ old('birthday') }}"
                                @endif
                                >
                                </div>
                            </div>
                            @if ($errors->has('birthday'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                            @endif
                            <div class="form-group row">
                                <label class="col-sm-3" for="icon">{{ __('translations.icon') }}</label>
                                <div class="col-sm-9">
                                <input type="file" name="icon">
                            </div>
                            </div>
                            @if( isset($user) AND isset($user->icon) )
                                <div class="form-group offset-sm-3">
                                    <img src="{{ asset('storage/'.$user->icon) }}" alt="icon">
                                </div>
                            @endif
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-3">
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
