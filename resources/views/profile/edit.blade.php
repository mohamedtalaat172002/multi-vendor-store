{{--
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

--}}
@extends('adminlte::page')

@section('title', 'User Profile')

@section('content_header')
<h1>My Profile</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        {{-- الكارت الرئيسي الذي يحتوي كل شيء --}}
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">

                {{-- الصورة الشخصية --}}
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{ asset('vendor/adminlte/dist/img/avatar.png') }}" alt="User profile picture"
                        style="width: 100px; height: 100px; border: 3px solid #adb5bd;">
                </div>

                <h3 class="profile-username text-center mt-3">{{ $user->name }}</h3>
                <p class="text-muted text-center">Member since {{ $user->created_at->format('Y') }}</p>

                <hr>

                {{-- النموذج المدمج لتحديث البيانات --}}
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <h5 class="text-center mb-3 text-primary"><strong>Account Settings</strong></h5>
                        <form action="#" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}">
                            </div>

                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}">
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@stop