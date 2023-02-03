@extends('layouts.app')
@section('title','My Profile')
@section('content')
<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <div class="col-md-15 ">
                            <h4 class="">My Profile
                                <a href="{{ url('change-password') }}" class="btn btn-warning float-end">Change Password</a>
                            </h4>
                        </div>
                        <hr>
                    </div>
                    @if (session('message'))
                        <p class="alert alert-success">{{ session('message') }}</p>
                    @endif

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="shadow bg-white p-3">
                    <form action="{{ url('profile') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" name="fullname" value="{{ $customer->fullname }}" id="fullname" class="form-control" placeholder="Enter Full Name" />
                                @error('fullname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone Number</label>
                                <input type="number" name="phone" value="{{ $customer->phone }}" id="phone" class="form-control" placeholder="Enter Phone Number" />
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Full Address</label>
                                <textarea  id="address" name="address" class="form-control" rows="2">{{ $customer->address }}</textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="update">
                                <button class="btn btn-primary float-end">
                                    {{-- <span wire:loading.remove wire:target="UpdateInfor({{ $customer->user_id }})">
                                        </i> Update
                                    </span>
                                    <span wire:loading wire:target="UpdateInfor({{ $customer->user_id }})">
                                        Updateing...
                                    </span> --}}
                                    Save
                                </button>
    
                            </div>
                        </div>
                    </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection