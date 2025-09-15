 @extends('layouts.admin')

 @section('content')

 <div class="row">
   <div class="col">
     <div class="card">
       <div class="card-body">
         <h5 class="card-title mb-5 d-inline">Create Food Items</h5>
         <form method="POST" action="{{ route('store.food') }}" enctype="multipart/form-data">
           @csrf
           <!-- name input -->
           <div class="form-outline mb-4 mt-4">
             <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder=" name" value="{{ old('name') }}" />
             @error('name')
             <div class="invalid-feedback">
               {{ $message }}
             </div>
             @enderror

           </div>
           <div class="form-outline mb-4 mt-4">
             <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder=" price" value="{{ old('price') }}" />
             @error('price')
             <div class="invalid-feedback">
               {{ $message }}
             </div>
             @enderror
           </div>

           <div class="form-outline mb-4 mt-4">
             <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" />
             @error('image')
             <div class=" invalid-feedback">
               {{ $message }}
             </div>
             @enderror
           </div>

           <div class="form-group">
             <label for="exampleFormControlTextarea1">Description</label>
             <textarea class="form-control @error('description') is-invalid @enderror" name=" description" id="description" rows="3" value="{{ old('description') }}"></textarea>
             @error('description')
             <div class="invalid-feedback">
               {{ $message }}
             </div>
             @enderror
           </div>

           <div class="form-outline mb-4 mt-4">
             <select name="category" class="form-select  form-control @error('category') is-invalid @enderror" id="category" aria-label="Default select example" value="{{ old('category') }}">
               <option disabled selected>Choose Meal</option>
               <option value="Breakfast" {{ old('category') == 'Breakfast' ? 'selected' : '' }}>Breakfast</option>
               <option value="Launch" {{ old('category') == 'Launch' ? 'selected' : '' }}>Launch</option>
               <option value="Dinner" {{ old('category') == 'Dinner' ? 'selected' : '' }}>Dinner</option>
             </select>
             @error('category')
             <div class="invalid-feedback">
               {{ $message }}
             </div>
             @enderror
           </div>

           <br>



           <!-- Submit button -->
           <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


         </form>

       </div>
     </div>
   </div>
 </div>

 @endsection