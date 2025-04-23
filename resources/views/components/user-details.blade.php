{{-- 
User Details Component

Card component showing details for a user
--}}

<div class="card">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $user->name }}
            {{-- Add suffix to name if user is household admin --}}
            @if ($user->is_household_admin)
                | Admin
            @endif
        </h5>
        {{-- Only show edit and delete buttons on individual views --}}
        @if (Route::currentRouteName() === 'my-details')
            <div class="d-flex align-items-center" style="color: #212529;">
                {{-- Only show edit button for authorised users --}}
                @if (Auth::user()->can('update', $user))
                    <button type="button" class="btn btn-outline-light m-2" data-bs-toggle="modal" data-bs-target="#edit">
                        Edit
                    </button>
                    <x-modal modalId="edit" modalTitle="Edit">
                        <x-user-form :user='$user' />
                    </x-modal>
                @endif
                {{-- Only show delete button for authroised users --}}
                @if (Auth::user()->can('delete', $user))
                    <form action="{{ route('my-details.destroy', $user['id']) }}" method="POST"
                        onsubmit="return confirm('{{ $user->is_household_admin
                            ? 'As an admin, deleting your account will delete the household, its installations and other members. Are you sure you want to proceed?'
                            : 'Are you sure you want to delete your user account?' }}'
                        )">
                        @csrf
                        {{-- Method must be specified as HTML forms only support post, 
                Laravel however can use this method parameter here an treat the post request as a DELETE --}}
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        {{-- For any non-admin, show the option to declare them as such in the card list view --}}
        @elseif (!$user->is_household_admin && Auth::user()->can('update', $user))
        <form action="{{ route('my-details.update', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('This will declare the user as admin with rights to create, modify and delete both the household and its installations')">
            @csrf
            @method('PATCH')
            <input type="hidden" name="is-household-admin" value="1">
            <button type="submit" class="btn btn-outline-light btn-sm">
                Declare Admin
            </button>
        </form>
        {{-- For any admin, show the option to remove them as admin if running user is allowed to --}}
        @elseif ($user->is_household_admin && Auth::user()->can('update', $user))
        <form action="{{ route('my-details.update', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('This will remove the user as admin including their rights to create, modify and delete both the household and its installations')">
            @csrf
            @method('PATCH')
            <input type="hidden" name="is-household-admin" value="0">
            <button type="submit" class="btn btn-danger btn-sm">
                Remove Admin
            </button>
        </form>
        @endif
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
