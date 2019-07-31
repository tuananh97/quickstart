@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('translate.register') }}</div>

                <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'route' => 'register']) !!}
                        <div class="form-group row">
                            {!! Form::label('name', trans('translate.name'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}

                            <div class="col-md-6">
                                {!! Form::text('name', old('email'), [
                                    'class' => 'form-control '. ($errors->has('name') ? 'is-invalid':''),
                                    'id' => 'name',
                                    'required' => 'required',
                                    'autocomplete' => 'name',
                                    'autofocus',
                                    ]) !!}

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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
                                    'autocomplete' => 'new-password',
                                    ]) !!}

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('password-confirm', trans('translate.ComfirmPass'), ['class' => 'col-md-4 col-form-label text-md-right']) !!}

                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', [
                                    'class' => 'form-control',
                                    'id' => 'password-confirm',
                                    'required' => 'required',
                                    'autocomplete' => 'new-password',
                                    ]) !!}
                            </div>
                            @if ($errors->has('password-confirm'))
                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password-confirm') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {!! Form::submit(trans('translate.register'), ['class' => 'btn btn-primary',]) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
