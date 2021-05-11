<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\BrandCategory;

class CategoryController extends Controller
{
    protected $category, $brand , $brand_cats = null;


    public function __construct(Category $cat , Brand $brand , BrandCategory $brand_cats)
    {
        $this->category = $cat;
        $this->brand = $brand;
        $this->brand_cats  = $brand_cats ; 
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->category = $this->category->getAllParent();
        return view('admin.category.index')->with('data',$this->category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->category = $this->category->getParentCatsDrop();
        $this->brand = $this->brand->pluck('title','id');
        return view('admin.category.form')
        ->with('parent_cats',$this->category)
        ->with('brand_data',$this->brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->category->getValidationRule();
        $request->validate($rules);

        $data = $request->except('image');
        $data['slug'] = $this->category->getSlug($request->title);
     if($request->image)
     {
         $image = uploadImage($request->image,'category',env('CATEGORY_THUMB_SIZE','500x500'));
         if($image)
         {
             $data['image'] = $image;
         }
     }
            $data['created_by'] = $request->user()->id;
            $this->category->fill($data);
            $status = $this->category->save();
            if($status)
            {
                if($request->brand_id)
                {
                    $temp = array();
                    foreach($request->brand_id as $ids)
                    {
                        $temp[] = array(
                        'brand_id'=>$ids,
                        'category_id'=>$this->category->id );
                    }
                    $this->brand_cats->insert($temp);

                }
                $request->session()->flash('success',"Category Created SUccessFully");
            }else{
                $request->session()->flash('error',"Sorry!There is problem while creating category");
            }
            return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($p_id)
    {
        $this->validateId($p_id);
        if($this->category->parent_id != null)
        {
            request()->session()->flash('error','Sorry! This is Child Category');
            return redirect()->back();
        }
        return view('admin.category.sub-cat')->with('data',$this->category);
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
        $parents = $this->category->getParentCatsDrop();
        $this->brand = $this->brand->pluck('title','id');
        return view('admin.category.form')
        ->with('parent_cats',$parents)
        ->with('brand_data',$this->brand)
        ->with('data' , $this->category);
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
        $rules = $this->category->getValidationRule();
        $request->validate($rules);

        $data = $request->except('image');
     if($request->image)
     {
         $image = uploadImage($request->image,'category',env('CATEGORY_THUMB_SIZE','500x500'));
         if($image)
         {
             $data['image'] = $image;

             if($this->category->image != null && file_exists(public_path('uploads/category/'.$this->category->image)))
             {
                 deleteImage($this->category->image ,'category');
             }
         }
     }
            $this->category->fill($data);
            $status = $this->category->save();
            if($status)
            {
                $this->brand_cats->where('category_id',$this->category->id)->delete();

                if($request->brand_id)
                {
                    $temp = array();
                    foreach($request->brand_id as $ids)
                    {
                        $temp[] = array(
                        'bramd_id'=>$ids,
                        'category_id'=>$this->category->id );
                    }
                    $this->brand_cats->insert($temp);

                }
                $request->session()->flash('success',"Category Updated SUccessFully");
            }else{
                $request->session()->flash('error',"Sorry!There is problem while updating category");
            }
            return redirect()->route('category.index');
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
        $old_parents = $this->category->parent_id;
        $image = $this->category->image;
        $del = $this->category->delete();
        if($del)
        {
            //Category::where('parent_id',$id)->update(['parent_id'=>$old_parents]);
            if($image != null)
            {
                deleteImage($image , 'category');
            }
            request()->session()->flash('success','Category Deleted Sucessfully');
        }
        else
        {
            request()->session()->flash('error','Sorry! There Was problem While Deleting .');
        }
        return redirect()->back();
    }

    public function validateId($id)
    {
        $this->category = $this->category->find($id);
        if(!$this->category)
        {
            request()->session()->flash('error','Sorry! Invalid Id');
            return redirect()->back();
        }
    }
}