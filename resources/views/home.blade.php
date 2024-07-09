@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- {{ __('You are logged in!') }} -->

                    <div class="container">
                        <a href="{{ url('roles') }}" class="btn btn-primary mx-1">Roles</a>
                        <a href="{{ url('permissions') }}" class="btn btn-info mx-1">Permissions</a>
                        @role('super-admin')
                        <a href="{{ url('users') }}" class="btn btn-warning mx-1">Users</a>

                        @endrole()
                    </div>



                </div>
            </div>
        </div>
    </div>
    @role('super-admin')
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
                 
     @endrole
</div>

@endsection


@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
@endpush
