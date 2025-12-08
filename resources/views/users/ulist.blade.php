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
<<<<<<< HEAD
                                    @if(auth()->user()->role == "Administrator")
                                    <option value="Administrator" {{ old('Role', isset($uEdit) ? $uEdit->role : '') == 'Administrator' ? 'selected' : '' }}>
                                        Administrator
                                    </option>
                                    @endif
=======
                                    <option value="Administrator" {{ old('Role', isset($uEdit) ? $uEdit->role : '') == 'Administrator' ? 'selected' : '' }}>
                                        Administrator
                                    </option>
>>>>>>> 777a96406e44bbe39a6a431482101893bcfb77c3
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
<<<<<<< HEAD
                                    <th class="text-center">No</th>
=======
                                    <th>No</th>
>>>>>>> 777a96406e44bbe39a6a431482101893bcfb77c3
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
<<<<<<< HEAD
                                    <th>Status</th>
                                    <th width="150">Action</th>
=======
                                    <th width="100">Action</th>
>>>>>>> 777a96406e44bbe39a6a431482101893bcfb77c3
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $user)
                                <tr id="user-row-{{ $user->id }}">
<<<<<<< HEAD
                                    <td width="50" class="text-center">{{ $loop->iteration }}</td>
=======
                                    <td>{{ $loop->iteration }}</td>
>>>>>>> 777a96406e44bbe39a6a431482101893bcfb77c3
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
<<<<<<< HEAD
                                        @if($user->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Deactivated</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <!-- Toggle Status Button -->
                                        <button type="button" 
                                                class="btn btn-xs {{ $user->status == '1' ? 'btn-secondary' : 'btn-success' }} open-status-modal" 
                                                data-id="{{ $user->id }}" 
                                                data-status="{{ $user->status }}">
                                            {{ $user->status == '1' ? 'Deactivate' : 'Activate' }}
                                        </button>

                                        <!-- Edit & Delete Buttons -->
=======
>>>>>>> 777a96406e44bbe39a6a431482101893bcfb77c3
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
<<<<<<< HEAD
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change User Status</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p id="statusModalText">Are you sure you want to change this user's status?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" id="confirmStatusChange">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Delete Confirmation Script -->
@section('scripts')
<script>
    let selectedUserId;

    // Open Modal
    $(document).on('click', '.open-status-modal', function() {
        selectedUserId = $(this).data('id');
        let status = $(this).data('status');

        // Update modal text based on current status
        let text = status == 1 
            ? "Are you sure you want to deactivate this account?"
            : "Are you sure you want to activate this account?";
        $('#statusModalText').text(text);

        $('#statusModal').modal('show');
    });

    // Confirm Status Change
    $('#confirmStatusChange').on('click', function() {
        $.ajax({
            url: '{{ url("users/toggle-status") }}/' + selectedUserId,
            method: 'PATCH',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                let badge = $('#user-row-' + selectedUserId + ' td:nth-child(7) .badge'); // Status badge
                let btn = $('#user-row-' + selectedUserId + ' .open-status-modal');

                if(response.status == 1){
                    badge.removeClass('badge-danger').addClass('badge-success').text('Active');
                    btn.removeClass('btn-success').addClass('btn-secondary').text('Deactivate');
                    btn.data('status', 1);
                } else {
                    badge.removeClass('badge-success').addClass('badge-danger').text('Deactivated');
                    btn.removeClass('btn-secondary').addClass('btn-success').text('Activate');
                    btn.data('status', 0);
                }

                toastr.success('User status updated successfully.');
                $('#statusModal').modal('hide');
            },
            error: function() {
                toastr.error('Failed to update status.');
=======

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
>>>>>>> 777a96406e44bbe39a6a431482101893bcfb77c3
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