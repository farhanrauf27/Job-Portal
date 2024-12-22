@extends('layouts.companyNav')

@section('content')
    <div class="container">
        <h2>Edit Company Profile</h2>

        <!-- Display any success or error messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Company Profile Edit Form -->
        <form action="{{ route('company.updateProfile', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Company Name -->
            <div class="form-group mt-3">
                <label for="company_name"><i class="fas fa-building"></i> Company Name</label>
                <input type="text" class="form-control" name="company_name" id="company_name" value="{{ old('company_name', $company->company_name) }}" required>
                @error('company_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Logo Field -->
            <div class="form-group mt-3">
                <label for="logo"><i class="fas fa-image"></i> Company Logo</label>
                <input type="file" class="form-control" name="logo" id="logo">
                
                @error('logo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
                @if($company->logo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/logos/' . $company->logo) }}" alt="Company Logo" width="100">
                    </div>
                @endif
            </div>

            <!-- Company Description -->
            <div class="form-group mt-3">
                <label for="company_info"><i class="fas fa-info-circle"></i> Company Description</label>
                <textarea class="form-control" name="company_info" id="company_info" rows="4">{{ old('company_info', $company->company_info) }}</textarea>
                @error('company_info')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contact Email -->
            <div class="form-group mt-3">
                <label for="email"><i class="fas fa-envelope"></i> Contact Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $company->email) }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contact Number -->
            <div class="form-group mt-3">
                <label for="phone_number"><i class="fas fa-phone"></i> Contact Number</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number', $company->phone_number) }}">
                @error('phone_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Website URL -->
            <div class="form-group mt-3">
                <label for="web_link"><i class="fas fa-globe"></i> Website URL</label>
                <input type="url" class="form-control" name="web_link" id="web_link" value="{{ old('web_link', $company->web_link) }}">
                @error('web_link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Address -->
            <div class="form-group mt-3">
                <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $company->address) }}">
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="special-button-blue"><i class="fas fa-save me-2"></i> Update Profile</button>
        </form>
    </div>
@endsection
