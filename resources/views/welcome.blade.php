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
  
</div>

@endsection


