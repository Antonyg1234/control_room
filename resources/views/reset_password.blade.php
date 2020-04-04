<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>

        <style>
            .pass_show{position: relative} 

            .pass_show .ptxt { 

            position: absolute; 

            top: 67%; 

            right: 10px; 

            z-index: 1; 

            color: #f36c01; 

            margin-top: -10px; 

            cursor: pointer; 

            transition: .3s ease all; 

            } 

            .pass_show .ptxt:hover{color: #333333;} 

            .error{
                color: red;
            }
        </style>

    </head>
<body>
<div class="container">
	<div class="row">
    <div class="col-md-4"></div>
		<div class="col-md-4">
		    <center><h2>Reset Password</h2></center>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form id="reset_passwd" method="POST" action="{{ route('update_password') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group pass_show"> 
                    <label>New Password</label>
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="password" id="password" name="password" value="" class="form-control" placeholder="New Password">
                </div> 
                <div class="form-group pass_show"> 
                    <label>Confirm Password</label>
                    <input type="password" name="c_password" value="" class="form-control" placeholder="Confirm Password"> 
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
		</div>  
	</div>
</div>
<script>
      
$(document).ready(function(){
// $('.pass_show').append('<span class="ptxt">Show</span>');  
});
  

$(document).on('click','.pass_show .ptxt', function(){ 

$(this).text($(this).text() == "Show" ? "Hide" : "Show"); 

$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

});  

$('#reset_passwd').validate({
    rules: {
        password: {
                required: true
            },
        c_password: {
                required: true,
                equalTo: "#password"
            }
    }
});
</script>
</body>