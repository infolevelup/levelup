@extends('user.layouts.app')

@section('content')

<?php
use App\Course;
use App\User;
$cartcount=Course::coursecount();
//$tecount=User::teachercount();

?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard

      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$cartcount}}</h3>
              <p>Course</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php        $tecount = DB::table('users')->where('role_id', 2)->count();
 ?>{{$tecount}}</h3>
              <p>Teachers</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php        $scount = DB::table('users')->where('role_id', 3)->count();
 ?>{{$scount}}</h3>

              <p>Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php        $bcount = DB::table('bundles')->where('published', 1)->count();
 ?>{{$bcount}}</h3>

              <p>Bundles</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>            
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          

          <!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Batch Schedule</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
               <?php 
               $batch=App\Batch::where('teacher_id',Auth::user()->id)->get();
               ?>
               @foreach($batch as $batch)
               	  <?php     $endate=date('m/d/Y');
			      $class=App\classs::where('batch_id',$batch->id)->where('date','>=',$endate)->orderBy('date','ASC')->limit(2)->get();
			     //dd($class);
			   
		
$course=App\Course::where('id',$batch->course_id)->first();

?> 
        
           @foreach($class as $class)
            <li >


 <span class="text">{{$course->title}}</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> {{$class->date}} - {{$class->time}} IST</small>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                   <!-- <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>-->
                     <?php 
                    if($class->date==date('m/d/Y')){
                    ?>
                    <a href="{{url('zoom')}}/{{$class->id}}" target="_blank" class="join" >                       
                        Join Now
                    </a>
                    <?php 
                    }else{
                        ?>
                        
                        <?php
                    }
                    ?>
                 
                 </div>
               
            </li>
            @endforeach
            
      
            
              
              
                @endforeach
              
              
              </ul>
            </div>
            <!-- /.box-body -->
            <!--<div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
            </div>-->
          </div>
          <!-- /.box -->

          <!-- quick email widget -->
          <!--<div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <!--<div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            <!--</div>
            <div class="box-body">
              <form action="#" method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea class="textarea" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <!--<section class="col-lg-5 connectedSortable">


          <!-- Calendar -->
          <!--<div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <!--<div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <!--<div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
    
            <!-- /.box-header -->
           </div>
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
 
@endsection

