{{-- 
User Details Component

Card component showing details for a user
--}}

<div class="card">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">{{ $user->name }} 
            {{-- Add suffix to name if user is household admin --}}
            @if ($user->is_household_admin)
                | Household Admin
            @endif
        </h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Email:</strong>
            <p class="card-text">{{ $user->email }}</p>
        </div>
        <div class="mb-3">
            <strong>Created At:</strong>
            <p class="card-text">{{ $user->created_at }}</p>
        </div>
        <div class="mb-3">
            <strong>Updated At:</strong>
            <p class="card-text">{{ $user->updated_at }}</p>
        </div>
    </div>
</div>