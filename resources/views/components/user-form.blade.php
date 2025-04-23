{{--
User Form Component

Used to submit user details (Create User)
--}}

<form action="{{ route('my-details.update', $user['id']) }}" method="POST">
    {{-- Include a CSRF Token --}}
    @csrf
    {{-- Declare as a patch request --}}
    @method('patch')

    {{-- Form content --}}
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Edit Name"
            value="{{ $user->name ?? '' }}">
    </div>

    <div class="mb-3">
        <label for="current-password" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="current-password" name="current-password"
            placeholder="Enter Current Password">
    </div>

    <div class="mb-3">
        <label for="new-password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="new-password" name="new-password" placeholder="New Password">
    </div>

    <div class="mb-3">
        <label for="confirm-password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirm-password" name="confirm-password"
            placeholder="Confirm Password">
    </div>

    <button type="submit" class="btn btn-primary">Update Details</button>
</form>
