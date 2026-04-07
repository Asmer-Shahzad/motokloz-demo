@extends('layouts.app')

@section('content')

    <div class="container my-5">

        <!-- breadcrumbs -->
        @include('partials.user-account-breadcrumbs')
        
        <div class="row">
            <div class="col-lg-3 page-title">
                <h1>My Profile</h1>
            </div>
        </div>
        
        <div class="row">
            @include('partials.user-account-sidebar')

            <div class="col-lg-9">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Update Profile Form -->
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-card shadow-sm">
                        <div class="agent-head">
                            <h5 class="mb-4 border-bottom agend-headd">Update your profile</h5>
                        </div>

                        <div class="d-flex align-items-center m-4 gap-3">
                            <img src="{{ $userInfo->avatar ?? asset('/assets/images/Travilla.png') }}" 
                                class="rounded" alt="Avatar" width="60" height="60" id="avatarPreview">
                            <button type="button" class="btn btn-outline-danger btn-sm" id="deleteAvatarBtn">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button type="button" class="btn-orange shadow-sm" id="changeAvatarBtn">
                                Change avatar
                            </button>
                        </div>

                        <!-- Hidden file input -->
                        <input type="file" id="avatarInput" style="display: none" accept="image/*" />

                        <div class="row g-3 settng-all">
                            <div class="col-md-6">
                                <label>Full Name *</label>
                                <input type="text" name="full_name" class="form-control" 
                                    value="{{ old('full_name', $userInfo->full_name ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label>Email *</label>
                                <input type="email" class="form-control" 
                                    value="{{ $user->email }}" readonly disabled>
                            </div>
                            <div class="col-md-6">
                                <label>Contact number *</label>
                                <input type="text" name="contact_number" class="form-control" 
                                    value="{{ old('contact_number', $userInfo->contact_number ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label>Personal website</label>
                                <input type="text" name="personal_website" class="form-control" 
                                    value="{{ old('personal_website', $userInfo->personal_website ?? '') }}">
                            </div>
                            <div class="col-12">
                                <label>Bio</label>
                                <textarea name="bio" class="form-control" rows="4">{{ old('bio', $userInfo->bio ?? '') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Languages</label>
                                <input type="text" name="languages" class="form-control" 
                                    value="{{ old('languages', $userInfo->languages ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label>Nationality</label>
                                <input type="text" name="nationality" class="form-control" 
                                    value="{{ old('nationality', $userInfo->nationality ?? '') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn-orange mt-4 setting-btt">Save Changes</button>
                    </div>
                </form>

                <!-- Contact Information Form -->
                <form action="{{ route('profile.contact.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-card shadow-sm">
                        <div class="agent-head">
                            <h5 class="mb-4 border-bottom agend-headd">Contact Information</h5>
                        </div>

                        <div class="row g-3 settng-all">
                            <div class="col-md-6">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control" 
                                    value="{{ old('country', $userInfo->country ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" 
                                    value="{{ old('city', $userInfo->city ?? '') }}">
                            </div>
                            <div class="col-12">
                                <label>Complete Address</label>
                                <input type="text" name="complete_address" class="form-control" 
                                    value="{{ old('complete_address', $userInfo->complete_address ?? '') }}">
                            </div>
                            <div class="col-12">
                                <label>Find On Map</label>
                                <input type="text" name="find_on_map" class="form-control" 
                                    value="{{ old('find_on_map', $userInfo->find_on_map ?? '') }}">
                            </div>
                            <div class="col-12">
                                <label>Postal Code</label>
                                <input type="text" name="postalCode" class="form-control" 
                                    value="{{ old('postalCode', $userInfo->postalCode ?? '') }}">
                            </div>
                            <!-- <div class="col-md-4">
                                <label>Latitude</label>
                                <input type="text" name="latitude" class="form-control" 
                                    value="{{ old('latitude', $userInfo->latitude ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label>Longitude</label>
                                <input type="text" name="longitude" class="form-control" 
                                    value="{{ old('longitude', $userInfo->longitude ?? '') }}">
                            </div>-->
                        </div>
                        
                        <button type="submit" class="btn-orange mt-4 setting-btt">Save Changes</button>
                    </div>
                </form>

                <!-- Change Password Form -->
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-card shadow-sm">
                        <div class="agent-head">
                            <h5 class="mb-4 border-bottom agend-headd">Change Password</h5>
                        </div>

                        <div class="row g-3 settng-all">
                            <div class="col-12">
                                <label>Old Password</label>
                                <input type="password" name="old_password" class="form-control" placeholder="Enter old password">
                            </div>
                            <div class="col-12">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control" placeholder="Enter new password">
                            </div>
                            <div class="col-12">
                                <label>Confirm new password</label>
                                <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm new password">
                            </div>
                        </div>
                        <button type="submit" class="btn-orange mt-4 setting-btt">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get elements
            const changeAvatarBtn = document.getElementById('changeAvatarBtn');
            const avatarInput = document.getElementById('avatarInput');
            const avatarPreview = document.getElementById('avatarPreview');
            const deleteAvatarBtn = document.getElementById('deleteAvatarBtn');
            
            // Change avatar button click - open file dialog
            if (changeAvatarBtn) {
                changeAvatarBtn.addEventListener('click', function() {
                    avatarInput.click();
                });
            }
            
            // When file is selected, upload it
            if (avatarInput) {
                avatarInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) return;
                    
                    // Validate file type
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    if (!allowedTypes.includes(file.type)) {
                        showMessage('Please select a valid image (JPEG, PNG, JPG, or GIF)', 'danger');
                        avatarInput.value = '';
                        return;
                    }
                    
                    // Validate file size (max 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        showMessage('File size must be less than 2MB', 'danger');
                        avatarInput.value = '';
                        return;
                    }
                    
                    // Show loading state
                    avatarPreview.style.opacity = '0.5';
                    
                    // Upload file
                    const formData = new FormData();
                    formData.append('avatar', file);
                    formData.append('_token', '{{ csrf_token() }}');
                    
                    fetch('{{ route("profile.avatar.update") }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update avatar preview
                            avatarPreview.src = data.avatar_url + '?t=' + Date.now();
                            avatarPreview.style.opacity = '1';
                            showMessage(data.message || 'Avatar updated successfully!', 'success');
                            // Reload after 1 second to update session
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            avatarPreview.style.opacity = '1';
                            showMessage(data.message || 'Failed to update avatar', 'danger');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        avatarPreview.style.opacity = '1';
                        showMessage('Error uploading avatar', 'danger');
                    });
                });
            }
            
            // Delete avatar - No alert, just reload
            if (deleteAvatarBtn) {
                deleteAvatarBtn.addEventListener('click', function() {
                    // Show loading state
                    avatarPreview.style.opacity = '0.5';
                    
                    fetch('{{ route("profile.avatar.delete") }}', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Reload page to show default avatar
                            location.reload();
                        } else {
                            avatarPreview.style.opacity = '1';
                            showMessage(data.message || 'Failed to delete avatar', 'danger');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        avatarPreview.style.opacity = '1';
                        showMessage('Error deleting avatar', 'danger');
                    });
                });
            }
            
            // Function to show message without alert
            function showMessage(message, type) {
                // Remove any existing dynamic alerts
                const existingAlerts = document.querySelectorAll('.dynamic-alert');
                existingAlerts.forEach(alert => alert.remove());
                
                // Find the container
                const container = document.querySelector('.col-lg-9');
                if (!container) return;
                
                // Create alert div
                const alertDiv = document.createElement('div');
                alertDiv.className = `dynamic-alert alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
                alertDiv.role = 'alert';
                alertDiv.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                
                // Insert at the top
                container.insertBefore(alertDiv, container.firstChild);
                
                // Auto remove after 3 seconds
                setTimeout(() => {
                    if (alertDiv) alertDiv.remove();
                }, 3000);
                
                // Close button functionality
                const closeBtn = alertDiv.querySelector('.btn-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => alertDiv.remove());
                }
                
                // Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    </script>


    <style>
        .agent-head {

            background-color: rgb(33 37 41 / 3%);

        }

        .settng-all {
            padding: 20px;
        }

        .setting-btt {
            margin: 15px;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>



@endsection