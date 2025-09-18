@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="max-w-7xl mx-auto" x-data="{ activeTab: 'profile' }">

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-macgray-200">
        <!-- Tabs Navigation -->
        <div class="border-b border-macgray-200">
            <nav class="flex -mb-px px-6" aria-label="Tabs">
                <button @click="activeTab = 'profile'" :class="{'border-macblue-500 text-macblue-600': activeTab === 'profile', 'border-transparent text-macgray-500 hover:text-macgray-700 hover:border-macgray-300': activeTab !== 'profile'}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Company Profile
                </button>
                <button @click="activeTab = 'financial'" :class="{'border-macblue-500 text-macblue-600': activeTab === 'financial', 'border-transparent text-macgray-500 hover:text-macgray-700 hover:border-macgray-300': activeTab !== 'financial'}" class="whitespace-nowrap ml-8 py-4 px-1 border-b-2 font-medium text-sm">
                    Financial
                </button>
                <button @click="activeTab = 'invoicing'" :class="{'border-macblue-500 text-macblue-600': activeTab === 'invoicing', 'border-transparent text-macgray-500 hover:text-macgray-700 hover:border-macgray-300': activeTab !== 'invoicing'}" class="whitespace-nowrap ml-8 py-4 px-1 border-b-2 font-medium text-sm">
                    Invoicing
                </button>
                <button @click="activeTab = 'taxes'" :class="{'border-macblue-500 text-macblue-600': activeTab === 'taxes', 'border-transparent text-macgray-500 hover:text-macgray-700 hover:border-macgray-300': activeTab !== 'taxes'}" class="whitespace-nowrap ml-8 py-4 px-1 border-b-2 font-medium text-sm">
                    Taxes
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Company Profile Tab -->
                <div x-show="activeTab === 'profile'" style="display: none;">
                    <h3 class="text-lg font-semibold text-macgray-800 mb-1">Company Profile</h3>
                    <p class="text-sm text-macgray-500 mb-6">Update your company's information and logo.</p>
                    <div class="space-y-6">
                        <!-- Company Name -->
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-macgray-700">Company Name</label>
                            <input type="text" name="company_name" id="company_name" value="{{ setting('company_name', '') }}" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm" placeholder="Financia Inc.">
                        </div>

                        <!-- Company Address -->
                        <div>
                            <label for="company_address" class="block text-sm font-medium text-macgray-700">Address</label>
                            <textarea name="company_address" id="company_address" rows="3" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm" placeholder="123 Business Rd, Suite 100&#10;City, State 12345">{{ setting('company_address', '') }}</textarea>
                        </div>

                         <!-- Company Email & Phone -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="company_email" class="block text-sm font-medium text-macgray-700">Email</label>
                                <input type="email" name="company_email" id="company_email" value="{{ setting('company_email', '') }}" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm" placeholder="contact@financia.com">
                            </div>
                            <div>
                                <label for="company_phone" class="block text-sm font-medium text-macgray-700">Phone</label>
                                <input type="tel" name="company_phone" id="company_phone" value="{{ setting('company_phone', '') }}" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm" placeholder="(123) 456-7890">
                            </div>
                        </div>

                        <!-- Company Logo -->
                        <div>
                            <label class="block text-sm font-medium text-macgray-700">Company Logo</label>
                            <div class="mt-2 flex items-center space-x-4">
                                @if(setting('company_logo'))
                                    <img src="{{ asset('storage/' . setting('company_logo')) }}" alt="Company Logo" class="h-12 w-12 rounded-full object-cover">
                                @else
                                    <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-macgray-100">
                                        <svg class="h-full w-full text-macgray-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 20.993V24H0v-2.993A1 1 0 001 19.007V8.993A1 1 0 000 8.007V5.993A1 1 0 001 5.007V2.993A1 1 0 000 2.007V0h24v2.007a1 1 0 00-1 1.006v2.986a1 1 0 001 1.007v2.006a1 1 0 00-1 1.007v10.006a1 1 0 001 1.993zM8.993 4.006a1 1 0 01-1 1h-2a1 1 0 01-1-1V2.007a1 1 0 011-1h2a1 1 0 011 1v2.006zM8.993 10.007a1 1 0 01-1 1h-2a1 1 0 01-1-1V8.007a1 1 0 011-1h2a1 1 0 011 1v2.006zM8.993 16.007a1 1 0 01-1 1h-2a1 1 0 01-1-1v-2.006a1 1 0 011-1h2a1 1 0 011 1v2.006zM14.993 4.006a1 1 0 01-1 1h-2a1 1 0 01-1-1V2.007a1 1 0 011-1h2a1 1 0 011 1v2.006zM14.993 10.007a1 1 0 01-1 1h-2a1 1 0 01-1-1V8.007a1 1 0 011-1h2a1 1 0 011 1v2.006zM14.993 16.007a1 1 0 01-1 1h-2a1 1 0 01-1-1v-2.006a1 1 0 011-1h2a1 1 0 011 1v2.006z" />
                                        </svg>
                                    </span>
                                @endif
                                <input type="file" name="company_logo" id="company_logo" class="text-sm text-macgray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-macblue-50 file:text-macblue-700 hover:file:bg-macblue-100">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other Tabs (placeholders) -->
                <div x-show="activeTab === 'financial'" style="display: none;">
                     <h3 class="text-lg font-semibold text-macgray-800 mb-1">Financial Settings</h3>
                     <p class="text-sm text-macgray-500 mb-6">Configure fiscal year and currency settings.</p>
                     <!-- Financial settings form goes here -->
                </div>
                <div x-show="activeTab === 'invoicing'" style="display: none;">
                     <h3 class="text-lg font-semibold text-macgray-800 mb-1">Invoicing Settings</h3>
                     <p class="text-sm text-macgray-500 mb-6">Customize your invoice templates and default terms.</p>
                     <!-- Invoicing settings form goes here -->
                </div>
                 <div x-show="activeTab === 'taxes'" style="display: none;">
                     <h3 class="text-lg font-semibold text-macgray-800 mb-1">Tax Settings</h3>
                     <p class="text-sm text-macgray-500 mb-6">Manage tax rates for your items and services.</p>
                     <!-- Tax settings form goes here -->
                </div>

                <!-- Save Button -->
                 <div class="pt-6 mt-6 border-t border-macgray-200 text-right">
                    <button type="submit" class="px-5 py-2 bg-macblue-600 text-white rounded-md hover:bg-macblue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-macblue-500">
                        Save All Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- AlpineJS for tab functionality -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection