{{-- Singup Page Content --}}
<x-base-layout>
    <x-slot:title>ApolloWatts - Sign Up</x-slot:title>
    <h1>Register your Household Account</h1>
    <x-signup-form></x-signup-form>
    {{-- Include the signup-form JavaScript helper --}}
    @push('custom-headers')
        @vite(['resources/js/helpers/signup-form.js'])
    @endpush
</x-base-layout>