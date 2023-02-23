@extends('layouts.app')

@section('content')
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb ms-auto">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Library</li>
  </ol>
</nav>
<div class="row justify-content-center">
    <div class="col-8">
        <div class="card">
            <div class="card-header bg-dark">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_user_modal" style="float:right">
                Add user
                </button>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if ($user->role == 1) Admin
                                @else Cashier
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-warning me-1" data-bs-toggle="modal" data-bs-target="#edit_user_modal">Edit</a>
                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_user_modal">Delete</a>
                                </div>
                            </td>
                        </tr>

                        <!-- edit modal -->
                        <div class="modal fade" id="edit_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('users.update', $user->id) }}">
                                        <div class="modal-body">
                                            @csrf
                                            @method('put')
                                            <div class="row mb-3">
                                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" autocomplete="name" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                                                <div class="col-md-6">
                                                    <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" value="{{ old('role') }}">
                                                        <option
                                                            value="1"
                                                            @if ($user->role == 1)
                                                            selected
                                                            @endif
                                                        >
                                                            Admin
                                                        </option>
                                                        <<option
                                                            value="2"
                                                            @if ($user->role == 2)
                                                            selected
                                                            @endif
                                                        >
                                                            Cashier
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- delete modal -->
                        <div class="modal fade" id="delete_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('users.delete', $user->id) }}">
                                        <div class="modal-body">
                                            @csrf
                                            @method('delete')
                                            <p>Are you sure you want delete {{$user->name}} ?</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header bg-dark">{{ __('Filter User') }}</div>
            <div class="card-body">
                <form method="post" action="">
                    @csrf
                    <div class="mb-3">
                        <label for="filter_name" class="form-label">Find user by email</label>
                        <input type="email" name="filter_name" id="filter_name" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label for="filter_role" class="form-label">Filter by role</label>
                        <select id="filter_role" name="filter_role" class="form-select">
                            <option>Disabled select</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="add_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ route('users.store') }}">
            <div class="modal-body">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                    <div class="col-md-6">
                        <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" value="{{ old('role') }}">
                            <option value="1">Admin</option>
                            <option value="2">Cashier</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary">Create</button>
            </div>
        </form>
    </div>
  </div>
</div>

@endsection
