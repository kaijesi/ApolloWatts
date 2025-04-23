{{--
Base layout for all views of the application.
Common header tags are defined here, others can be added by child views into @stack section.

--}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Allow for title insertion from pages using this layout --}}
    <title>{{ $title ?? 'ApolloWatts' }}</title>

    {{-- Include Bootstrap, jQuery & Laravel's main app.js --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @vite(['resources/js/app.js'])

    {{-- Slot to insert furhter headers for individual views --}}
    @stack('custom-headers')

</head>

<body>
    <x-header />
    <x-navigation />
    <main class="container mt-4">
        {{-- Display success message --}}
        @if (session('success'))
            <div class="alert alert-success">
                <h4 class="alert-heading">Success!</h4>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        {{-- 
        Laravel handles errors by redirecting form submissions to the initial page
        Any errors encountered are stored in an $errors list
        --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <h4 class="alert-heading">Error(s) encountered:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{ $slot }}
    </main>
    <x-footer />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
