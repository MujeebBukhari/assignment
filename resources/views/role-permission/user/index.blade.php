@extends('layouts.app')

@section('content')

    @role('super-admin')

    @endrole()
    <div class="container mt-5">
        <a href="{{ url('roles') }}" class="btn btn-primary mx-1">Roles</a>
        <a href="{{ url('permissions') }}" class="btn btn-info mx-1">Permissions</a>
        <a href="{{ url('users') }}" class="btn btn-warning mx-1">Users</a>
    </div>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Users
                            @can('create user')
                            <a href="{{ url('users/create') }}" class="btn btn-primary float-end">Add User</a>
                            @endcan
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr id="user-row-{{ $user->id }}">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $rolename)
                                                <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @can('update user')
                                        <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-success">Edit</a>
                                        @endcan

                                        @can('delete user')
                                             <button class="btn btn-danger mx-2" onclick="deleteUser({{ $user->id }})">Delete</button>
                                        @endcan



                                       
                                    </td>
                                    <td>
                                    @role('super-admin')

                                    @if ($user->blocked)
                                    <button class="btn btn-success btn-unblock" data-user-id="{{ $user->id }}">Unblock</button>
                                    @else
                                    <button class="btn btn-danger btn-block" data-user-id="{{ $user->id }}">Block</button>
                                    @endif

                                    @endrole()
                                    
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    

@endsection

@push('scripts')
<script>
    function deleteUser(userId) {
        $.ajax({
            url: '{{ route("users.destroy", "") }}/' + userId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Handle success response (e.g., remove row from table)
                $('#user-row-' + userId).remove();
                console.log('User deleted successfully');
            },
            error: function(xhr) {
                // Handle error response
                console.error('Error deleting user:', xhr.responseText);
            }
        });
    }


    // Function to handle blocking and unblocking user
    $(document).ready(function() {
        $('.btn-block, .btn-unblock').click(function(e) {
            e.preventDefault();
            var userId = $(this).data('user-id');
            var action = $(this).hasClass('btn-block') ? 'block' : 'unblock';
            
            $.ajax({
                url: '/users/' + userId + '/' + action,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('User ' + action + 'ed successfully');
                    // Optionally update UI based on response
                    location.reload(); // Example: Refresh the page after action
                },
                error: function(xhr) {
                    console.error('Error ' + action + 'ing user:', xhr.responseText);
                    // Optionally handle error
                }
            });
        });
    });

</script>

@endpush

