@extends('layouts.app')

@section('content')
<div id="loginPage">
    <div class="auth-page">
        <button class="back-btn" onclick="window.location.href='{{ url('/register') }}'">
            <i class="fas fa-arrow-left"></i>
        </button>
        
        <div class="auth-logo">
            <img src="{{ asset('Logo.png') }}" alt="Logo" style="width: 80px; height: 80px;">
        </div>
        
        <div class="auth-form">
            <form id="loginForm">
                <div class="auth-input-group">
                    <label>Email</label>
                    <input type="email" class="auth-input" name="email" placeholder="Enter your email address" required>
                </div>
                
                <div class="auth-input-group">
                    <label>Password</label>
                    <input type="password" class="auth-input password-field" name="password" placeholder="Enter your password" required>
                    <i class="fas fa-eye-slash eye-icon" onclick="togglePassword(this)"></i>
                </div>
                
                <button type="submit" class="auth-btn">Login</button>
            </form>
            
            <div class="auth-footer">
                Don't have an account? <a href="{{ url('/register') }}">SignUp</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const email = this.querySelector('input[name="email"]').value;
        const password = this.querySelector('input[name="password"]').value;

        try {
            const response = await fetch('{{ url('/api/login') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();

            if (response.ok) {
                const accessToken = data.access_token;
                localStorage.setItem('access_token', accessToken);

                // Fetch user data
                const userResponse = await fetch('{{ url('/api/user') }}', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${accessToken}`
                    }
                });

                const userData = await userResponse.json();

                if (userResponse.ok) {
                    localStorage.setItem('user_name', userData.name);
                    localStorage.setItem('user_email', userData.email);
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '{{ url('/') }}';
                });
            } else {
                let errorMessage = 'Login failed.';
                if (data.errors) {
                    errorMessage = Object.values(data.errors).flat().join('\n');
                } else if (data.message) {
                    errorMessage = data.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred. Please try again.',
            });
        }
    });
</script>
@endpush
