<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Course;
use App\Lesson;

use File;
use App\Helpers\Helper;
use App\Lessons_media;
use App\Course_timeline;
use Carbon\Carbon;
use App\Lessons_video_media;

class LiveLessonsController extends Controller
{
       public function index()
    {

     
          $users = User::where('role_id',2)->get();
      $category = Lesson::orderby('id','DESC')->get();
      //return $category;
        return view('admin.livelessons.index', compact('users','category'));
    }
     public function create()
    {
             $teachers = User::where('role_id',2)->orderby('id','DESc')->get();
             $category = Course::where('type','live class')->orderby('id','DESC')->get();

        return view('admin.livelessons.create',compact('teachers','category'));
    }

    public function store(Request $request)
    {
        //echo "<pre>";print_r($_REQUEST);exit();
  /*$request->validate([
               'downloadable_files' => 'mimes:jpeg,bmp,png,jpg',     
        'add_pdf' => 'mimes:csv,txt,xlx,xls,pdf,doc|max:2048',
        'add_audio'=>'mimes:mp4,mp3',
        ]);
    */
    $data=$request->all();
    
        if (Lesson::where('title', '=', $request->title)->count() > 0)
        {
           return back()->with('flash_error', 'Lesson Already exists');
        }
        else
        {

              //$Lesson = Lesson::create($request->all());
          $Lesson = Lesson::create($request->except('downloadable_files', 'lesson_image')
            + ['position' => Lesson::where('course_id', $request->course_id)->max('position') + 1]);
                
                    if($request->hasfile('lesson_image'))
            {
                $file = $request->file('lesson_image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/lessons'),$filename); 
                 $Lesson->lesson_image = $filename;  
            }
               // $Lesson->save();

         


          if (($request->slug == "") || $request->slug == null) {
            
               $Lesson->slug = Helper::getBlogUrl($request->title);
               //dd($lesson->slug);
           // $Lesson->save();
        }else{
            $Lesson->slug = Helper::getBlogUrl($request->slug);
          
           // $Lesson->save(); 
        }

        $sequence = 1;

        if ($ct=Course_timeline::where('course_id','=',$Lesson->course_id)->count() > 0) {
           $sequence= Course_timeline::where('course_id','=',$Lesson->course_id)->max('sequence');
          //  $sequence = $ct->('sequence');
            //return $sequence;
            $sequence = $sequence + 1;
        }

        if ($Lesson->published == 1) {
            $timeline = Course_timeline::
                where('lesson_id', '=', $Lesson->id)
                ->where('course_id', $request->course_id)->first();
            if ($timeline == null) {
                $timeline = new Course_timeline();
            }
            $timeline->course_id = $request->course_id;
            $timeline->lesson_id = $Lesson->id;
           
            $timeline->sequence = $sequence;
            $timeline->save();
        }   

  if($request->hasfile('downloadable_files'))
                {
                    $imgCount = 0;
                    foreach($request->file('downloadable_files') as $image)
                    {
                        $imgCount++;
                        $name=time().uniqid(). '.' . $image->getClientOriginalName();
                        $path=$image->move(public_path().'/uploads/downloadable_files/', $name);  
                        $data[] = $name;

                        $product_images= new Lessons_media();
                        $product_images->lesson_id = $Lesson->id;
                        $product_images->filename = $name;
                        $product_images->name= 'downloadable_files';
                        $product_images->url= $path;
                        
                        $product_images->save();  
                    }
                }

              

       $fileModel = new Lessons_media;

        if($request->hasfile('add_pdf')){
        $file=$request->file('add_pdf');
        $extension=$file->getClientOriginalExtension();
        $filename2=mt_rand(15, 50) . time().'.'.$extension;
        $path2=$file->move(public_path().'/uploads/lessons/pdf/',$filename2);

        $fileModel->filename=$filename2;
        $fileModel->lesson_id=$Lesson->id;
        $fileModel->url=$path2;
        $fileModel->name='add_pdf';
        $fileModel->save();
        }
        $request->add_audio;
        
        
       
        
        

        if($request->type=='red'){
    $type='youtube';
    $video_url=$request->url1;
}elseif($request->type='green'){
    $type='embed';
 $video_url=$request->url2;
}else{
    $type='upload';
     $video_url=$request->url3;
}
                 $media=new Lessons_media;
                 $media->url = $video_url;
                 $media->name=$type;
                 $media->lesson_id= $Lesson->id;
                 $media->save();
$Lesson->save(); 

 /*if($request->hasfile('add_pdf'))
                {
                    $imgCount = 0;
                    foreach($request->file('add_pdf') as $file)
                    {
                        $imgCount++;
                       // $name=time().uniqid(). '.' . $image->getClientOriginalName();
                        //$path=$image->move(public_path().'/uploads/downloadable_files/', $name);  
                    //    $data[] = $name;

                    $extension=$file->getClientOriginalExtension();
                  $filename2=mt_rand(15, 50) . time().'.'.$extension;
                  $path2=$file->move(public_path().'/uploads/lessons/pdf/',$filename2);
                  $data[] = $filename2;

                        $product_images= new Lessons_media();
                        $product_images->lesson_id = $Lesson->id;
                        $product_images->filename = $filename2;
                        $product_images->name= 'add_pdf';
                        $product_images->url= $path2;
                        
                        $product_images->save();  
                    }
                }

   */             
                	$video_title = $data['video_title'];
            $link= $data['video_link'];
          $short_desc= $data['video_short_desc'];
            if (count($video_title)) {
                //echo 'count';
                foreach($video_title as $key => $input) {
                    //echo 'for';
                    if ($video_title[$key]!=null && $short_desc[$key]!=null && $link[$key]!=null ) {
                       // return $link[$key];
                        
                        $products = new Lessons_video_media();
                        
                       $products->video_link= $link[$key];
                       $products->video_title = $video_title[$key];
                       
                          $products->video_short_desc = $short_desc[$key];
                       $products->type	='video';
                        $products->lesson_id = $Lesson->id;
                        $products->save();
                  //      
                    }
                    //return ;
                }
                //return ;
            }
            
                
                return back()->with('flash_success', ' Created successfully');
            }
        
    }


    public function destroy($id)
    {
        $data = Lesson::findOrFail($id);
        

        $product_images = Lessons_media::where('lesson_id',$id)->where('name','=','downloadable_files')->get();
        
        foreach ($product_images as $product_image) {
            @unlink(public_path('/uploads/downloadable_files/'.$product_image->filename));
            $product_image->delete();
        }

        $product_images1 = Lessons_media::where('lesson_id',$id)->where('name','=','add_pdf')->get();
        foreach ($product_images1 as $product_image) {
            @unlink(public_path('/uploads/lessons/pdf/'.$product_image->filename));
            $product_image->delete();
        }
      
         $product_images2 = Lessons_media::where('lesson_id',$id)->where('name','=','add_audio')->get();
        foreach ($product_images2 as $product_image) {
            @unlink(public_path('/uploads/lessons/audio/'.$product_image->image));
            $product_image->delete();
        }
        $data1=Course_timeline::where('lesson_id','=',$id)->get();
         foreach ($data1 as $productPrice) {
            $productPrice->delete();
        }
        $data->delete();
        return back()->with('flash_success', 'Lessons Deleted  Successfully!');
    }

      public function edit(Request $request,$id)
    {
        //$lessons = Lesson::where('id',$id)->get();
        $lessons_media = Lessons_media::where('lesson_id',$id)->get();
        $lessons_video = Lessons_video_media::where('lesson_id',$id)->get();
        $data = Lesson::findOrFail($id);
        $course = Course::all();
       
        return view('admin.livelessons.edit',compact('data','lessons_media','course','lessons_video'));
    }

