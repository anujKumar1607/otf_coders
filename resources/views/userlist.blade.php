@extends('layouts.apphome')
@section('content')

@if(Auth::user()->role =="Admin")

@if($message = Session::get('message'))
<div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif
     <div class="panel panel-default">
      <div class="panel-heading">
       <h3 class="panel-title text-center">Profile Page</h3><a style="float:right;margin-top:-25px;" href="{{route('userEdit',Auth::user()->id)}}" class="btn btn-primary btn-md" >Edit</a>
      </div>
      
      <div class="panel-body">
       <table class="table table-responsive">
           <tr>
               <th>Name</th>
               <th>Last Name</th>
               <th>Email</th>
               <th>Phone Number</th>
               <th>Profile</th>
               <th>Role</th>

           </tr>
           @if(isset($user) && sizeof($user) > 0)
             @foreach($user as $users)
             <tr>
              <td>{{$users->name}}</td>
              <td>{{$users->l_name}}</td>
              <td>{{$users->email}}</td>
              <td>{{$users->phone}}</td>
              <td><img src="{{asset('otfcoader/'.$users->image)}}" width='100px'/></td>
              <td>{{$users->role}}</td>
            </tr>
             @endforeach
           @endif

       </table>
      </div>
     </div>

@else

<div class="alert alert-danger">
  <h1>You Have Not permission to view this page !!!!</h1>
</div>

@endif



@endsection
@section('scripts')
@endsection



