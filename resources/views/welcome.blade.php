<!DOCTYPE html>
<html>

<head>
    <title>VernonEdu</title>

    @viteReactRefresh
    @vite('resources/js/app.jsx')

</head>

<body>

    <div id="app"></div>
    <script src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

</body>

</html>
