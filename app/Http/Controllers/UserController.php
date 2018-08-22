<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Book;
use App\User;
use DB;
use File;
class UserController extends Controller
{
    public function index()
    {
        // $name = "Hello Mahesh";a
        // $users = DB::table('users')->get();
        $users = User::with('books')->get()->toArray();
        // $users = json_decode(json_encode($users),true);
        // echo "<pre>";
        // print_r($users);
        // die; 
        return view('first',['users'=>$users]);
    }
    public function userdata(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";
        // echo print_r($data);
        // die;
        if (!empty($data)) {
            $imgName="";
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $extenssion = $file->getClientOriginalExtension();
                if ($extenssion=='jpg' || $extenssion == 'png' || $extenssion == 'jpeg') {
                    $imgName = uniqid().$filename;
                    $destinationPath = public_path('/img/'); 
                    $file->move($destinationPath, $imgName);
                } else {
                    $request->session()->flash('alert-danger','file type not valid');
                    return redirect()->back();
                }
                // echo $imgName;
                // die;
            }
            try{
                // DB::table('users')->insert(['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$datau['email']]); 1>
                // $id = \DB::table('users')->insertGetId(['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email']]);2>
                // User::create(['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email']]); 3>tt
                // ---object method eloquent ---
                $user = new User();
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->mobile = $data['mobile'];
                $user->image = $imgName;
                $user->save();

                $book = new Book();
                $book->book = $data['book'];
                $book->user_id = $user->id;
                $book->save();

                // DB:: class method
                // DB::table('users')->insert([
                //     'name'=>$data['name'],
                //     'mobile'=>$data['mobile'],
                //     'email'=>$data['email']
                // ]);
            }catch(\Exception $e){
                $request->session()->flash('alert-danger', 'Registration failed.'.$e->getMessage());
                return redirect()->back();
            }
            // $message = $id.' '.'User added successfully';
            $message = 'User added successfully'; 
            $request->session()->flash('alert-success', $message );
            return redirect()->back();
        } else {
            $request->session()->flash('alert-danger', 'User added successfully');
            return redirect()->back();        
        }
        
        
    }
    public function edituser($id)
    {
        // echo $id;
        $id = convert_uudecode(base64_decode($id));
        // $userData = User::where('id',$id)->first()->toArray();
        $userData = DB::table('users')->where('id',$id)->first();
        $userData = json_decode(json_encode($userData),true);
        return view('edituser',['userData'=>$userData]);
        // echo "<pre>";
        // print_r($userData);
        // die;

    }
    public function updateuser(Request $request)
    {
        $data = $request->all();
        $imgName="";
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $extenssion = $file->getClientOriginalExtension();
                if ($extenssion=='jpg' || $extenssion == 'png' || $extenssion == 'jpeg') {
                    $oldimage = User::where('id',$data['user_id'])->value('image');
                    $fullpath = public_path('/img/').$oldimage;
                    File::delete($fullpath);

                    $imgName = uniqid().$filename;
                    $destinationPath = public_path('/img/'); 
                    $file->move($destinationPath, $imgName);
                } else {
                    $request->session()->flash('alert-danger','file type not valid');
                    return redirect()->back();
                }
                // echo $imgName;
                // die;
            }
            else{
                $imgName = User::where('id',$data['user_id'])->value('image');
            }
        try{
            // User::where('id',$data['user_id'])->update(['name'=>$data['name'],'mobile'=>$data['mobile'],
            // 'email'=>$data['email']]);
            DB::table('users')->where('id',$data['user_id'])->update(['name'=>$data['name'],'mobile'=>$data['mobile'],
            'email'=>$data['email'], 'image'=>$imgName]);
            $request->session()->flash('alert-success','User updated successfully.');
        }catch(\Exception $e){
            $request->session()->flash('alert-danger','User updation failed.');
        }        
        return redirect()->to('/');
    }
    public function deleteuser(Request $request, $id)
    { 
        $id = convert_uudecode(base64_decode($id));
        try{
            // User::where('id',$id)->delete();
            DB::table('users')->where('id',$id)->delete();
            $request->session()->flash('alert-success','User deleted successfully.');
        }catch(\Exception $e){
            $request->session()->flash('alert-danger','User deletion failed');
        }        
        return redirect()->back();
    }
}
