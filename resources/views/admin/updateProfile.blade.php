@extends('layouts.adminNav')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 text-primary">Update Profile</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card mb-4 shadow-lg rounded border-0">
        <div class="card-body bg-white">

            <!-- Profile Information Title -->
            <h4 class="card-title text-center text-secondary mb-4">Profile Information</h4>

            <!-- Profile Update Form -->
            <form action="{{ route('admin.updateProfile') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Full Name Input -->
                <div class="form-group mb-4">
                    <label for="name" class="form-label text-dark font-weight-bold">Full Name</label>
                    <input type="text" class="form-control form-control-lg shadow-sm" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="form-group mb-4">
                    <label for="email" class="form-label text-dark font-weight-bold">Email Address</label>
                    <input type="email" class="form-control form-control-lg shadow-sm" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="form-group mb-4">
                    <label for="password" class="form-label text-dark font-weight-bold">New Password (Leave blank to keep unchanged)</label>
                    <input type="password" class="form-control form-control-lg shadow-sm" id="password" name="password">
                    @error('password')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password Input -->
                <div class="form-group mb-4">
                    <label for="password_confirmation" class="form-label text-dark font-weight-bold">Confirm Password</label>
                    <input type="password" class="form-control form-control-lg shadow-sm" id="password_confirmation" name="password_confirmation">
                </div>

                <!-- Submit Button -->
                <div class="form-group mb-4">
                    <button type="submit" class="btn btn-primary btn-lg w-100 py-2 rounded-pill shadow-sm">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Custom CSS for extra style -->
@section('styles')
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 40px;
        }

        .form-control-lg {
            font-size: 1.1rem;
            border-radius: 8px;
        }

        .btn {
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0069d9;
        }

        .form-group label {
            font-weight: 600;
        }

        .alert {
            font-size: 1.1rem;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .card-title {
            font-size: 1.5rem;
        }
    </style>
@endsection

@endsection
