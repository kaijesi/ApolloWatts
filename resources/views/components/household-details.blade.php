{{-- 
Household Details Component

Card component containing information about a household
 --}}

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">{{ $household->name }}</h5>
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