public function update(Request $request, $id)
   {
       
       
//     dd($_REQUEST);
        $Lesson = Lesson::findOrFail($id);
      $Lesson->update($request->except('downloadable_files'));
        
        if (($request->slug == "") || $request->slug == null) {
           $Lesson->slug = Helper::getBlogUrl($request->title);
          
           // $Lesson->save();
        }else{
            $Lesson->slug = Helper::getBlogUrl($request->slug);
          
            //$course->save(); 
        }
        
        if($request->hasfile('lesson_image'))
        {
            @unlink(public_path('uploads/lessons'.$Lesson->lesson_image));
            $file = $request->file('lesson_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/lessons'),$filename); 
            $Lesson->lesson_image = $filename;  
        }
             $Lesson->save();
         $sequence = 1;

        if ($ct=Course_timeline::where('course_id','=',$Lesson->course_id)->count() > 0) {
           $sequence= Course_timeline::where('course_id','=',$Lesson->course_id)->max('sequence');
          //  $sequence = $ct->('sequence');
            //return $sequence;
            $sequence = $sequence + 1;
        }

if ($Lesson->published == 1) {
            $timeline = Course_timeline::
                where('lesson_id', '=', $Lesson->id)
                ->where('course_id', $request->course_id)->first();
            if ($timeline == null) {
                $timeline = new Course_timeline();
            }
            $timeline->course_id = $request->course_id;
            $timeline->lesson_id = $Lesson->id;
           
            $timeline->sequence = $sequence;
            $timeline->save();
        }   

  if($request->hasfile('downloadable_files'))
                {
                    $imgCount = 0;
                    foreach($request->file('downloadable_files') as $image)
                    {
                        $imgCount++;
                        $name=time().uniqid(). '.' . $image->getClientOriginalName();
                        $path=$image->move(public_path().'/uploads/downloadable_files/', $name);  
                        $data[] = $name;

                        $product_images= new Lessons_media();
                        $product_images->lesson_id = $Lesson->id;
                        $product_images->filename = $name;
                        $product_images->name= 'downloadable_files';
                        $product_images->url= $path;
                        
                        $product_images->save();  
                    }
                }

              
        $fileModel = new Lessons_media;
 

     if($request->hasfile('add_pdf')){
       $file=$request->file('add_pdf');
        $extension=$file->getClientOriginalExtension();
        $filename2=mt_rand(15, 50) . time().'.'.$extension;
        $path2=$file->move(public_path().'/uploads/lessons/pdf/',$filename2);

        //@unlink(public_path().'/uploads/lessons/pdf/'.$request->oldpdf);
           // $file=$request->file('add_pdf');
           // $filename2 = uniqid() . '.' . $file->getClientOriginalExtension($file);
           //$path2=$file->move(public_path('/uploads/lessons/pdf/'),$filename2); 
          // $path2=$file->move(public_path().'/uploads/lessons/pdf/',$filename2);*/
      $fileModel->filename=$filename2;
        $fileModel->lesson_id=$Lesson->id;
        $fileModel->url=$path2;
        $fileModel->name='add_pdf';
        $fileModel->save();

               }
       
 


        //$request->add_audio;
      /*   if($request->hasFile('add_audio')){
         
       
         $uniqueid=uniqid();
         $music_file = $request->file('add_audio');

    
    $filename3 = $music_file->getClientOriginalExtension();

    
    $location = public_path('uploads/lessons/audio/' . $filename3);

   $path3= $music_file->move($location,$filename3);


        $fileModel2 = new Lessons_media;
          $fileModel2->filename=$filename3;
        $fileModel2->lesson_id=$Lesson->id;
        $fileModel2->url=$path3;
        $fileModel2->name='add_audio';
        $fileModel2->save();
        }
*/
        if($request->type=='red'){
    $type='youtube';
    $video_url=$request->url1;
}elseif($request->type='green'){
    $type='embed';
 $video_url=$request->url2;
}else{
    $type='upload';
     $video_url=$request->url3;
}
                $media= Lessons_media::find($request->media_id);

                 $media->url = $video_url;
                 $media->name=$type;
                 $media->lesson_id= $Lesson->id;
                 $media->save();
