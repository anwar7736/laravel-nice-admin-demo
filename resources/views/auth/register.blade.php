@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="designation" class="col-md-4 col-form-label text-md-end">{{ __('Designation') }}</label>

                            <div class="col-md-6">
                                <input id="designation" value="{{old('designation')}}" type="text" class="form-control" name="designation">
                            </div>
                        </div>  
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" value="{{old('phone')}}" class="form-control @error('password') is-invalid @enderror" name="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="company" class="col-md-4 col-form-label text-md-end">{{ __('Company') }}</label>
                            <div class="col-md-6">
                               <input type="text" value="{{old('company')}}" name="company" id="company" class="form-control">
                            </div>
                        </div> 
                         <div class="row mb-3">
                            <label for="country" class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>
                            <div class="col-md-6">
                               <input type="text" value="{{old('country')}}" name="country" id="country" class="form-control">
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                            <div class="col-md-6">
                               <textarea name="address" value="{{old('address')}}"  id="address" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="short_description" class="col-md-4 col-form-label text-md-end">{{ __('Short Description') }}</label>
                            <div class="col-md-6">
                               <textarea name="short_description" value="{{old('short_description')}}"  id="short_description" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="profile_pic" class="col-md-4 col-form-label text-md-end">{{ __('Profile Picture') }}</label>

                            <div class="col-md-6">
                                <input id="profile_pic" type="file" class="form-control @error('password') is-invalid @enderror" name="photo">

                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="twitter_link"  class="col-md-4 col-form-label text-md-end">{{ __('Twitter Link') }}</label>
                            <div class="col-md-6">
                               <input type="text" value="{{old('twitter_link')}}" name="twitter_link" id="twitter_link" class="form-control">
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <label for="facebook_link" class="col-md-4 col-form-label text-md-end">{{ __('Facebook Link') }}</label>
                            <div class="col-md-6">
                               <input type="text" value="{{old('facebook_link')}}" name="facebook_link" id="facebook_link" class="form-control">
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <label for="instagram_link" class="col-md-4 col-form-label text-md-end">{{ __('Instagram Link') }}</label>
                            <div class="col-md-6">
                               <input type="text" value="{{old('instagram_link')}}" name="instagram_link" id="instagram_link" class="form-control">
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <label for="linkedin_link" class="col-md-4 col-form-label text-md-end">{{ __('Linkedin Link') }}</label>
                            <div class="col-md-6">
                               <input type="text" value="{{old('linkedin_link')}}" name="linkedin_link" id="linkedin_link" class="form-control">
                            </div>
                        </div> 
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
