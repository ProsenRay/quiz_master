@extends('layouts.app')

@section('content')

   <div class="card ">
      <div class="card-body">

         @if (Session::has('success')) 

            <p class="alert alert-success">{{Session::get('success')}}</p>
            
        @endif
         @if ($errors->any())
         <div class="alert alert-danger">
            <ul>
                  @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                  @endforeach
            </ul>
         </div>
         @endif
         <form action="{{route('update', $data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="text" name="name" placeholder="Enter your Name" value="{{$data->name}}">
            <br>
            {{-- @error('name')
             <span class="alert-danger">{{ $message }}</span>
            @enderror --}}
            <br>
            <input type="email" name="email" placeholder="Enter your Email" value="{{$data->email}}">
            <br><br>
            <input type="text" name="number" placeholder="Enter your Number" value="{{$data->number}}">
            <br><br>
            <input type="text" name="address" placeholder="Enter your Address" value="{{$data->address}}">
            <br><br>
            <input type="file" name="image" placeholder="Enter your Image" value="">
            <img style="width:20px" src="{{asset('storage/category/subcategory/'.$data->image)}}" alt="">
            <br><br>
            <input type="password" name="password" placeholder="Enter your Passwor" value="{{$data->password}}">
            <br><br>
            <input type="password" name="password_confirmation" placeholder="Enter your Password" value="{{$data->password}}">
            <br><br>
    
            <input type="submit" value="Update">
    
         </form>
      </div>
      
   </div>

   @endsection