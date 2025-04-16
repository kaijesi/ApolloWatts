{{-- 
Installation Page View 

Contains details about an individual installation as well as analytics for it
--}}
<x-base-layout>
    <x-slot:title>ApolloWatts - {{ $installation['name'] }} Details</x-slot:title>
    <h1>Installation Details</h1>
    <h2>{{ $installation['name'] }}</h2>
    <x-installation-details :installation='$installation' />
    <h2>Analytics</h2>
    <x-pvgis-analytics :installation='$installation' />
</x-base-layout>
