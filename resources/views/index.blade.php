<!doctype html>
<html lang="en">
  <head>
<style>
	.error{color:red;}
</style>
  	<title>User Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


	<link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
	<link rel="stylesheet" href="{{url('/')}}/front/assets/css/bootstrap-datepicker.min.css">
	
	</head>
	<body>
	<div class="row justify-content-center">
				<div class="col-md-12 text-center mb-3">
					<h2  class="bg-info text-white">User Management System</h2>
				</div>
	</div>
		<div class="container">

		@if (count($errors) > 0)
			<div class="alert alert-danger alertmsg">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if ($message = Session::get('success'))
			<div class="alert alert-success alert-block alertmsg">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>{{ $message }}</strong>
			</div>
		@endif

		@if ($message = Session::get('error'))
			<div class="alert alert-danger alert-block alertmsg">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>{{ $message }}</strong>
			</div>
		@endif
			
			<div class="row ">
				<div class="col-md-6 text-left mb-2">
					<h5 >User Records</h5>
				</div>
				<div class="col-md-6 text-right mb-2">
					<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#job-apply">Add New</a>
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table">
						  <thead class="thead-dark" style="line-height:0.5;">
						    <tr>
						      <th>Sr. no.</th>
							  <th>Avatar</th>
						      <th>Full Name</th>
						      <th>Email</th>
							  <th>Experience</th>
						      <th>Action</th>
						    </tr>
						  </thead>
						  <tbody>
							@foreach($users as $key => $user)
						    <tr class="alert" role="alert">
						      <th scope="row">{{$key+1 }}</th>
							  <?php
							  $image = $public_image_path.$user['image'];
							  ?>

							  <td><img src="{{$image }}" alt="user_image" height="80" width="80" style="border-radius: 50%; "></td>
						      <td>{{$user['full_name']}}</td>
						     
						      <td>{{$user['email']}}</td>
							  <?php
							  $exp =  $user['year'].' Years '.$user['month'].' months '.$user['day'].' days ';
							  if ($user['still_work']==1) {
								$exp = $user['still_year'].' Years '.$user['still_month'].' months '.$user['still_day'].' days ';
								
							  }
							  ?>
							  <td>{{ $exp }}</td>

						      <td>
							  <a href="{{route('user.delete',$user['id'])}}" class="btn btn-outline-danger" onclick="confirm_action(this,event)" >
				            	Remove<i class="fa fa-close"></i></span>
				             	</a>
				          	</a>
				        	</td>
						    </tr>
						    @endforeach
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

<!-- job apply -->
<div class="modal fade" id="job-apply" tabindex="-1" role="dialog" aria-labelledby="job-applyTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title gotham-medium text-blue text-center" id="exampleModalLongTitle">Add New Record
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
      
      <form action="{{route('user.store')}}" method="POST"  id="user_validate" enctype="multipart/form-data" >
      {{ csrf_field() }}
     
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="fname" class="col-form-label">Full Name <span class="required"> *</span></label>
                    <input placeholder="Please Enter Full Name" type="text" class="form-control"  name="fname" value="{{old('fname')}}" >
                    
                </div>

				

            </div>
			<div class="col-md-6">
                    <div class="form-group">
                    <label for="email" class="col-form-label">Email Id <span class="required"> *</span></label>
                    <input placeholder="Please Enter Email" type="email" class="form-control" name="email"  value="" data-rule-required="true">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="doj" class="col-form-label">Date of Joining<span class="required"> *</span></label>
                    <input placeholder="Please Selete Date of Joining" type="text" class="form-control" id="doj" name="doj" value="" data-rule-required="true">
                </div>
                </div>

				<div class="col-md-6">
                <div class="form-group">
                    <label for="dol" class="col-form-label">Date of Leaving<span class="required"> *</span></label>
                    <input placeholder="Please Selete Date of Leaving" type="text" class="form-control" id="dol" name="dol" value="" >
                </div>
				<div>               
                    <input  type="checkbox" name="stillwork" id="still_work" value="1">
					Still Working
                </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                    <label for="resume" class="col-form-label">Upload Your Image <span class="required"> *</span></label>
                    <input placeholder="Upload Your Resume Here" type="file" class="form-control" name="image"  value="" data-rule-required="true">
                <span style="color:red;">Note:Allowed file type Jpg,png,jpeg.</span>
                </div>
                </div>
				<div class="col-md-6">

				</div>
                <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary reset-btn"  >Submit</button>

           </div>
            </div>
        </form>  
       </div>
      
    </div>
  </div>
</div>

	
	<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
	
  <script src="{{ asset('public/assets/js/popper.js') }}"></script>
  
  <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/assets/js/main.js') }}"></script>


  <script src="{{ url('/') }}/front/assets/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ url('/') }}/js/1.3.0/bootstrap-datepicker.js"></script>
    <script src="{{ url('/') }}/js/1.11.1/jquery.validate.min.js"></script>
  
  
	</body>
</html>
<script>
$('#user_validate').validate();	
$( "#dol" ).change(function() {
	$('input:checked').prop('checked',false);
});
$( "#still_work" ).click(function() {
	$('#dol').val('');
});

$(document).ready(function () {
        $("#doj").datepicker({
            
            format: 'dd-mm-yyyy',
            autoclose: 1,
            todayHighlight: false,
 
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#dol').datepicker('setStartDate', minDate);
            $(this).datepicker('hide');
        });

        $("#dol").datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
        }).on('changeDate', function (selected) {
            $(this).datepicker('hide');
        });
    });

	function confirm_action(ref,evt) {
		evt.preventDefault(); 
		var conf= confirm('Are you sure! you want to delete?');
            if (conf==true) {
				window.location = $(ref).attr('href');
            }
			else{
				return false;
			}
        }
	
 setTimeout(function() {
    
	$('.alertmsg').fadeOut('fast');
	}, 10000); // <-- time in milliseconds

</script>
