@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Profile Information Form -->
    <div class="bg-white rounded-xl shadow-sm border border-macgray-200"
         x-data="{avatarPreview: null}">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-macgray-800 mb-1">Profile Information</h3>
            <p class="text-sm text-macgray-500 mb-6">Update your account's profile information and email address.</p>

            @if (session('status') === 'profile-updated')
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                    <span class="block sm:inline">Your profile has been updated.</span>
                </div>
            @endif
            
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Profile Photo -->
                <div>
                    <label class="block text-sm font-medium text-macgray-700">Photo</label>
                    <div class="mt-2 flex items-center space-x-4">
                        <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-macgray-100">
                             @if (Auth::user()->avatar)
                                <img x-show="!avatarPreview" class="h-full w-full object-cover" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Current Avatar">
                            @endif
                            <img x-show="avatarPreview" :src="avatarPreview" class="h-full w-full object-cover" alt="Avatar Preview">
                            <svg x-show="!avatarPreview && !'{{ Auth::user()->avatar }}'" class="h-full w-full text-macgray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.993A1 1 0 001 19.007V8.993A1 1 0 000 8.007V5.993A1 1 0 001 5.007V2.993A1 1 0 000 2.007V0h24v2.007a1 1 0 00-1 1.006v2.986a1 1 0 001 1.007v2.006a1 1 0 00-1 1.007v10.006a1 1 0 001 1.993zM8.993 4.006a1 1 0 01-1 1h-2a1 1 0 01-1-1V2.007a1 1 0 011-1h2a1 1 0 011 1v2.006zM8.993 10.007a1 1 0 01-1 1h-2a1 1 0 01-1-1V8.007a1 1 0 011-1h2a1 1 0 011 1v2.006zM8.993 16.007a1 1 0 01-1 1h-2a1 1 0 01-1-1v-2.006a1 1 0 011-1h2a1 1 0 011 1v2.006zM14.993 4.006a1 1 0 01-1 1h-2a1 1 0 01-1-1V2.007a1 1 0 011-1h2a1 1 0 011 1v2.006zM14.993 10.007a1 1 0 01-1 1h-2a1 1 0 01-1-1V8.007a1 1 0 011-1h2a1 1 0 011 1v2.006zM14.993 16.007a1 1 0 01-1 1h-2a1 1 0 01-1-1v-2.006a1 1 0 011-1h2a1 1 0 011 1v2.006z" />
                            </svg>
                        </span>
                        <input type="file" name="avatar" id="avatar" class="text-sm text-macgray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-macblue-50 file:text-macblue-700 hover:file:bg-macblue-100"
                               @change="file => {
                                   const reader = new FileReader();
                                   reader.onload = (e) => {
                                       avatarPreview = e.target.result;
                                   };
                                   reader.readAsDataURL(file.target.files[0]);
                               }">
                    </div>
                    @error('avatar') <span class="text-sm text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-macgray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required autofocus autocomplete="name" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm">
                    @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-macgray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm">
                     @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-macgray-700">Phone</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}" autocomplete="tel" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm">
                     @error('phone') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                
                <div class="text-right">
                    <button type="submit" class="px-4 py-2 bg-macblue-600 text-white rounded-md hover:bg-macblue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-macblue-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Password Form -->
    <div class="bg-white rounded-xl shadow-sm border border-macgray-200">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-macgray-800 mb-1">Update Password</h3>
            <p class="text-sm text-macgray-500 mb-6">Ensure your account is using a long, random password to stay secure.</p>

            @if (session('status') === 'password-updated')
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                    <span class="block sm:inline">Your password has been updated.</span>
                </div>
            @endif

            <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-macgray-700">Current Password</label>
                    <input type="password" name="current_password" id="current_password" required autocomplete="current-password" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm">
                    @error('current_password', 'updatePassword') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-macgray-700">New Password</label>
                    <input type="password" name="password" id="password" required autocomplete="new-password" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm">
                    @error('password', 'updatePassword') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-macgray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm">
                </div>
                
                <div class="text-right">
                    <button type="submit" class="px-4 py-2 bg-macblue-600 text-white rounded-md hover:bg-macblue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-macblue-500">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- AlpineJS for photo preview -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection