<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        return view('backend.blog.index', \compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $requested_data = $request->all();
        // dd($requested_data);
        $model = new Blog();
        if ($request->hasFile('image')) {
            $image_upload = Image::make($request->file('image'))->resize(391, 236);
            $name         = 'blog_' . time() . '_' . Str::random(10) . '.' . "jpg";
            $image_upload->save('uploads/blog/' . $name);
            $requested_data = Arr::set($requested_data, 'image', $name);
        } else {
            $requested_data = Arr::set($requested_data, 'image', null);
        }
        // unique slug
        $now_slug = Str::slug($request->title);
        $count    = Blog::where('title', $request->title)->count();
        if ($count > 0) {
            $slug           = "{$now_slug}-" . ($count + 1);
            $requested_data = Arr::set($requested_data, 'slug', $slug);
        } else {
            $requested_data = Arr::set($requested_data, 'slug', $now_slug);

        }
        $requested_data = Arr::set($requested_data, 'created_by', auth()->user()->id);
        $requested_data = Arr::set($requested_data, 'updated_by', auth()->user()->id);
        // dd($requested_data);
        $model->fill($requested_data)->save();
        if ($model != null) {
            $notification = [
                'messege'    => 'Insert success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'insert Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }
    // active
    public function active($id)
    {
        $active = Blog::where('id', $id)->update([
            'status'     => 1,
            'updated_by' => auth()->user()->id,
        ]);
        if ($active) {
            $notification = [
                'messege'    => 'Active success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Active Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    // Deactive
    public function deactive($id)
    {
        $Deactive = Blog::where('id', $id)->update([
            'status'     => 0,
            'updated_by' => auth()->user()->id,
        ]);
        if ($Deactive) {
            $notification = [
                'messege'    => 'Deactive success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Deactive Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::where('id', $id)->first();
        return view('backend.blog.edit', \compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, $id)
    {
        $requested_data = $request->all();
        // dd($requested_data);
        $model = Blog::where('id', $id)->first();
        if ($request->hasFile('image')) {
            if (File::exists('uploads/blog/' . $model->image)) {
                File::delete('uploads/blog/' . $model->image);
            }
            $image_upload = Image::make($request->file('image'))->resize(391, 236);
            $name         = 'blog_' . time() . '_' . Str::random(10) . '.' . "jpg";
            $image_upload->save('uploads/blog/' . $name);
            $requested_data = Arr::set($requested_data, 'image', $name);
        } else {
            $requested_data = Arr::set($requested_data, 'image', $model->image);
        }
        // unique slug
        $now_slug = Str::slug($request->title);
        $count    = Blog::where('title', $request->title)->count();
        if ($count) {
            $slug           = "{$now_slug}-" . ($count);
            $requested_data = Arr::set($requested_data, 'slug', $slug);
        } else {
            $requested_data = Arr::set($requested_data, 'slug', $now_slug);
        }
        $requested_data = Arr::set($requested_data, 'created_by', auth()->user()->id);
        $requested_data = Arr::set($requested_data, 'updated_by', auth()->user()->id);
        // dd($requested_data);
        $model->fill($requested_data)->save();
        if ($model != null) {
            $notification = [
                'messege'    => 'Update success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Update Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $delete = Blog::where('id', $id)->update([
            'is_deleted' => 1,
            'updated_by' => auth()->user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
        if ($delete) {
            $notification = [
                'messege'    => 'Delete success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Delete Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
}
