<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusher Test</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('e250a01f05d8cb789fc5', {
            cluster: 'ap1',
            encrypted: true
        });
        var channel = pusher.subscribe('my-channel');
        channel.bind('form-submitted', function(data) {
            toastr.success('New User Registered', 'Name: ' + data.name, {
                timeOut: 5000,  
                extendedTimeOut: 2000,  
            });
        });
    </script>
</head>
<body>
    <h1>Pusher Test</h1>
    <p>
        Try registering a new user to see the notification.
    </p>
</body>
</html>
