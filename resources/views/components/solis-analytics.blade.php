{{-- 
Component to show projections for an installation based on Solis API request results 
--}}

{{-- Push the Solis JavaScript helper and Chart JS into the header section 
of the view this component appears in --}}
@push('custom-headers')
    @vite(['resources/js/helpers/solis-request.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

{{-- Hidden form containing necessary data of the installation to retrieve analytics from solis --}}
<form id="solis-form" method="POST">
    @csrf
    <input type="hidden" id="name" name="name" value="{{ $installation->name }}">
    <button type="submit" class="btn btn-primary mb-4">Get Solis Analytics</button>
</form>

{{-- Close Button --}}
<button id="solis-close-chart" class="btn btn-secondary mb-4" style="display: none;">Close</button>

{{-- Container to render charts --}}
<div id="solis-analytics" style="max-width: 100%; width: 100%; display: none">
    <div class="row">
        <div class="col-md-6">
            <div id="gauge-chart-container">
                <h4 class="my-4">Current Capacity Usage</h4>
                <canvas id="gauge-chart"></canvas>
                <div id="gauge-center-text"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <h4 class="my-4">KPIs</h4>
                <div id="kpis"></div>
            </div>
        </div>
    </div>
</div>
