@extends('user.layouts.app')


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet"/>

@section('content')

  <section class="content-header">
      <h1>
        User Profile        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
  <?php 
                   $info=App\User::where('id',Auth::user()->id)->first();
                   $profile=App\TeacherProfile::where('user_id',Auth::user()->id)->first();
                   $ps=App\TeacherSkills::where('user_id',Auth::user()->id)->get();
                   ?> 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                @if($info->image)
             <img class="profile-user-img img-responsive img-circle" src="{{url('/')}}/public/uploads/images/{{$info->image}}" alt="User profile picture">

                @else
                
              <img class="profile-user-img img-responsive img-circle" src="{{url('/')}}/public/teacher/dist/img/user4-128x128.jpg" alt="User profile picture">
                @endif
              <h3 class="profile-username text-center">@if($info->name){{$info->name}}@endif</h3>
              <p class="text-muted text-center">@if($profile->designation){{$profile->designation}}@endif</p>        
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
               @if($profile->education){{$profile->education}}@endif
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">@if($profile->location){{$profile->location}}@endif</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                   @foreach($ps as $ps)
                <span class="label label-danger">{{$ps->skills}}</span>
                  <button form="resource-delete-{{ $ps->id }}"><i style="color: red;" class="fas fa-trash-alt"></i></button>
                            
                              <form id="resource-delete-{{ $ps->id }}" action="{{ url('user/deleteSkills') }}?id={{$ps->id}}" 
                              style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                                @csrf
                              </form>
               @endforeach
              </p>

              <hr>

           </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
		
		<div class="col-md-9">
          <div class="nav-tabs-custom">
         <ul class="nav nav-tabs">
			  <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li> 
			   <li><a href="#timeline" data-toggle="tab">change password</a></li>
            </ul>
            <div class="tab-content">
                     
              <div class="active tab-pane" id="settings">
                <form class="form-horizontal" action="{{url('/')}}/user/updateprofile" method="post"  enctype="multipart/form-data">
                    @csrf
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
<input type="hidden" name="userid" value="{{Auth::user()->id}}">
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="name"value="{{$info->name}}" placeholder="Name">
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">last name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="lastname" value="{{$info->lastname}}" placeholder=" Last Name">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" name="email"value="{{$info->email}}" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Male</label>

                    
                        <input type="radio" name="gender" value="male"<?php if($info->gender=='male'){ echo 'checked';}?> >
                          </div>    
                          <div class="form-group">
                          <label for="inputEmail" class="col-sm-2 control-label">FeMale</label>

                    
                        <input type="radio" name="gender" value="female"<?php if($info->gender=='female'){ echo 'checked';}?>>
                 </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Date of birth</label>

                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="inputSkills" name="dob" value="@if($info->dob){{$info->dob}}@endif"placeholder="DOB">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" name="experience"placeholder="Experience">@if($profile->experience){{$profile->experience}}@endif</textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Designation</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" name="designation" value="@if($profile->designation){{$profile->designation}}@endif"placeholder="Designation">
                    </div>
                  </div>
                    <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Education</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" name="education"placeholder="Experience" >@if($profile->education){{$profile->education}}@endif</textarea>
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Location</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" name="location" value="@if($profile->location){{$profile->location}}@endif"placeholder="Location">
                    </div>
                  </div>
                  
                    <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Profile photo</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="inputSkills" name="image" value="">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10"  id="dynamic_field">
                       
                        <table class="table table-bordered" id="dynamic_field">
                      <tr>  
                                     
                        <td><input type="text" name="skills[]" placeholder="Enter your skills" value="" class="form-control name_list" /></td>  
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td> 
                      
                    </tr> 
                    
                    </table>
                    </div>
                  </div>
                 
                 
 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              
                        @if(Session::has('flash_success'))
  <div class="alert alert-success">
  {{ Session::get('flash_success') }}
  </div>
@endif

@if(Session::has('flash_error'))
  <div class="alert alert-danger">
  {{ Session::get('flash_error') }}
  </div>
@endif
       
              <!-------------------->
              <div class="tab-pane" id="timeline">
                  
                   <form method="POST" action="{{url('user/changepassword')}}" >
                        @csrf 
   
                         @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach 
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
  
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="currentpassword" autocomplete="current-password" required>
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
  
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="newpasssword" autocomplete="current-password" required>
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>
    
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" required autocomplete="current-password">
                            </div>
                        </div>
   
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                  </div>
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
		
		
	    <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  @push('after-scripts')    

@endpush

	

		
    
@endsection

 <script>  

 $(document).ready(function(){  

      var i=1;  

      $('#add').click(function(){  

           i++;  

           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="skills[]" placeholder="enter your skills" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  

      });  

      $(document).on('click', '.btn_remove', function(){  

           var button_id = $(this).attr("id");   

           $('#row'+button_id+'').remove();  

      }); 

     
 

 });  

 </script> 

