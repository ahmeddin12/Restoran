@extends('layouts.admin')

@section('content')

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        @if (\Session::has('success'))
        <div class="alert alert-success">
          <ul>
            <li>{!! \Session::get('success') !!}</li>
          </ul>
        </div>
        @endif
        @if (\Session::has('delete'))
        <div class="alert alert-success">
          <ul>
            <li>{!! \Session::get('delete') !!}</li>
          </ul>
        </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Users</h5>
          <a href="{{ route('admins.users.create') }}" class="btn btn-primary">
            <i class="fa fa-plus mr-1"></i> Create User
          </a>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-striped align-middle mb-0">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width: 80px;">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col" class="text-right" style="width: 200px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $user)
              <tr>
                <th scope="row">{{ $user->id }}</th>
                <td class="text-capitalize">{{ $user->name }}</td>
                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                <td class="text-right">
                  <a href="{{ route('admins.users.edit', $user->id) }}" class="btn btn-sm btn-warning text-white">
                    <i class="fa fa-pen"></i> Edit
                  </a>
                  <a href="{{ route('admins.users.delete', $user->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?');">
                    <i class="fa fa-trash"></i> Delete
                  </a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center text-muted py-4">No users found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
