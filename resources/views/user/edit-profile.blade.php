@extends('layouts.app')
@section('title', '| Profile')
@section('content')
  
  @include('partials.navbar')

  <!-- partials -->
  
  <div class="container-fluid border border-bottom-0">
    <h3 class="text-center my-4">Edit Doctor's details</h3>
    <div class="add-doctors-form mx-auto my-5">
  
    @if(session()->has('success'))
  
      <div class="alert alert-success text-center alert-dismissible" role="alert">
        {{ session()->get('success') }}
        <button type="button" class="btn-close" id="close" data-bs-dismiss="alert" aria-label="Close">×</button>
      </div>
  
    @endif

    @if(session()->has('error'))
  
      <div class="alert alert-danger text-center alert-dismissible" role="alert">
        {{ session()->get('error') }}
        <button type="button" class="btn-close" id="close" data-bs-dismiss="alert" aria-label="Close">×</button>
      </div>
  
    @endif

      <div class="mx-auto col-md-6">
        <form method="POST" action="{{ route('update-profile', ['user_id' => Auth::user()->id ]) }}" class="w-100">
          @csrf       
          <div>
            <label class="block font-medium text-sm text-gray-700" for="name">Name</label>
            <input class="border-gray-300 rounded-md shadow-sm block mt-1 w-full" value="{{ Auth::user()->name }}" id="name" type="text" name="name" required="required" autofocus="autofocus" autocomplete="name">
          </div>

          <div class="mt-4">
              <label class="block font-medium text-sm text-gray-700" for="email">Email</label>
              <input class="border-gray-300 rounded-md shadow-sm block mt-1 w-full" value="{{ Auth::user()->email }}" id="email" type="email" name="email" required="required">
          </div>

          <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="old_password">Old Password</label>
            <input class="border-gray-300 rounded-md shadow-sm block mt-1 w-full" id="old_password" type="password" name="old_password" required="required" autocomplete="old_password">
          </div>

          <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="new_password">New Password</label>
            <input class="border-gray-300 rounded-md shadow-sm block mt-1 w-full" id="password" type="password" name="new_password" required="required" autocomplete="new_password">
          </div>

          <div class="mt-4">
              <label class="block font-medium text-sm text-gray-700" for="password_confirmation">Confirm New Password</label>
              <input class="border-gray-300 rounded-md shadow-sm block mt-1 w-full" id="password_confirmation" type="password" name="password_confirmation" required="required">
              <span id="err"></span>
          </div>
          
          <div class="flex items-center justify-end mt-4">
              <button id="submit" type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition ml-4">
                Update
              </button>
          </div>

        </form> 
      </div>
    </div>
  </div>
  
  <!-- partial -->
  @include('partials.footer')

@endsection