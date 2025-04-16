{{-- 
Installation Form Component

Used to submit installation details
--}}

<form action="{{ route('new-installation') }}" method="POST">
    {{-- Include a CSRF Token --}}
    @csrf

    {{-- Form content --}}
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
    </div>
    <div class="mb-3">
        <label for="latitude" class="form-label">Latitude</label>
        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude">
    </div>
    <div class="mb-3">
        <label for="longitude" class="form-label">Longitude</label>
        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude">
    </div>
    <div class="mb-3">
        <label for="peak_power" class="form-label">Peak Power (kW)</label>
        <input type="number" step="0.01" class="form-control" id="peak_power" name="peak_power" placeholder="Enter Peak Power">
    </div>
    <div class="mb-3">
        <label for="pv_tech" class="form-label">PV Technology</label>
        <select class="form-select" id="pv_tech" name="pv_tech" required>
            <option value="crystSi">Crystalline silicon</option>
            <option value="CIS">CIS</option>
            <option value="CdTe">CdTe</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="system_loss" class="form-label">System Loss (%)</label>
        <input type="number" step="0.01" class="form-control" id="system_loss" name="system_loss" placeholder="Enter System Loss">
    </div>
    <div class="mb-3">
        <label for="slope_angle" class="form-label">Slope Angle (°)</label>
        <input type="number" class="form-control" id="slope_angle" name="slope_angle" placeholder="Enter Slope Angle">
    </div>
    <div class="mb-3">
        <label for="azimuth" class="form-label">Azimuth (°)</label>
        <input type="number" class="form-control" id="azimuth" name="azimuth" placeholder="Enter Azimuth">
    </div>
    <div class="mb-3">
        <label for="system_cost" class="form-label">System Cost (€)</label>
        <input type="number" step="0.01" class="form-control" id="system_cost" name="system_cost" placeholder="Enter System Cost">
    </div>
    <div class="mb-3">
        <label for="installer_name" class="form-label">Installer Name</label>
        <input type="text" class="form-control" id="installer_name" name="installer_name" placeholder="Enter Installer Name">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>