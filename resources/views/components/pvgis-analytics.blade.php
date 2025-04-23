{{-- 
Component to show projections for an installation based on PVGIS API request results 
--}}

{{-- Push the PVGIS JavaScript helper and Chart JS into the header section 
of the view this component appears in --}}
@push('custom-headers')
    @vite(['resources/js/helpers/pvgis-request.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

{{-- Hidden form containing necessary data of the installation to retrieve analytics from PVGIS --}}
<form id="pvgis-form" method="POST">
    @csrf
    <input type="hidden" id="lat" name="lat" value="{{ $installation->latitude }}">
    <input type="hidden" id="lon" name="lon" value="{{ $installation->longitude }}">
    <input type="hidden" id="peakpower" name="peakpower" value="{{ $installation->peak_power }}">
    <input type="hidden" id="pvtechchoice" name="pvtechchoice" value="{{ $installation->pv_tech }}">
    <input type="hidden" id="loss" name="loss" value="{{ $installation->system_loss }}">
    <input type="hidden" id="slope" name="slope" value="{{ $installation->slope_angle }}">
    <input type="hidden" id="azimuth" name="azimuth" value="{{ $installation->azimuth }}">
    <button type="submit" class="btn btn-primary mb-4">Monthly Projection</button>
</form>

{{-- Close Button --}}
<button id="pvgis-close-chart" class="btn btn-secondary mb-4" style="display: none;">Close</button>

{{-- Container to render charts --}}
<canvas id="pvgis-monthly-chart" style="max-width: 100%; width: 100%; display: none"></canvas>
