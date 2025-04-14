{{-- 
Login Form Component

This component contains the user login form
--}}

{{-- Form Content --}}
<form action="{{ route('login.post') }}" method="POST">
    {{-- Include a CSRF Token --}}
    @csrf
    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" class="form-control" type="email" placeholder="Your Email" required>
    </div>
    <div class="form-group mb-4">
        <label for="password">Password</label>
        <input id="password" name="password" class="form-control" type="password" placeholder="Your Password" required>
    </div>
    {{-- Submission --}}
    <button class="btn btn-primary" type="submit">Login</button>
</form>