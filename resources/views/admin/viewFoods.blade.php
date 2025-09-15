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
        <h5 class="card-title mb-4 d-inline">Foods</h5>
        <a href="{{route('create.food')}}" class="btn btn-primary mb-4 text-center float-right">Create Foods</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">name</th>
              <th scope="col">image</th>
              <th scope="col">price</th>
              <th scope="col">delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($foods as $food)
            <tr>
              <td scope="row">1</td>
              <td>{{$food->name}}</td>
              <td><img width="60" height="60" src="{{ asset('assets/img/' . $food->image) }}" alt="Food Image"></td>
              <td>${{$food->price}}</td>
              <td><a href="{{route('delete.food', $food->id)}}" class="btn btn-danger  text-center ">delete</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection