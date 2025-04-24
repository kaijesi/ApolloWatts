{{-- 
Home Page Content 

Contains welcome page with basic information about the application.
--}}
<x-base-layout>
    <x-slot:title>ApolloWatts - Home</x-slot:title>
    {{-- Welcome Section --}}
    <div class="jumbotron my-4">
      <h1 class="display-4">Welcome to ApolloWatts</h1>
      <p class="lead">Your one-stop-shop for getting reliable analytics and forecasts for your home solar performance!</p>
      <hr class="my-4">
      <p>It's easy, it's free. Just start your household account, invite your family members and add your first installation. ApolloWatts will help you track your home PV energy installation details, provide you with science-based predictions for your system's energy output and an interface to see real-time metrics about its performance.</p>
      <p class="lead">
        <a class="btn btn-primary btn-lg" href="{{ route('signup') }}" role="button">Register Now</a>
      </p>
    </div>
    {{-- Features Section --}}
    <h2>Features</h2>
    <div class="row">
        <div class="col-sm-4">
          <div class="card">
            <img src="{{ asset('images/Solar_Panels.jpeg') }}" class="card-img-top" alt="Landscape">
            <div class="card-body">
              <h5 class="card-title">Manage your Installation</h5>
              <p class="card-text">Add your PV installations to your household account for yourself and your family members to track</p>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <img src="{{ asset('images/Power_Estimate.jpeg') }}" class="card-img-top" alt="Portrait">
            <div class="card-body">
              <h5 class="card-title">Estimate your Output</h5>
              <p class="card-text">Run analytical projections to estimate and forecast your PV system's energy output</p>
            </div>
          </div>
        </div>
          <div class="col-sm-4">
          <div class="card">
            <img src="{{ asset('images/Check_RealTime.jpeg') }}" class="card-img-top" alt="Cityscape">
            <div class="card-body">
              <h5 class="card-title">Real-Time Analytics</h5>
              <p class="card-text">Get real-time analytics from your Solis PV installation to track your energy output</p>
            </div>
          </div>
        </div>
      </div>
</x-base-layout>