@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Simple Header -->
        <div class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Profile</h1>
            </div>
            <a href="{{ route('profile.edit') }}"
               class="text-blue-600 hover:text-blue-800 font-medium flex items-center transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
                Edit
            </a>
        </div>

        <!-- Main Profile Section -->
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <!-- Profile Header -->
            <div class="px-8 py-12 text-center border-b border-gray-100">
                <div class="mb-6">
                    @if(auth()->user()->profile_picture)
                        <img class="w-24 h-24 rounded-full mx-auto object-cover border-2 border-gray-100"
                             src="{{ asset('images/profile/' . auth()->user()->profile_picture) }}"
                             alt="Profile Picture">
                    @else
                        <img class="w-24 h-24 rounded-full mx-auto object-cover border-2 border-gray-100"
                             src="{{ asset('images/dif.jpg') }}"
                             alt="Profile Picture">
                    @endif
                </div>
                <h2 class="text-xl font-medium text-gray-900 mb-2">{{ auth()->user()->name }}</h2>
                <p class="text-gray-500 text-sm uppercase tracking-wide font-medium">{{ auth()->user()->roles[0]->name ?? 'User' }}</p>
            </div>

            <!-- Profile Details -->
            <div class="px-8 py-8">
                <div class="space-y-6">
                    <!-- Name Row -->
                    <div class="flex items-center py-4 border-b border-gray-50">
                        <div class="w-1/3">
                            <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">Name</label>
                        </div>
                        <div class="w-2/3">
                            <p class="text-gray-900 font-medium">{{ auth()->user()->name }}</p>
                        </div>
                    </div>

                    <!-- Email Row -->
                    <div class="flex items-center py-4 border-b border-gray-50">
                        <div class="w-1/3">
                            <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">Email</label>
                        </div>
                        <div class="w-2/3">
                            <p class="text-gray-900 font-medium">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <!-- Role Row -->
                    <div class="flex items-center py-4 border-b border-gray-50">
                        <div class="w-1/3">
                            <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">Role</label>
                        </div>
                        <div class="w-2/3">
                            <span class="inline-block px-3 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                {{ auth()->user()->roles[0]->name ?? 'User' }}
                            </span>
                        </div>
                    </div>

                    <!-- Member Since Row -->
                    <div class="flex items-center py-4 border-b border-gray-50">
                        <div class="w-1/3">
                            <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">Member Since</label>
                        </div>
                        <div class="w-2/3">
                            <p class="text-gray-900 font-medium">{{ auth()->user()->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>

                    <!-- Last Updated Row -->
                    <div class="flex items-center py-4">
                        <div class="w-1/3">
                            <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">Last Updated</label>
                        </div>
                        <div class="w-2/3">
                            <p class="text-gray-900 font-medium">{{ auth()->user()->updated_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Footer -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-100">
                <div class="flex justify-between items-center">
                    <p class="text-sm text-gray-500">Need to update your information?</p>
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Info Card -->
        <div class="mt-8 bg-white border border-gray-200 rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Account Information</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                <div class="py-4">
                    <div class="text-2xl font-bold text-gray-900">{{ auth()->user()->created_at->diffInDays(now()) }}</div>
                    <div class="text-sm text-gray-500 mt-1">Days Active</div>
                </div>
                <div class="py-4 border-l border-r border-gray-100 sm:border-l sm:border-r-0 sm:border-t-0 sm:border-b-0">
                    <div class="text-2xl font-bold text-green-600">Active</div>
                    <div class="text-sm text-gray-500 mt-1">Status</div>
                </div>
                <div class="py-4">
                    <div class="text-2xl font-bold text-gray-900">{{ auth()->user()->updated_at->diffForHumans() }}</div>
                    <div class="text-sm text-gray-500 mt-1">Last Login</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
