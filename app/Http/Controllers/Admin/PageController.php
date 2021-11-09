<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use App\Helpers\Helper;
class PageController extends Controller
{
    //
    
       public function index()
    {
        //
        $data = Page::orderBy('id','DESC')->paginate(10);

        return view('admin.pages.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $data = Page::all();

        return view('admin.pages.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $this->validate($request, [
            'title' => 'required',
        ]);

    
            $page = new Page();
        $page->title = $request->title;
        if($request->slug == ""){
            $page->slug = Helper::getBlogUrl($request->title);
          
        }else{
            $page->slug = $request->slug;
        }
            if($request->hasfile('page_image'))
            {
                $file = $request->file('page_image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename); 
                $page->image = $filename;  
            }
           
            $page->content = $request->content;
            $page->user_id = auth()->user()->id;
         $page->icon = $request->icon;
        $page->meta_title = $request->meta_title;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;
        $page->published = $request->published;
       
        $page->save();

if ($page->id) {
            return back()->with('flash_success', 'Page Created successfully');
        } else {
            return back()->with('flash_failure', 'Something went wrong');

        }
        
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
         $data = Page::find($id);
        return view('admin.pages.edit',compact('data'));
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
        //
        
          $this->validate($request, [
            'title' => 'required',
        ]);

//return $request->all();
      
       $page = Page::find($id);
          $page->title = $request->title;
        if($request->slug == ""){
            $page->slug = Helper::getBlogUrl($request->title);
          
        }else{
            $page->slug = $request->slug;
        }
       
        if($request->hasfile('page_image'))
        {
            @unlink(public_path('public/uploads/images/'.$page->image));
            $file = $request->file('page_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename); 
            $page->image= $filename;  
        }
       $page->content = $request->content;
            $page->user_id = auth()->user()->id;
          $page->icon = $request->icon;
        $page->meta_title = $request->meta_title;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;
        $page->published = $request->published;
       
        $page->save();
        return back()->with('flash_success', 'Page Updated successfully');
        
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
          $data = Page::find($id);
        @unlink(public_path('public/uploads/images/'.$data->image));
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
    
    
}
