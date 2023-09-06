<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->select(['id','title','slug','updated_at','category_image'])->paginate(5);
        // return $categories;
        return view('backend.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
         $category = Category::create([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
        ]);

        $this->image_upload($request, $category->id);
        // dd($request->all());

        Toastr::success('Category created successfully');
        return redirect()->route('category.index');
    }

    function image_upload($request, $item_id){
        $category = Category::findorFail($item_id);

        if($request->hasFile('category_image')){
            // dd($request->all());
            if($category->category_image !='default-image.jpg'){
                $photo_location = 'public/uploads/category/';
                $old_photo_location = $photo_location.$category->category_image;
                unlink(base_path($old_photo_location));

            }
            $photo_location = 'public/uploads/category/';
            $uploaded_photo = $request->file('category_image');
            $new_photo_name = $category->id.'.'.$uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location.$new_photo_name;
            Image::make($uploaded_photo)->resize(105,105)->save(base_path($new_photo_location),40);
            $check = $category->update([
                'category_image' => $new_photo_name,
            ]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        // $category = Category::findOrFail($id);  //if work with id
        // $category = Category::where( 'slug',$id)->first();
        $category = Category::whereSlug($slug)->first();
        // return $category;
        return view('backend.pages.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $slug)
    {
      
        $category = Category::whereSlug($slug)->first();

        $category->update([
            'title'=>$request->title,

            'slug'=>Str::slug($request->title),
            'is_active'=>$request->filled('is_active')
        ]);
        // return back()->with('success','Category created successfully');

        $this->image_upload($request, $category->id);
        Toastr::success('Category update successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $category = Category::whereSlug($slug)->first();

        if($category->category_image){
            $photo_location = 'uploads/category/'.$category->category_image;
            unlink($photo_location);
        }
        $category->delete();

        Toastr::success('Category delete successfully');
        return redirect()->route('category.index');
    }
}
