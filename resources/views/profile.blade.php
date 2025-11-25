@extends('layouts.app')

@section('content')
<div id="profilePage">
    <div class="home-page"> {{-- Reusing home-page styling for now --}}
        <div class="home-header">
            <div class="welcome-section">
                <button class="back-btn" onclick="window.location.href='{{ url('/') }}'">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <div class="welcome-text" style="margin-left: auto; margin-right: auto;">
                    <p>Profile</p>
                </div>
            </div>
        </div>

        <div class="category-section"> {{-- Reusing category-section for content padding --}}
            <div class="section-header">
                <h4>User Information</h4>
            </div>
            <p style="color: #64748b; margin-bottom: 15px;">Display user details here.</p>
            {{-- Placeholder for user information --}}
            <div class="profile-info-card" style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.08); margin-bottom: 20px;">
                <p><strong>Name:</strong> <span id="profileUserName"></span></p>
                <p><strong>Email:</strong> <span id="profileUserEmail"></span></p>
            </div>

            <form action="{{ route('logout') }}" method="POST" style="text-align: center; margin-top: 30px;">
                @csrf
                <button type="submit" class="auth-btn" style="background: #dc3545; width: auto; padding: 10px 30px; border-radius: 25px;">Logout</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userName = localStorage.getItem('user_name');
        const userEmail = localStorage.getItem('user_email');

        if (userName) {
            document.getElementById('profileUserName').textContent = userName;
        }
        if (userEmail) {
            document.getElementById('profileUserEmail').textContent = userEmail;
        }
    });
</script>
@endpush
