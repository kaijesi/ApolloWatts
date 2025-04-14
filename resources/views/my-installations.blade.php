{{--
My Installations View

View to show the current user's installations if any are present
Also shows an "Add new installation" button if the user is household admin
--}}


<x-base-layout>
    <x-slot:title>ApolloWatts - My Installations</x-slot:title>
    <h1>Your Installations</h1>
    
    {{-- If any installations are present for the household, display them --}}
    @if (count($installations)>0)
        <div class="row">
            @foreach ($installations as $installation)
            <div class="col-md-4 mb-4">
                <x-installation-details :installation="$installation" />
            </div>
            @endforeach
        </div>
    {{-- Otherwise, display a warning --}}
    @else
        <div class="alert alert-warning" role="alert">
            Your household currently doesn't have any installations.
        </div>
    @endif

    {{-- If the current used is an admin, show the option and modal to add a new installation --}}
    @if (Auth::user()->is_household_admin)
    <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#addInstallation">
        Add New Installation
    </button>
    <x-modal modalId="addInstallation" modalTitle="Add Installation">
        <x-installation-form/>
    </x-modal>
    @endif
    
</x-base-layout>
