{{--
My Household View

View displaying the current user's household as well as its members
--}}

<x-base-layout>
    <x-slot:title>ApolloWatts - My Household</x-slot:title>
    <h1>Your Household</h1>
    <h2>Household Details:</h2>
    <x-household-details :household="$household" />
    <h2>Household Members:</h2>
    {{-- Create a card in a grid for each household member --}}
    <div class="row">
        @foreach ($members as $member)
        <div class="col-md-4 mb-4">
            <x-user-details :user="$member" />
        </div>
        @endforeach
    </div>
</x-base-layout>