<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //

    public function registerload(){

        $data['users'] = User::all();



        return view('register', $data);
    }


    public function studentregister(Request $request){
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',
            'address' => 'required',
            'image' => ['image','mimes:jpeg,png,jpg,gif,fvg','max:2048'],
            'password' => ['string','required','confirmed','min:6']
            
        ]);
        
        $path = "";
        if($request->hasFile('image')){
            $path = $request->file('image')->store('category/subcategory');

            
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number'=>$request->number,
            'address' => $request->address,
            'image' => $path,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success','Register successfull');
        
        // if($request->image){
        //     $imageName = time().'.'.$request->image->extension();
        //     // $request->image->storeAs('public/photos',$imageName);
        //     $request->image->move(storage_path('app/public/category/subcategory'),$imageName);
        // }
       
        // $user = new User;

        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->number = $request->number;
        // $user->address = $request->address;
        // $user->image = $path;
        // $user->password = Hash::make($request->password);
        // $user->save();

        
    }

    // public function delete($id){
    //     $data = User::find($id);
    //     // $image_path = storage_path('app/public/photos/'.$data->image);
    //     $image_path = storage_path('app/public/'.$data->image);
        
    //     // dd($image_path);
        
    //     if(is_file($image_path)){

    //         // dd(is_file($image_path));
    //         unlink($image_path);
    //     }
    //     //is_file---check if it's a file// file_exis--- check if it's a file or directory
        
    //     $data->delete();
    //     return redirect()->back();
    // }

    
    // public function edit($id){
    //     $data = User::find($id);
    //     return view('edit',compact('data')) ;
    // }

    public function edit(User $user){
       $data['user'] = $user;
        return view('edit',$data) ;
    }



    public function update(Request $request, User $user){
       

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',
            'address' => 'required',
            'image' => ['image','mimes:jpeg,png,jpg,gif,fvg','max:2048'],
            'password' => ['string','required','confirmed','min:6']
            
        ]);
                    
                if($request->hasFile('image')){
                    $image = storage_path('app/public/'.$user->image);
                    if(File::exists($image)){
                        File::delete($image);
                    }
                    $user->image = $request->file('image')
                    ->store('category/subcategory');
                     }
                     $user->name = $request->name;
                     $user->email = $request->email;
                      $user->number = $request->number;
                      $user->address = $request->address;
                     $user->password = Hash::make($request->password);
           if( $user->update()){
            return redirect('register')->with('success','Update successfull');
           }
           
        
        
        

       
        // if($request->image){
        //     $destination = storage_path('app/public/category/subcategory/'.$user->image);
        //     // if(File::exists($destination)){
        //     //     File::delete($destination);
        //     // }
        //     if(is_file($destination)){
        //         File::delete($destination);
        //     }
        //     $imageName = time().'.'.$request->image->extension();
        //     // $request->image->storeAs('public/photos',$imageName);
        //     $request->image->move(storage_path('app/public/category/subcategory'),$imageName);
        //     $user->image = $imageName;
        //     $user->update(); 
        // }
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->number = $request->number;
        // $user->address = $request->address;
       
       
        // $user->password = Hash::make($request->password);
        // $user->update();
        // // $image_path = storage_path('app/public/category/subcategory/'.$user->image);
        
        
        
        // return redirect('register')->with('success','Update successfull');

    }

    public function delete(User $user){
       
        $image = storage_path('app/public/'.$user->image);
        // $image = $user->image;
        
        if(File::exists($image)){
            
           File::delete($image);
          
            
        }
        if($user->delete()){
            return redirect()->back();
        }
          
      }
}

