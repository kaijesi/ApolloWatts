{{-- 
Installation Form Component

Used to submit installation details
--}}

<form action="{{ $isUpdate ? route('installations.update', $installation['id']) : route('new-installation') }}"
    method="POST">
    {{-- Include a CSRF Token --}}
    @csrf
    {{-- Clarify the method as patch if this is an update request --}}
    @if ($isUpdate)
        @method('patch')
    @endif
    {{-- Form content --}}
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name"
            placeholder="{{ $isUpdate ? '' : 'Enter Name' }}" value="{{ $installation->name ?? '' }}">
    </div>
    <div class="mb-3">
        <label for="latitude" class="form-label">Latitude</label>
        <input type="text" class="form-control" id="latitude" name="latitude"
            placeholder="{{ $isUpdate ? '' : 'Enter Latitude' }}" value="{{ $installation->latitude ?? '' }}">
    </div>
    <div class="mb-3">
        <label for="longitude" class="form-label">Longitude</label>
        <input type="text" class="form-control" id="longitude" name="longitude"
            placeholder="{{ $isUpdate ? '' : 'Enter Longitude' }}" value="{{ $installation->longitude ?? '' }}">
    </div>
    <div class="mb-3">
        <label for="peak_power" class="form-label">Peak Power (kW)</label>
        <input type="number" step="0.01" class="form-control" id="peak_power" name="peak_power"
            placeholder="{{ $isUpdate ? '' : 'Enter Peak Power' }}" value="{{ $installation->peak_power ?? '' }}">
    </div>
    <div class="mb-3">
        <label for="pv_tech" class="form-label">PV Technology</label>
        <select class="form-select" id="pv_tech" name="pv_tech" required>
            <option value="crystSi" {{ ($installation->pv_tech ?? '') == 'crystSi' ? 'selected' : '' }}>Crystalline
                silicon</option>
            <option value="CIS" {{ ($installation->pv_tech ?? '') == 'CIS' ? 'selected' : '' }}>CIS</option>
            <option value="CdTe" {{ ($installation->pv_tech ?? '') == 'CdTe' ? 'selected' : '' }}>CdTe</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="system_loss" class="form-label">System Loss (%)</label>
        <input type="number" step="0.01" class="form-control" id="system_loss" name="system_loss"
            placeholder="{{ $isUpdate ? '' : 'Enter System Loss' }}" value="{{ $installation->system_loss ?? '' }}">
    </div>
    <div class="mb-3">
        <label for="slope_angle" class="form-label">Slope Angle (°)</label>
        <input type="number" class="form-control" id="slope_angle" name="slope_angle"
            placeholder="{{ $isUpdate ? '' : 'Enter Slope Angle' }}" value="{{ $installation->slope_angle ?? '' }}">
    </div>
    <div class="mb-3">
        <label for="azimuth" class="form-label">Azimuth (°)</label>
        <input type="number" class="form-control" id="azimuth" name="azimuth"
            placeholder="{{ $isUpdate ? '' : 'Enter Azimuth' }}" value="{{ $installation->azimuth ?? '' }}">
    </div>
    <div class="mb-3">
        <label for="system_cost" class="form-label">System Cost (€)</label>
        <input type="number" step="0.01" class="form-control" id="system_cost" name="system_cost"
            placeholder="{{ $isUpdate ? '' : 'Enter System Cost' }}" value="{{ $installation->system_cost ?? '' }}">
    </div>
    <div class="mb-3">
        <label for="installer_name" class="form-label">Installer Name</label>
        <input type="text" class="form-control" id="installer_name" name="installer_name"
            placeholder="{{ $isUpdate ? '' : 'Enter Installer Name' }}"
            value="{{ $installation->installer_name ?? '' }}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
