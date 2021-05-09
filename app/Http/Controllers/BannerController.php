<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Banner;

 
class BannerController extends Controller
{

    protected $banner = null;
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->banner = $this->banner->get();
        return view('admin.banner.index')->with('data', $this->banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       return view('admin.banner.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $rules= $this->banner->getRules('add');
        $request->validate($rules);
 
       $data = $request->except('image');
            if($request->image)
            {
                $img_name = uploadImage($request->image,'banner',env('BANNER_THUMB_SIZE','1200x760'));
                $data['image']= $img_name;
            }      
            
            $data['created_by'] = $request->user()->id;
            $this->banner->fill($data);
            $status= $this->banner->save();
            if($status)
            {
                $request->session()->flash('success','Banner Created sucessfully');
            }
            else
            {
                  $request->session()->flash('error', 'Sorry!! There was Problem while creating Banner');
            }
                return redirect()->route('banner.index');
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
        $this->validateId($id);
        return view('admin.banner.form')->with('detail', $this->banner);
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
        $rules= $this->banner->getRules('update');
        $request->validate($rules);
 
       $data = $request->except('image');
            if($request->image)
            {
                $img_name = uploadImage($request->image,'banner',env('BANNER_THUMB_SIZE','1200x760'));
                $data['image']= $img_name;
                if($this->banner->imsge != null)
                {
                    deleteImage($this->banner->image, 'banner');
                }
            }      
            
    
            $this->banner->fill($data);
            $status= $this->banner->save();
            if($status)
            {
                $request->session()->flash('success','Banner Updated sucessfully');
            }
            else
            {
                  $request->session()->flash('error', 'Sorry!! There was Problem while Updating Banner');
            }
                return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function destroy($id)
    {
       $this->validateId($id);
       $image_name = $this->banner->image;
       $del = $this->banner->delete();
       if($del)
     {
            if($image_name != null)
            {
                deleteImage($image_name ,'banner');
            }
           request()->session()->flash('success','Banner Deleted Sucessfully');
       }
       else
       {
           request()->session()->flash('error','Sorry! There was problem while Deleting Banner');
       }
       return redirect()->back();
    }


    public function validateId($id)
    {
        $this->banner = $this->banner->find($id);
        if(!$this->banner)
        {
            request()->session()->flash('error','Sorry! Invalid Id');
            return redirect()->back();
        }

    }
}
