@extends('user.layouts.app')

@section('content')
 <section class="content-header">
      <h1>
        Course Details        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
  <section class="content">
      <div class="row">
 <div class="col-xs-12">
          <div class="box">
                  
                  <table class="table table-bordered table-striped">
                        <tbody><tr>
                            <th>Course</th>
                            <td>{{$course->title}}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{$lessons->title}}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{$lessons->slug}}</td>
                        </tr>
                        <tr>
                            <th>Lesson Image</th>
                            <td> 
                            @if(@$lessons->lesson_image)<img src="{{ URL::to('/') }}/public/uploads/lessons/{{ @$lessons->lesson_image }}" style="width: 100%;" /></td>
                        @else
                        No Image
                        @endif</tr>
                        <tr>
                            <th>Short Text</th>
                            <td>{{$lessons->short_text}}</td>
                        </tr>
                        <tr>
                            <th>Full Text</th>
                            <td>{!!$lessons->full_text!!}</td>
                        </tr>
                        <tr>
                            <th>Position</th>
                            <td>{{$lessons->position}}</td>
                        </tr>            
                  
           
   
<?php 
$mediaimage=App\Lessons_media::where('lesson_id',$lessons->id)->where('name','downloadable_files')->get();
$pdf = App\Lessons_media::where('lesson_id',$lessons->id)->where('name','=','add_pdf')->first();
?>

  <tr>
                            <th>Media PDF</th>
                            
                            <td>                                

                                                    @if( !empty( @$pdf->filename ))
    <embed
    src="{{ URL::to('/') }}/public/uploads/lessons/pdf/{{ @$pdf->filename }}"
    style="width:800px; height:400px;"
    frameborder="0"
>@else 

NO PDF
   @endif
                                                            </td>
                        </tr>
                        
                         <tr>
                            <th>Media Audio</th>
                            <td>
                                  <?php $audio = App\Lessons_media::where('lesson_id',$lessons->id)->where('name','=','add_audio')->first();?>
    
  
  
    <audio controls>
    <source src="{{ URL::to('/') }}/public/uploads/lessons/audio/mp3/{{ @$audio->filename }}"type="audio/mp3">
   
</audio>
                                                            </td>
                        </tr>
                        
                        
                       <tr>

                            <th>Downloadable Files</th>
                                                               @isset($mediaimage)

   <td>                         @foreach($mediaimage as $image)
                                                                  @if($image->filename)<img src="{{url('/')}}/public/uploads/downloadable_files/{{$image->filename}}">@else No Files @endif
                                                            @endforeach   
                                                          @endisset
                                                            No image 
                                                           
                                                            </td>

                        </tr>
                        <tr>
                            <th>Media Video</th>
                            <td>
                                
                                      <?php $med = App\Lessons_media::where('lesson_id',$lessons->id)->where('name','=','youtube')->first();
                                      // dd($med);
                                       ?>
                               
                               
                                    @isset($med)
                       
              <?php
$link = $med->url;
$video_id = str_replace('http://www.youtube.com/watch?v=', '', $link);
//echo $video_id;
?>


<?php 
$url= $med->url;

parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube_id_v ); 
//echo $youtube_id_v['v'] . "\n"; 

?> 
     <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $youtube_id_v['v'];?>" 
     frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>




                                                            </td>
                        </tr>
                                 @endisset


                                 No video
                                                            </td>
                        </tr>   
                        
                        
                        
                        
                        <tr>
                            <th>Published</th>
                            <td><input disabled="" <?php if($course->published==1){echo 'checked';} ?> name="published" type="checkbox" value="1"></td>
                        </tr>
                      
                    </tbody></table>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-12  ">
                        
                                       
                                 <a href="{{url('/')}}/user/lessons" class="btn btn-default border float-left">Back to list</a>

                       
                    </div>

                </div>

    </div>
</section>

@endsection