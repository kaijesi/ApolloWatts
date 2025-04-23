{{--
Household Form Component

Form component for updating a household
--}}

<form action="{{ route('household.update', $household['id']) }}" method="POST">
    {{-- Include a CSRF Token --}}
    @csrf
    
    {{-- Mark as patch request --}}
    @method('patch')

    {{-- Form content --}}
    <div class="mb-3">
        <label for="name" class="form-label">Household Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Household Name" value="{{ $household->name }}">
    </div>
    <div class="mb-3">
        <label for="street" class="form-label">Street</label>
        <input type="text" class="form-control" id="street" name="street" placeholder="Enter Street" value="{{ $household->street }}">
    </div>
    <div class="mb-3">
        <label for="number" class="form-label">Number</label>
        <input type="text" class="form-control" id="number" name="number" placeholder="Enter Number" value="{{ $household->number }}">
    </div>
    <div class="mb-3">
        <label for="postcode" class="form-label">Postcode</label>
        <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Enter Postcode" value="{{ $household->postcode }}">
    </div>
    <div class="mb-3">
        <label for="city" class="form-label">City</label>
        <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="{{ $household->city }}">
    </div>
    <div class="mb-3">
        <label for="country" class="form-label">Country</label>
        <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" value="{{ $household->country }}">
    </div>
     <div class="mb-3">
        <label for="solis_api_id" class="form-label">Solis API ID</label>
        <input type="text" class="form-control" id="solis_api_id" name="solis_api_id" placeholder="Enter Solis API ID" value="{{ $household->solis_api_id }}">
    </div>
    <div class="mb-3">
        <label for="solis_api_key" class="form-label">Solis API Key</label>
        <input type="text" class="form-control" id="solis_api_key" name="solis_api_key" placeholder="Enter Solis API Key" value="{{ $household->solis_api_key }}">
    </div>

    <button type="submit" class="btn btn-primary">Update Household</button>
</form>
