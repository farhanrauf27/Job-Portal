@extends('layouts.header')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="text-white fw-bold">Apply for Job</h2>
        </div>
        <div class="card-body p-5">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($hasApplied)
                <div class="alert alert-info text-center p-4">
                    <p class="mb-0 fw-bold">You have already submitted an application for this job.</p>
                </div>
            @else
                <form action="{{ route('job.store', $id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-4">
                        <label for="cv" class="form-label fw-bold text-primary">Upload Your CV:</label>
                        <div class="custom-file-upload">
                            <input 
                                type="file" 
                                class="form-control-file" 
                                id="cv" 
                                name="cv" 
                                accept=".pdf,.doc,.docx" 
                                required>
                            <label for="cv" class="custom-label">
                                <i class="fas fa-upload"></i> Choose File
                            </label>
                        </div>
                        <div class="invalid-feedback">Please upload your CV in PDF, DOC, or DOCX format.</div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg px-5">Submit Application</button>
                    </div>
                </form>
            @endif
        </div>
        <div class="card-footer text-center bg-light">
            <small class="text-muted">Ensure your CV is in PDF, DOC, or DOCX format and less than 2MB.</small>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    body {
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-size: 18px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
        font-size: 16px;
    }

    .card-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card-footer {
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
    /* Custom file upload container */
.custom-file-upload {
    position: relative;
    width: 100%;
}

.custom-file-upload input[type="file"] {
    display: none; /* Hide the default file input */
}

/* Style for the custom file upload label */
.custom-label {
    display: inline-block;
    padding: 12px 25px;
    background-color: #007bff;
    color: white;
    border-radius: 30px;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
    text-align: center;
    margin-top: 10px;
}

.custom-label:hover {
    background-color: #0056b3;
}

.custom-label i {
    margin-right: 8px;
}

/* Styling for invalid feedback */
.invalid-feedback {
    display: block;
    font-size: 0.875rem;
    color: #dc3545;
    margin-top: 5px;
    font-weight: 500;
}

/* Success and error feedback transition */
.form-control-file:valid ~ .invalid-feedback {
    display: none;
}

.form-control-file:invalid ~ .invalid-feedback {
    display: block;
}

/* Styling the input field when the file is chosen */
input[type="file"]:valid {
    border: 2px solid #28a745;
}

input[type="file"]:invalid {
    border: 2px solid #dc3545;
}

/* Focus Effect */
input[type="file"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
}

/* Label on file selection */
input[type="file"]:valid + .custom-label {
    background-color: #28a745;
    color: white;
}

input[type="file"]:valid + .custom-label:hover {
    background-color: #218838;
}

</style>

<!-- Add Bootstrap Validation Script -->
<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
    })();
</script>
@endsection
