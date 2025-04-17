{{-- 
Installation Page View 

Contains details about an individual installation as well as analytics for it
--}}
<x-base-layout>
    <x-slot:title>ApolloWatts - {{ $installation['name'] }} Details</x-slot:title>
    <h1>Installation Details</h1>
    <h2 class="my-4" id="installation-name" name="installation-name">{{ $installation['name'] }}</h2>
    <x-installation-details :installation='$installation' />
    <h2 class="my-4">Analytics</h2>
    <div class="my-4"><x-pvgis-analytics :installation='$installation' /></div>
    <div class="my-4"><x-solis-analytics :installation='$installation'/></div>
</x-base-layout>
