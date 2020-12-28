
@extends('layouts.apphome')
@section('content')

@if($message = Session::get('success'))

          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
          </div>
          @endif
     <div class="panel panel-default">
      <div class="panel-heading">
       <h3 class="panel-title text-center">Update Profile</h3>
      </div>
      
      <div class="panel-body">
       <form id="contact_form" method="post" enctype="multipart/form-data" action="javascript:void(0)">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter First Name" value="{{$user->name}}">
              </div>
              <div class="form-group">
                <label for="l_name">Last Name</label>
                <input type="text" name="l_name" class="form-control" id="l_name" placeholder="Enter Lasr Name" value="{{$user->l_name}}">
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number" value="{{$user->phone}}">
              </div>
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email Detail" value="{{$user->email}}">
              </div>
              
              <div class="form-group">
                <label for="email">Select File</label>
                <input type="file" name="file" class="form-control input-img" id="file" placeholder="Select Image">
                <img id="ImgPreview3" src="{{asset('otfcoader/'.$user->image)}}" class="preview3 mt-3" width="100px" />
                <input type="button" id="removeImage3" value="x" class="btn-rmv3" />
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Send" id="send_form" />
              </div>
            </form>
      </div>
     </div>

@endsection
@section('scripts')

<script>
$(document).ready(function(){

function readURL(input, imgControlName) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function () {
                        var height = this.height;
                        var width = this.width;
                        if (height > 512 || width > 512) {
                            if(imgControlName == '#ImgPreview3') {
                                $("#error_file2_message").text("Height and Width must not exceed 512px.");
                                $("#error_file2_message").show();
                                return false;
                            }
                        } else {
                            if(imgControlName == '#ImgPreview3') {
                                $("#error_file2_message").hide();
                                return false;
                            }
                        }
                        return true;
                    };
                    $(imgControlName).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
$("#file").change(function() {
            // add your logic to decide which image control you'll use
            var imgControlName = "#ImgPreview3";
            readURL(this, imgControlName);
            $('.preview3').addClass('it');
            $('.btn-rmv3').addClass('rmv');
        });
$("#removeImage3").click(function(e) {
            e.preventDefault();
            $("#file").val("");
            $("#ImgPreview3").attr("src", "");
            $('.preview3').removeClass('it');
            $('.btn-rmv3').removeClass('rmv');
        });




 if($("#contact_form").length > 0)
  {
    $('#contact_form').validate({
      rules:{
        name : {
          required : true,
          maxlength : 50
        },
        l_name : {
          required : true,
          maxlength : 50
        },
        phone : {
          required : true,
          number : true,
          maxlength : 10
        },
        email : {
          required : true,
          maxlength : 50, 
          email : true
        },
      },
      messages : {
        name : {
          required : 'Enter First Name',
          maxlength : 'Name should not be more than 50 character'
        },
        l_name : {
          required : 'Enter Last Name',
          maxlength : 'Name should not be more than 50 character'
        },
        email : {
          required : 'Enter Email',
          email : 'Enter Valid Email Detail',
          maxlength : 'Email should not be more than 50 character'
        },
        file : {
          required : 'Please Select Your Image',
        },
        phone : {
          required : 'Enter Phone Number',
        },
      },

      submitHandler: function(form) {
        var formData = new FormData($("#contact_form")[0]);
         $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('#send_form').html('Sending..');
          $.ajax({
            url: "{{route('userUpdate',$user->id)}}" ,
            type: "POST",
           // dataType    : 'text',           // what to expect back from the PHP script, if anything
            cache       : false,
            contentType : false,
            processData : false,
            //data: $('#contact_form').serialize(),
            data        : formData,
            success: function( response ) {
                console.log(response)
                if(response.status ==1){
                    alert(response.message);
                $('#send_form').html('Submit');
                document.getElementById("contact_form").reset(); 
                setTimeout(function () {
                           window.location.href = "{{ url('/home')}}"; //will redirect to your blog page (an ex: blog.html)
                     }, 200);
                }
                
            }
          });
        } 
    });
  }

});
</script>
@endsection

