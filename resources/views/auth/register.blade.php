@extends('layouts.app')

@section('content')
<div id="signupPage">
    <div class="auth-page">
        <button class="back-btn" onclick="window.location.href='{{ url('/login') }}'">
            <i class="fas fa-arrow-left"></i>
        </button>
        
        <div class="auth-logo">
            <img src="{{ asset('Logo.png') }}" alt="Logo" style="width: 80px; height: 80px;">
        </div>
        
        <div class="auth-form">
            <form id="signupForm">
                <div class="auth-input-group">
                    <label>Full Name</label>
                    <input type="text" class="auth-input" name="name" placeholder="Enter your full name" required>
                </div>
                
                <div class="auth-input-group">
                    <label>Email</label>
                    <input type="email" class="auth-input" name="email" placeholder="Enter your email address" required>
                </div>
                
                <div class="auth-input-group">
                    <label>Password</label>
                    <input type="password" class="auth-input password-field" name="password" placeholder="Enter your password" required>
                    <i class="fas fa-eye-slash eye-icon" onclick="togglePassword(this)"></i>
                </div>
                
                <div class="auth-terms">
                    By signing up you agree to our <a href="#">Terms</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookie Use</a>
                </div>
                
                <button type="submit" class="auth-btn">SignUp</button>
            </form>
            
            <div class="auth-footer">
                Already have an account? <a href="{{ url('/login') }}">Log In</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('signupForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const name = this.querySelector('input[name="name"]').value;
        const email = this.querySelector('input[name="email"]').value;
        const password = this.querySelector('input[name="password"]').value;

        try {
            const response = await fetch('{{ url('/api/register') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ name, email, password })
            });

            const data = await response.json();

            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '{{ url('/login') }}';
                });
            } else {
                let errorMessage = 'Registration failed.';
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
