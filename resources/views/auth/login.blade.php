@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('translate.login') }}</div>

                <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'route' => 'login']) !!}
                        <div class="form-group row">
                            {!! Form::label('email', trans('translate.Email'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}

                            <div class="col-md-6">
                                {!! Form::email('email', old('email'), [
                                    'class' => 'form-control '. ($errors->has('email') ? 'is-invalid':''),
                                    'id' => 'email',
                                    'required' => 'required',
                                    'autocomplete' => 'email',
                                    'autofocus',
                                    ]) !!}
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('password', trans('translate.Password'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}

                            <div class="col-md-6">
                                {!! Form::password('password', [
                                    'class' => 'form-control '. ($errors->has('password') ? 'is-invalid':''),
                                    'id' => 'password',
                                    'required' => 'required',
                                    'autocomplete' => 'current-password',
                                    ]) !!}

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    {!! Form::checkbox('remember', '', [
                                        'class' => 'form-check-input',
                                        'id' => 'remember',
                                        'checked' => old('remember') ? 'checked' : '',
                                        ]) !!}

                                    {!! Form::label('remember', trans('translate.Remember'), ['class' => 'form-check-label']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {!! Form::submit(trans('translate.login'), ['class' => 'btn btn-primary',]) !!}

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ trans('translate.forgetPass') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
