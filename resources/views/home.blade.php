@extends('layouts.apphome')
@section('content')
@if($message = Session::get('message'))

          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
          </div>
    @endif
     <div class="panel panel-default">
      <div class="panel-heading">
       <h3 class="panel-title text-center">Profile Page</h3>
       <a style="float:right;margin-top:-25px;" href="{{route('userEdit',Auth::user()->id)}}" class="btn btn-primary btn-md" >Edit</a>
       @if(Auth::user()->role == "Admin")
       <a style="float:right;margin-right:10px;margin-top:-25px;" href="{{route('userList')}}" class="btn btn-primary btn-md" >User List</a>
       @endif
      </div>
      
      <div class="panel-body">
       <table class="table table-responsive">
           <tr>
               <th>Name</th><th>Last Name</th>
           </tr>
           <tr>
               <td>{{Auth::user()->name}}</td><td>{{Auth::user()->l_name}}</td>
           </tr>
           <tr>
               <th>Email</th><th>Phone</th>
           </tr>
           <tr>
               <td>{{Auth::user()->email}}</td><td>{{Auth::user()->phone}}</td>
           </tr>
           <tr>
               <th>Role</th><th>profile</th>
           </tr>
           <tr>
               <td>{{Auth::user()->email}}</td>
               <td><img src="{{asset('otfcoader/'.Auth::user()->image)}}" width='100px'/></td>
           </tr>
       </table>
      </div>
     </div>
@endsection
@section('scripts')
@endsection



