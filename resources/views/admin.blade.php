@extends('template.main')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div style="height: 20vh"></div>
<div class="d-flex justify-content-center align-items-center align-content-center flex-column mx-5">
    <h3 class="pt-5 text-secondary">List of Users</h3>
    <table class="table table-striped mt-3 object-fit-content">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Dating Code</th>
                <th scope="col">Dating Id</th>
                <th scope="col">Name</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Gender</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                {{-- ban Modal --}}
                <div class="modal" tabindex="-1" id="banModal">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Ban User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <p>Are you sure to ban this user?</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="{{ route('banned',$user->id) }}" type="button" class="btn btn-primary" style="text-decoration: none">Yes</a>
                        </div>
                    </div>
                    </div>
                </div>

                {{-- unban Modal --}}
                <div class="modal" tabindex="-1" id="unbanModal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Ban User</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure to unban this user?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <a href="{{ route('unbanned',$user->id) }}" type="button" class="btn btn-primary">Yes</a>
                        </div>
                      </div>
                    </div>
                </div>

                {{-- @if ($user->is_admin == '0') --}}
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->datingCode }}</td>
                        <td>{{ $user->datingID }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->birthDate }}</td>
                        <td>
                            @if ($user->gender == '1')
                                Male
                            @else
                                Female
                            @endif
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phoneNumber }}</td>
                        <td>
                            @if ($user->isBanned == '0')
                                Active
                            @else
                                Banned
                            @endif
                        </td>
                        @if($user->isBanned == '0')
                            <td>
                                <button type="button" class="btn btn-danger banBtn px-3" data-bs-toggle="modal" data-bs-target="#banModal">
                                    <i class="fa-solid fa-user-minus"></i><span class="ms-2">Ban User</span>
                                </button>
                            </td>
                        @else
                            <td>
                                <button type="button" class="btn btn-success unbanBtn px-3" data-bs-toggle="modal" data-bs-target="#unbanModal">
                                    <i class="fa-solid fa-user-plus"></i><span class="ms-2">Unban User</span>
                                </button>
                            </td>
                        @endif
                    </tr>
                {{-- @endif --}}
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://kit.fontawesome.com/720cee72b2.js" crossorigin="anonymous"></script>
@endsection