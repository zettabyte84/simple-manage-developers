<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use File;
use Hash;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get();
        foreach ($user as $key => $value) {
            $image = $value->avatar;
            if($image==NULL) {
                $image_name = '765-default-avatar.png';
            }else if(file_exists("uploads/users/$image")) {
                $image_name = $image;
            }else {
                $image_name = '765-default-avatar.png';
            }
            $value->avatar = '/uploads/users/'.$image_name;
        }
        return view("user.list", [
            "users" => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.ing
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'first_name' => ['required', 'string', 'max:255'],
        //     'last_name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:developers'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'phone_number' => ['required', 'string', 'max:255'],
        // ]);
        // $id = $request->id;
        $first_name = $request->new_first_name;
        $last_name = $request->new_last_name;
        $phone_number = $request->new_phone_number;
        $email = $request->new_email;

        if($file = $request->hasFile('new_avatar')) {
             
            $file = $request->file('new_avatar') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/uploads/users' ;
            $file->move($destinationPath,$fileName);
            // return redirect('/uploadfile');
        }

        $password = Hash::make('test123');
        $insert = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'email' => $email,
            'password' => $password,
            'avatar' => $fileName,
        ];
        $user = User::insert($insert);
        
        // echo json_encode(
        //     [
        //     'success' => 200,
        //     ]
        // );
        $message = "Success";
        return redirect()->route('developers.list')
            ->with("notice", $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id_hidden;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $phone_number = $request->phone_number;

        $update = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
        ];
        
        if($file = $request->hasFile('avatar')) {
             
            $file = $request->file('avatar') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/uploads/users' ;
            $file->move($destinationPath,$fileName);
            // return redirect('/uploadfile');
            $update['avatar'] = $fileName;
        }
        // dd($update);
        $user = User::where('id',$id)->update($update);
        
        // echo json_encode(
        //     [
        //     'success' => 200,
        //     ]
        // );
        $message = "Success";
        return redirect()->route('developers.list')
            ->with("notice", $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        $message = "<strong>Notice!</strong> Ticket deleted successfully.
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>";

        return redirect()->route('developers.list')
            ->with("notice", $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete(Request $request)
    {
        $delete_check_box_value = $request->delete_check_box_value;
        $delete_check_box_value = explode('|',$delete_check_box_value);
        User::whereIn('id',$delete_check_box_value)->delete();

        $message = "<strong>Notice!</strong> Ticket deleted successfully.
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>";

        
        echo json_encode(
            [
            'success' => 200,
            ]
        );
    }
}
