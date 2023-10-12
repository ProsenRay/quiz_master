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
         <form action="{{route('studentregister')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Enter your Name" value="">
            <br>
            @error('name')
             <span class="alert-danger">{{ $message }}</span>
            @enderror
            <br>
            <input type="email" name="email" placeholder="Enter your Email" value="">
            <br><br>
            <input type="text" name="number" placeholder="Enter your Number" value="">
            <br><br>
            <input type="text" name="address" placeholder="Enter your Address" value="">
            <br><br>
            <input type="file" name="image" placeholder="Enter your Image" value="">
            <br><br>
            <input type="password" name="password" placeholder="Enter your Passwor" value="">
            <br><br>
            <input type="password" name="password_confirmation" placeholder="Enter your Password" value="">
            <br><br>
    
            <input type="submit" value="Register">
    
         </form>
      </div>
      
   </div>
   


   <div style="margin-top:10px">
      <table>
         <tr>
           <th>Name</th>
           <th>Email</th>
           <th>Number</th>
           <th>Adderss</th>
           <th>Image</th>
           <th>Action</th>
         </tr>
         @forelse ( $users as $user )
            
         <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->number}}</td>
            <td>{{$user->address}}</td>
            <td><img style="width:20px" src="{{asset('storage/'.$user->image)}}" alt=""></td>
            
            <td >
               <a href="{{route('edit', $user->id)}}">Edit</a>
               {{-- <a href="{{route('delete', $user->id)}}">Delete</a> --}}

               <form action="{{route('delete', $user->id)}}" method="psot">
                  @csrf
                  @method('DELETE')
                  <input type="submit" value="Delete">
               </form>
               
            </td>
            
            
          </tr>
          @empty
         @endforelse
         
         
       </table>
   </div>

@endsection