{{-- 
Installation Details Component

Card component showing details for a specific installation
--}}

<div class="card">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">{{ $installation['name'] ?? 'Installation Details' }}</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Latitude:</strong>
            <p class="card-text">{{ $installation['latitude'] }}</p>
        </div>
        <div class="mb-3">
            <strong>Longitude:</strong>
            <p class="card-text">{{ $installation['longitude'] }}</p>
        </div>
        <div class="mb-3">
            <strong>Peak Power:</strong>
            <p class="card-text">{{ $installation['peak_power'] }}</p>
        </div>
        <div class="mb-3">
            <strong>PV Technology:</strong>
            <p class="card-text">{{ $installation['pv_tech'] }}</p>
        </div>
        <div class="mb-3">
            <strong>System Loss:</strong>
            <p class="card-text">{{ $installation['system_loss'] }}</p>
        </div>
        <div class="mb-3">
            <strong>Slope Angle:</strong>
            <p class="card-text">{{ $installation['slope_angle'] }}</p>
        </div>
        <div class="mb-3">
            <strong>Azimuth:</strong>
            <p class="card-text">{{ $installation['azimuth'] }}</p>
        </div>
        <div class="mb-3">
            <strong>System Cost:</strong>
            <p class="card-text">{{ $installation['system_cost'] }}</p>
        </div>
        <div class="mb-3">
            <strong>Installer Name:</strong>
            <p class="card-text">{{ $installation['installer_name'] }}</p>
        </div>
        <div class="mb-3">
            <strong>Created At:</strong>
            <p class="card-text">{{ $installation['created_at'] }}</p>
        </div>
        <div class="mb-3">
            <strong>Updated At:</strong>
            <p class="card-text">{{ $installation['updated_at'] }}</p>
        </div>
        <div class="mb-3">
            <strong>Household ID:</strong>
            <p class="card-text">{{ $installation['household_id'] }}</p>
        </div>
    </div>
</div>