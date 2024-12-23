@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded">
            <div class="card-header bg-primary text-white text-center">
                <h2>Company Login</h2>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('company.login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Enter your password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <small>Don’t have an account? <a href="{{ route('company.register') }}" class="text-primary">Register here</a></small>
            </div>
        </div>
    </div>
</div>

<!-- Optional Custom CSS -->

@endsection
