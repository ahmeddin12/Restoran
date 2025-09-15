@extends('layouts.admin')

@section('content')

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Foods</h5>
        <a href="create-foods.html" class="btn btn-primary mb-4 text-center float-right">Create Foods</a>

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
              <td>{{$food->title}}</td>
              <td><img width="60" height="60" src="{{ asset('assets/img/' . $food->image) }}" alt="Food Image"></td>
              <td>${{$food->price}}</td>
              <td><a href="delete-posts.html" class="btn btn-danger  text-center ">delete</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection