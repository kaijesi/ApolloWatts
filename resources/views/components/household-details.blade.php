{{-- 
Household Details Component

Card component containing information about a household
 --}}

<div class="card">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $household->name }}</h5>
        @if (Auth::user()->can('update', $household))
            <div class="d-flex align-items-center" style="color: #212529;">
                <button type="button" class="btn btn-outline-light m-2" data-bs-toggle="modal" data-bs-target="#edit">
                    Edit
                </button>
                <x-modal modalId="edit" modalTitle="Edit">
                    <x-household-form :household='$household' />
                </x-modal>
            </div>
        @endif
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Street:</strong>
            <p class="card-text">{{ $household->street }}</p>
        </div>
        <div class="mb-3">
            <strong>Number:</strong>
            <p class="card-text">{{ $household->number }}</p>
        </div>
        <div class="mb-3">
            <strong>Postcode:</strong>
            <p class="card-text">{{ $household->postcode }}</p>
        </div>
        <div class="mb-3">
            <strong>City:</strong>
            <p class="card-text">{{ $household->city }}</p>
        </div>
        <div class="mb-3">
            <strong>Country:</strong>
            <p class="card-text">{{ $household->country }}</p>
        </div>
        {{-- Show household ID for admin to share with others for joining the household --}}
        @if (Auth::user()->is_household_admin)
        <div class="mb-3">
            <strong>Household Join Code:</strong>
            <p class="card-text">{{ $household->id }}</p>
        </div>
        @endif
        <div class="mb-3">
            <strong>Created At:</strong>
            <p class="card-text">{{ $household->created_at }}</p>
        </div>
        <div class="mb-3">
            <strong>Updated At:</strong>
            <p class="card-text">{{ $household->updated_at }}</p>
        </div>
    </div>
</div>
