<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Brand;

 
class BrandController extends Controller
{

    protected $brand = null;
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->brand = $this->brand->get();
        return view('admin.brand.index')->with('data', $this->brand);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       return view('admin.brand.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $rules= $this->brand->getRules('add');
        $request->validate($rules);
 
       $data = $request->except('image');
            if($request->image)
            {
                $img_name = uploadImage($request->image,'brand',env('BANNER_THUMB_SIZE','1200x760'));
                $data['image']= $img_name;
            }      
            
            $data['created_by'] = $request->user()->id;
            $this->brand->fill($data);
            $status= $this->brand->save();
            if($status)
            {
                $request->session()->flash('success','Brand Created sucessfully');
            }
            else
            {
                  $request->session()->flash('error', 'Sorry!! There was Problem while creating Brand');
            }
                return redirect()->route('brand.index');
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
        return view('admin.brand.form')->with('detail', $this->brand);
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
        $rules= $this->brand->getRules('update');
        $request->validate($rules);
 
       $data = $request->except('image');
            if($request->image)
            {
                $img_name = uploadImage($request->image,'brand',env('BANNER_THUMB_SIZE','1200x760'));
                $data['image']= $img_name;
                if($this->brand->imsge != null)
                {
                    deleteImage($this->brand->image, 'brand');
                }
            }      
            
    
            $this->brand->fill($data);
            $status= $this->brand->save();
            if($status)
            {
                $request->session()->flash('success','Brand Updated sucessfully');
            }
            else
            {
                  $request->session()->flash('error', 'Sorry!! There was Problem while Updating Brand');
            }
                return redirect()->route('brand.index');
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
       $image_name = $this->brand->image;
       $del = $this->brand->delete();
       if($del)
     {
            if($image_name != null)
            {
                deleteImage($image_name ,'brand');
            }
           request()->session()->flash('success','Brand Deleted Sucessfully');
       }
       else
       {
           request()->session()->flash('error','Sorry! There was problem while Deleting Brand');
       }
       return redirect()->back();
    }


    public function validateId($id)
    {
        $this->brand = $this->brand->find($id);
        if(!$this->brand)
        {
            request()->session()->flash('error','Sorry! Invalid Id');
            return redirect()->back();
        }

    }
}
