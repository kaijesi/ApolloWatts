{{-- 
Signup Form Component

This component contains the user signup form as well as a form to submit household information if a new household should be created.
The option to join an existing household via the household's join code is also included.
--}}

<form action="{{ route('register') }}" method="POST">
    {{-- Include a CSRF Token --}}
    @csrf

    {{-- Form Input for User Details --}}
    <div class="form-group col-md-4">
        <label for="firstNameInput">First Name</label>
        <input id="firstNameInput" name="firstNameInput" class="form-control" type="text" placeholder="First Name" required>
    </div>
    <div class="form-group col-md-4">
        <label for="lastNameInput">Last Name</label>
        <input id="lastNameInput" name="lastNameInput" class="form-control" type="text" placeholder="Last Name" required>
    </div>
    <div class="form-group col-md-4">
        <label for="emailInput">Email</label>
        <input id="emailInput" name="emailInput" class="form-control" type="email" placeholder="Email" required>
    </div>
    <div class="form-group col-md-4 mb-4">
        <label for="passwordInput">Password</label>
        <input id="passwordInput" name="passwordInput" class="form-control" type="password" placeholder="Password" required>
    </div>

    {{-- Household creation selector --}}
    <div class="form-group col-md-4 mb-4">
        <label class="form-label">Household Options</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="householdOption" id="householdJoin" value="join" checked>
            <label class="form-check-label" for="householdJoin">
                Join Existing Household
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="householdOption" id="householdCreate" value="create">
            <label class="form-check-label" for="householdCreate">
                Create New Household
            </label>
        </div>
        <small class="form-text text-muted">
            Select whether to join an existing household or create a new one.
        </small>
    </div>

    {{-- Household join additional fields --}}
    <div id="householdJoinFieldsContainer" style="display: none;">
        <div class="form-group col-md-4 mb-4">
            <label for="householdInviteCode" class="form-label">Household Invite Code</label>
            <input id="householdInviteCode" name="householdInviteCode" class="form-control" type="text" placeholder="Invite Code">
        </div>
    </div>

    {{-- Household creation additional fields --}}
    <div id="householdCreateFieldsContainer" style="display: none;">
        <div class="form-group col-md-4">
            <label for="street" class="form-label">Street</label>
            <input id="street" name="street" class="form-control" type="text" placeholder="Street">
        </div>
        <div class="form-group col-md-4">
            <label for="number" class="form-label">Number</label>
            <input id="number" name="number" class="form-control" type="text" placeholder="Number">
        </div>
        <div class="form-group col-md-4">
            <label for="postcode" class="form-label">Postcode</label>
            <input id="postcode" name="postcode" class="form-control" type="text" placeholder="Postcode">
        </div>
        <div class="form-group col-md-4">
            <label for="city" class="form-label">City</label>
            <input id="city" name="city" class="form-control" type="text" placeholder="City">
        </div>
        <div class="form-group col-md-4">
            <label for="country" class="form-label">Country</label>
            <input id="country" name="country" class="form-control" type="text" placeholder="Country">
        </div>
        <div class="form-group col-md-4">
            <label for="solis_api_id" class="form-label">Solis API ID (Optional)</label>
            <input id="solis_api_id" name="solis_api_id" class="form-control" type="text" placeholder="Solis API ID">
        </div>
        <div class="form-group col-md-4 mb-4">
            <label for="solis_api_key" class="form-label">Solis API Key (Optional)</label>
            <input id="solis_api_key" name="solis_api_key" class="form-control" type="text" placeholder="Solis API Key">
        </div>
    </div>

    {{-- Submission --}}
    <button class="btn btn-primary" type="submit">Register</button>

</form>