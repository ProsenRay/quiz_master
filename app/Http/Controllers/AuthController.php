<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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
        
        $imageName = "";
        if($request->image){
            $imageName = time().'.'.$request->image->extension();
            // $request->image->storeAs('public/photos',$imageName);
            $request->image->move(storage_path('app/public/category/subcategory'),$imageName);
        }
        
        

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->number = $request->number;
        $user->address = $request->address;
        $user->image = $imageName;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success','Register successfull');
    }

    public function delete($id){
        $data = User::find($id);
        // $image_path = storage_path('app/public/photos/'.$data->image);
        $image_path = storage_path('app/public/category/subcategory/'.$data->image);
        // dd($image_path);
        

        if(is_file($image_path)){
            unlink($image_path);
        }
        //is_file---check if it's a file// file_exis--- check if it's a file or directory
        
        $data->delete();

       
        return redirect()->back();


    }

    public function edit($id){
        $data = User::find($id);
        return view('edit',compact('data')) ;
    }

    public function update(Request $request, $id){
       

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',
            'address' => 'required',
            'image' => ['image','mimes:jpeg,png,jpg,gif,fvg','max:2048'],
            'password' => ['string','required','confirmed','min:6']
            
        ]);
        
        

        $user = User::find($id);
       
        if($request->image){
            $destination = storage_path('app/public/category/subcategory/'.$user->image);
            // if(File::exists($destination)){
            //     File::delete($destination);
            // }
            if(is_file($destination)){
                File::delete($destination);
            }
            $imageName = time().'.'.$request->image->extension();
            // $request->image->storeAs('public/photos',$imageName);
            $request->image->move(storage_path('app/public/category/subcategory'),$imageName);
            $user->image = $imageName;
            $user->update(); 
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->number = $request->number;
        $user->address = $request->address;
       
       
        $user->password = Hash::make($request->password);
        $user->update();
        // $image_path = storage_path('app/public/category/subcategory/'.$user->image);
        
        
        
        return redirect('register')->with('success','Update successfull');

    }
}

