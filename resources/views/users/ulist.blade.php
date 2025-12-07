@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row">

        <!-- Left Column: Form (Add / Edit) -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus"></i>
                        {{ isset($uEdit) ? 'Edit User' : 'Add New User' }}
                    </h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('users.save') }}" method="POST">
                        @csrf

                        <!-- Hidden ID for update -->
                        @if(isset($uEdit))
                            <input type="hidden" name="id" value="{{ $uEdit->id }}">
                        @endif

                        <!-- Last Name -->
                        <div class="form-group">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="LastName" class="form-control text-uppercase"
                                       value="{{ old('LastName', isset($uEdit) ? $uEdit->lname : '') }}"
                                       placeholder="Enter Last Name" autocomplete="off" required>
                            </div>
                            @error('LastName')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- First Name -->
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="FirstName" class="form-control text-uppercase"
                                       value="{{ old('FirstName', isset($uEdit) ? $uEdit->fname : '') }}"
                                       placeholder="Enter First Name" autocomplete="off" required>
                            </div>
                            @error('FirstName')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Middle Name -->
                        <div class="form-group">
                            <label>Middle Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="MiddleName" class="form-control text-uppercase"
                                       value="{{ old('MiddleName', isset($uEdit) ? $uEdit->mname : '') }}"
                                       placeholder="Enter Middle Name" autocomplete="off" required>
                            </div>
                            @error('MiddleName')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="form-group">
                            <label>Role <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                </div>
                                <select name="Role" class="form-control" required>
                                    <option value="">-- Select Role --</option>
                                    <option value="Administrator" {{ old('Role', isset($uEdit) ? $uEdit->role : '') == 'Administrator' ? 'selected' : '' }}>
                                        Administrator
                                    </option>
                                    <option value="Principal" {{ old('Role', isset($uEdit) ? $uEdit->role : '') == 'Principal' ? 'selected' : '' }}>
                                        Principal
                                    </option>
                                    <option value="Teacher" {{ old('Role', isset($uEdit) ? $uEdit->role : '') == 'Teacher' ? 'selected' : '' }}>
                                        Teacher
                                    </option>
                                </select>
                            </div>
                            @error('Role')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="form-group">
                            <label>Username <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="Username" class="form-control"
                                       value="{{ old('Username', isset($uEdit) ? $uEdit->username : '') }}"
                                       placeholder="Enter Username" autocomplete="off" required>
                            </div>
                            @error('Username')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label>
                                Password 
                                @if(!isset($uEdit))
                                    <span class="text-danger">*</span>
                                @else
                                    <small class="text-muted">(Leave blank to keep current)</small>
                                @endif
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="Password" class="form-control"autocomplete="new-password"
                                       {{ !isset($uEdit) ? 'required' : '' }}>
                            </div>
                            @error('Password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-save"></i>
                                {{ isset($uEdit) ? 'Update User' : 'Save User' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Users Table -->
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users"></i> Users List
                    </h3>
                    @if(isset($uEdit))
                    <div class="card-tools">
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Add New User
                        </a>
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $user)
                                <tr id="user-row-{{ $user->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->lname }}</td>
                                    <td>{{ $user->fname }}</td>
                                    <td>{{ $user->mname }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <span class="badge badge-{{ $user->role == 'Administrator' ? 'danger' : ($user->role == 'Principal' ? 'warning' : 'info') }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-xs" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-xs delete-user" data-id="{{ $user->id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No users found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Script -->
@section('scripts')
<script>
    // Handle both Create & Update via AJAX (same form, same route)
    $('form[action="{{ route('users.save') }}"]').on('submit', function(e) {
        e.preventDefault();

        let form = $(this);
        let submitButton = form.find('button[type="submit"]');
        let originalText = submitButton.html();

        // Disable button & show loading
        submitButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

        // Clear previous errors
        $('.text-danger.small').text('');

        $.ajax({
            url: '{{ route('users.save') }}',
            method: 'POST',
            data: form.serialize(), // Simple serialize is enough (no file upload)
            success: function(response) {
                // Success from controller redirect with session('success')
                toastr.success(
                    form.find('input[name="id"]').val()
                        ? 'User updated successfully!'
                        : 'User created successfully!'
                );

                // Reload the page to refresh the list (simple & reliable)
                setTimeout(() => location.reload(), 1200);
            },
            error: function(xhr) {
                if (xhr.status === 422) { // Laravel validation error
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function(field, messages) {
                        // Match field name to error span
                        let errorElement = $('[name="' + field + '"]').closest('.form-group').find('.text-danger.small');
                        if (errorElement.length === 0) {
                            errorElement = form.find('.text-danger.small').first();
                        }
                        errorElement.text(messages[0]);
                    });

                    toastr.error('Please fix the errors below.');
                } else {
                    toastr.error('Something went wrong. Please try again.');
                }
            },
            complete: function() {
                // Re-enable button
                submitButton.prop('disabled', false).html(originalText);
            }
        });
    });

    // Delete User with SweetAlert2 + AJAX (proper DELETE method)
    $(document).on('click', '.delete-user', function() {
        let userId = $(this).data('id');
        let row = $('#user-row-' + userId);

        Swal.fire({
            title: 'Delete User?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url("users/delete") }}/' + userId,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        row.fadeOut(400, function() { $(this).remove(); });

                        Swal.fire({
                            title: 'Deleted!',
                            text: 'User has been removed.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        toastr.success('User deleted successfully');
                    },
                    error: function() {
                        toastr.error('Failed to delete user.');
                    }
                });
            }
        });
    });
</script>
@endsection
@endsection