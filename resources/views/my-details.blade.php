{{-- 
My Details View

View containing the current user's details
--}}
<x-base-layout>
    <x-slot:title>ApolloWatts - My Details</x-slot:title>
    <h1>Your Details</h1>
    <x-user-details :user="$user" />
</x-base-layout>