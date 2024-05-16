@extends('layout.app')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <form class="" action="{{ route('auth.login.post') }}" method="POST" autocomplete="off">@csrf
    <div class="card"  style="width: 400px;">
        <div class="card-header text-center">
            Login
        </div>
        <div class="card-body" id="imagesave">
            @if (session()->has('msg'))
                <div class="alert alert-{{ session()->get('action') ?? 'success' }}" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> {{ session()->get('msg') }}
                </div>
            @endif
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" aria-describedby="" name="username">
                  @error('username')
                    <small class="form-text text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                  @error('password')
                    <small class="form-text text-danger">{{ $message }}</small>
                  @enderror
                </div>
            </div>
            <div class="card-footer  p-1">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </div>
    </form>
</div>

@endsection
