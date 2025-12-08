@extends('layouts.master')

@section('body')
<div class="container mt-1">
    <div class="row">

        <!-- LEFT: Profile Card -->
        <div class="col-lg-4 mt-4 mb-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">

                    <!-- Profile Image Preview -->
                    <img id="profilePreview"
                         src="{{ asset('Uploads/profile/'.auth()->user()->profile) }}"
                         class="img-fluid rounded-circle mb-3 shadow"
                         style="width:150px; height:150px; object-fit:cover;">

                    <h5 class="fw-bold mb-1">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</h5>
                    <p class="text-muted">{{ auth()->user()->role }}</p>

                    <hr>

                    <p class="text-muted small">Last updated:
                        <strong>{{ auth()->user()->updated_at->format('M d, Y') }}</strong>
                    </p>

                </div>
            </div>
        </div>

        <!-- RIGHT: Form -->
        <div class="col-lg-8 mt-4 mb-4">
            <div class="card shadow-sm border-0 rounded-3">

                <div class="card-header bg-primary text-white rounded-top">
                    <h5 class="mb-0">Account Settings</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <!-- Last Name -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="LastName" class="form-control text-uppercase"
                                           value="{{ old('LastName', auth()->user()->lname) }}" required>
                                </div>
                            </div>

                            <!-- First Name -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">First Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="FirstName" class="form-control text-uppercase"
                                           value="{{ old('FirstName', auth()->user()->fname) }}" required>
                                </div>
                            </div>

                            <!-- Middle Name -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Middle Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="MiddleName" class="form-control text-uppercase"
                                           value="{{ old('MiddleName', auth()->user()->mname) }}">
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" name="Username" class="form-control"
                                           value="{{ old('Username', auth()->user()->username) }}" required>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">New Password <small class="text-muted">(optional)</small></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="Password" class="form-control" placeholder="••••••••">
                                </div>
                            </div>

                            <!-- Profile Upload -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Profile Image</label>
                                <input type="file" name="Profile" accept="image/*" id="ProfileInput" class="form-control">
                                <small class="text-muted">Recommended: PNG/JPG (150x150)</small>
                            </div>

                        </div>

                        <button class="btn btn-success px-4 py-2 mt-3 float-end">
                            <i class="fas fa-save"></i> Save Changes
                        </button>

                    </form>

                </div>
            </div>
        </div>

    </div>

</div>

<!-- JS: On-change image preview -->
<script>
document.getElementById('ProfileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('profilePreview').src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
});
</script>

@endsection
