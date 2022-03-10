@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"><div class="card">
                <div class="card">
                    <div class="card-header">{{ __('Buy Cookies') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('buy.cookies') }}" novalidate>
                            @csrf

                            <div class="row mb-3">
                                <label for="cookies" class="col-md-4 col-form-label text-md-end">{{ __('Cookies Number') }}</label>

                                <div class="col-md-6">
                                    <input id="cookies" type="number" class="form-control @error('cookies') is-invalid @enderror" name="cookies" value="{{ old('cookies') }}" min="1" step="1" required autofocus>

                                    @error('cookies')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Buy Cookies') }}
                                    </button>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    @if($errors->has('message'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first() }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
