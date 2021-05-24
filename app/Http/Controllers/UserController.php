<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Hash;
 

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user = null;
    protected $user_info = null;

     public function __construct(User $user , UserInfo $user_info)
     {
         $this->user = $user;
        $this->user_info = $user_info;
     }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         $rules = $this->user->validateUserData('add');
        $request->validate($rules);
        //dd($request->all());
        $data =  $request->except(['image','password']);
        //$data['passwowrd']= bcrypt($request->password);
        $data['password'] = Hash::make($request->password);
        if($request->image)
        {
            $image = uploadImage($request->image,'user', env('USER_THUMB_SIZE', '200x200'));
            if($image)
            {
                $data['image']=$image;
            }       
         }
         $this->user->fill($data);
         $status = $this->user->save();
         if($status)
         {
             $data['user_id']= $this->user->id;
             $this->user_info->fill($data);
             $this->user_info->save();
             $route_param = $this->user->role;
                $request->session()->flash('sucess','User Registered SucessFully');
         }
         else{
                $route_param = "all";
             $request->session()->flash('error','sorry!there was problem while adding user');
         }
         return redirect()->route('user.show', $route_param);
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
    public function update(Request $request, $id)
    {
         $this->validateId($id);
            $rules = $this->user->validateUserData('update');
            $request->validate($rules);
            $data= $request->except('image');
          if($request->image) 
          {
              $image = uploadImage($request->image,'user',env('USER_THUMB_SIZE', '200x200'));
              if($image)
              {
                  $data['image']=$image;
                  if(!empty($this->user->userInfo) && $this->user()->userInfo->image != null && file_exists(public_path('uploads/user/'.$this->user->userInfo->image)))

                    {
                        deleteImage($this->user->userInfo->image ,'user');
                  }
          } 
    }
        $this->user->fill($data);
    $status=    $this->user->save();
    if($status)
    {

        if($this->user->userInfo == null)
        {
                $this->user->userInfo = $this->user_info;

        }
         $data['user_id']= $this->user->id;
        $this->user->userInfo->fill($data);
        $this->user->userInfo->save();
            $request->session()->flash('success', 'User Updated Sucessfully.');

    }else {
            $request->session()->flash('error' ,'Sorry! There was Problem on updating Image');
    }
    return redirect()->back();
}

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function  destroy($id)
    {
        //
    }
    
    
    private function validateId($id)
    {
         $this->user = $this->user->find($id);
         if(!$this->user)
         {
             request()->session()->flash('error','User Not Found');
             return redirect()->back();
         }
    }

    public function changePassword(Request $request)
    {
            $this->validateId($request->id);
            $request->validate(['password'=>'required|string|confirmed|min:8']);
           // dd($request->all());

           $this->user->password = bcrypt($request->password);
           $status = $this->user->save();

           if($status)
           {
               $request->session()->flash('success','Password Changed sucessfully');
           }else {
            $request->session()->flash('error', 'Password doesnot match');
           }
        return redirect()->back();
    }
         }

               