$Lesson->save(); 
                
            if($request->hasfile('add_pdf'))
                {
                    $imgCount = 0;
                    foreach($request->file('add_pdf') as $file)
                    {
                        $imgCount++;
                       // $name=time().uniqid(). '.' . $image->getClientOriginalName();
                        //$path=$image->move(public_path().'/uploads/downloadable_files/', $name);  
                    //    $data[] = $name;

                    $extension=$file->getClientOriginalExtension();
                  $filename2=mt_rand(15, 50) . time().'.'.$extension;
                  $path2=$file->move(public_path().'/uploads/lessons/pdf/',$filename2);
                  $data[] = $filename2;

                        $product_images= new Lessons_media();
                        $product_images->lesson_id = $Lesson->id;
                        $product_images->filename = $filename2;
                        $product_images->name= 'add_pdf';
                        $product_images->url= $path2;
                        
                        $product_images->save();  
                    }
                }

       return back()->with('flash_success', ' Updated successfully');

   }
  

 public function deleteMultipleVideos(Request $request)
    {
       // return 'a';
        $id = $_REQUEST['id'];
        $data = Lessons_video_media::find($id);
      $delete = Lessons_video_media::where('id',$id)->delete();
                 return back()->with('flash_success', 'Video Deleted Successfully!');
       
    }
    
 public function deleteMultipleDownload(Request $request)
    {
       // return 'a';
       $id = $_REQUEST['id'];
        $data = Lessons_media::find($id);
      $delete = Lessons_media::where('id',$id)->delete();
                 return back()->with('flash_success', 'Video Deleted Successfully!');
       
    }

 public function deleteMultiplePdf(Request $request)
    {
       // return 'a';
        $id = $_REQUEST['id'];
        $data = Lessons_media::find($id);
      $delete = Lessons_media::where('id',$id)->delete();
                 return back()->with('flash_success', 'Video Deleted Successfully!');
       
    }

      public function addMoreVideo(Request $request)
    {
          $data = $request->all();
                 	$video_title = $data['video_title'];
            $link= $data['video_link'];
          $short_desc= $data['video_short_desc'];
            if (count($video_title)) {
                //echo 'count';
                foreach($video_title as $key => $input) {
                    //echo 'for';
                    if ($video_title[$key]!=null && $short_desc[$key]!=null && $link[$key]!=null ) {
                       // return $link[$key];
                        
                        $products = new Lessons_video_media();
                        
                       $products->video_link= $link[$key];
                       $products->video_title = $video_title[$key];
                       
                          $products->video_short_desc = $short_desc[$key];
                       $products->type	='video';
                        $products->lesson_id = $request->lesson_id;
                        $products->save();
                  //      
                    }
                    //return ;
                }
                //return ;
            }
        
        
        
                           return back()->with('flash_success', 'Added Successfully!');

        	
       
    }

 public function deleteMultipleImages(Request $request)
    {
        $id = $_REQUEST['id'];
        //return $id;
       
        $data =  Lessons_media::find($id);
        //return $data;
        $delete = @unlink(public_path('/uploads/downloadable_files/'.$data->filename));
        
        if ($delete = true) {
            if ($data->delete()) {
                return back()->with('flash_success', 'Image Deleted Successfully!');
            }
        }
    }



}
