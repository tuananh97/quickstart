@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('validation.verifyEmail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ trans('validation.sentEmailVerify') }}
                        </div>
                    @endif

                    {{ trans('validation.checkEmailVerify') }}
                    {{ trans('validation.errorEmail') }}, <a href="{{ route('verification.resend') }}">{{ trans('validation.checkLinkEmail') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
