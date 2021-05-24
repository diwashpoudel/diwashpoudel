<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\models\Product;
use App\models\ProductImage;

class ProductController extends Controller
{
    protected $category = null;
    protected $user = null;
    protected $product = null;
    protected $productImage = null;
    
    
    public function __construct(Category $cats , User $user  , Product $product , ProductImage $productImage)  
     {
            $this->category = $cats ;
            $this->user = $user;
            $this->product = $product;
            $this->productImage = $productImage;
             
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->product = $this->product->get();
        return view('admin.product.index')->with('data',$this->product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seller = $this->user->getUserByType('seller');
        $parents_cats = $this->category->getParentCatsDrop();
        return view('admin.product.form')
        ->with('category_data',$parents_cats)
        ->with('seller',$seller->pluck('name','id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $rules = $this->product->getValidationRules();
       $request->validate($rules);
       $data = $request->except('image');
       $data['slug']= $this->product->getSlug($request->title);
       $data['created_by']=$request->user()->id;
       $data['actual_cost'] = $request->price - (($request->price * $request->discount )/ 100);
       // dd($request->all());
       $this->product->fill($data);
       $status = $this->product->save();
       if($status)
       {
           if($request->image)
           {
               foreach($request->image as $uploaded_image)
               {
                   $image = uploadImage($uploaded_image,'product',env("PRODUCT_THUMB_SIZE",'500x768'));
                   if($image)
                   {
                       $productImage = new productImage();
                       $productImage->fill([
                            'product_id'=>$this->product->id,
                            'name'=>$image
                       ]);
                       $productImage->save();
                   }
               }
           }
           $request->session()->flash('success','product added successfully');
       }else
       {
           $request->session()->flash('error','Sorry! There Was Problem While Adding Product');
       }
       return redirect()->route('product.index');
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
        $seller = $this->user->getUserByType('seller');
        $parents_cats = $this->category->getParentCatsDrop();
        return view('admin.product.form')
        ->with('category_data',$parents_cats)
        ->with('seller',$seller->pluck('name','id'))
        ->with('detail',$this->product);
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
        $rules = $this->product->getValidationRules('update');
        $request->validate($rules);
        $data = $request->except('image');
        
        $data['actual_cost'] = $request->price - (($request->price * $request->discount )/ 100);
        // dd($request->all());
        $this->product->fill($data);
        $status = $this->product->save();
        if($status)
        {
            if($request->image)
            {
                foreach($request->image as $uploaded_image)
                {
                    $image = uploadImage($uploaded_image,'product',env("PRODUCT_THUMB_SIZE",'500x768'));
                    if($image)
                    {
                        $productImage = new productImage();
                        $productImage->fill([
                             'product_id'=>$this->product->id,
                             'name'=>$image
                        ]);
                        $productImage->save();
                    }
                }
            }

            if(isset($request->del_image))
            {
                $this->productImage->whereIn('name' , $request->del_image)->delete();
                foreach($request->del_image as $del_image)
                {
                   
                    deleteImage($del_image,'product');
                }
            }
            $request->session()->flash('success','product updated successfully');
        }else
        {
            $request->session()->flash('error','Sorry! There Was Problem While updating Product');
        }
        return redirect()->route('product.index');
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
       $images = $this->product->getImages;
       $del = $this->product->delete();
       if($del)
     {
            if($images != null)
            {
                foreach($images as $image_name)
                {
                    deleteImage($image_name->name,'product');
                }
               
            }
           request()->session()->flash('success','Product Deleted Sucessfully');
       }
       else
       {
           request()->session()->flash('error','Sorry! There was problem while Deleting Product');
       }
       return redirect()->back();
    }

     public function validateId($id)
    {
        $this->product = $this->product->find($id);
        if(!$this->product)
        {
            request()->session()->flash('error','Sorry! Invalid Id');
            return redirect()->back();
        }

    }
}
