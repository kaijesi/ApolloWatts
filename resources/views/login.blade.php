{{-- Login Page Content --}}

{{-- "Login" navigation button opens the login modal, 
this view is how it was done before, retaining it to still allow for using /login route in the future --}}

<x-base-layout>
    <x-slot:title>ApolloWatts - Login</x-slot:title>
    <h1>Log into your Household Account</h1>
    <x-login-form></x-login-form>
</x-base-layout>
