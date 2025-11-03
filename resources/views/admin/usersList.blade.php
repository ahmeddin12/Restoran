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
        <h5 class="card-title mb-4 d-inline">Users</h5>
        <a href="{{ route('admins.users.create') }}" class="btn btn-primary mb-4 text-center float-right">Create User</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">name</th>
              <th scope="col">email</th>
              <th scope="col">actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <th scope="row">{{ $user->id }}</th>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                <a href="{{ route('admins.users.edit', $user->id) }}" class="btn btn-warning text-white">Edit</a>
                <a href="{{ route('admins.users.delete', $user->id) }}" class="btn btn-danger">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
