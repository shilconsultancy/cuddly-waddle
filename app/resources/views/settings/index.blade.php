@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="max-w-7xl mx-auto" x-data="{ activeSection: 'company_info' }">
    <div class="flex flex-col md:flex-row md:space-x-6">

        <!-- Left Column: Navigation -->
        <div class="md:w-1/4">
            <div class="bg-white rounded-xl shadow-sm border border-macgray-200 p-4">
                <nav class="space-y-2">
                    <!-- Company Settings -->
                    <div>
                        <h3 class="px-3 text-xs font-semibold text-macgray-500 uppercase tracking-wider">Company Settings</h3>
                        <div class="mt-1 space-y-1">
                            <a href="#" @click.prevent="activeSection = 'company_info'" :class="{'bg-macblue-50 text-macblue-700': activeSection === 'company_info', 'text-macgray-600 hover:bg-macgray-50 hover:text-macgray-900': activeSection !== 'company_info'}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                Company Information
                            </a>
                            <a href="#" @click.prevent="activeSection = 'branding'" :class="{'bg-macblue-50 text-macblue-700': activeSection === 'branding', 'text-macgray-600 hover:bg-macgray-50 hover:text-macgray-900': activeSection !== 'branding'}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                Logo & Branding
                            </a>
                        </div>
                    </div>

                    <!-- Financial Settings -->
                    <div class="pt-4">
                        <h3 class="px-3 text-xs font-semibold text-macgray-500 uppercase tracking-wider">Financial Settings</h3>
                        <div class="mt-1 space-y-1">
                             <a href="#" @click.prevent="activeSection = 'currency'" :class="{'bg-macblue-50 text-macblue-700': activeSection === 'currency', 'text-macgray-600 hover:bg-macgray-50 hover:text-macgray-900': activeSection !== 'currency'}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                Currency
                            </a>
                             <a href="#" @click.prevent="activeSection = 'taxes'" :class="{'bg-macblue-50 text-macblue-700': activeSection === 'taxes', 'text-macgray-600 hover:bg-macgray-50 hover:text-macgray-900': activeSection !== 'taxes'}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                Tax
                            </a>
                             <a href="#" @click.prevent="activeSection = 'invoicing'" :class="{'bg-macblue-50 text-macblue-700': activeSection === 'invoicing', 'text-macgray-600 hover:bg-macgray-50 hover:text-macgray-900': activeSection !== 'invoicing'}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                Invoicing
                            </a>
                        </div>
                    </div>
                     <!-- Add other main categories here later -->
                </nav>
            </div>
        </div>

        <!-- Right Column: Content -->
        <div class="flex-1 mt-6 md:mt-0">
             <!-- Success Message Feedback -->
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                    @if (session('status') === 'company-updated')
                        <span class="block sm:inline">Company settings have been updated successfully.</span>
                    @endif
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-macgray-200">
                <!-- Company Information Section -->
                <div x-show="activeSection === 'company_info'" style="display: none;">
                    <form action="{{ route('settings.company.update') }}" method="POST">
                        @csrf
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-macgray-800 mb-1">Company Information</h3>
                            <p class="text-sm text-macgray-500 mb-6">This information will appear on your invoices and quotes.</p>
                            <div class="space-y-6">
                                <div>
                                    <label for="company_name" class="block text-sm font-medium text-macgray-700">Company Name</label>
                                    <input type="text" name="company_name" id="company_name" value="{{ setting('company_name', Auth::user()->organization->name) }}" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm" placeholder="Your Company LLC">
                                </div>
                                <div>
                                    <label for="company_address" class="block text-sm font-medium text-macgray-700">Address</label>
                                    <textarea name="company_address" id="company_address" rows="3" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm" placeholder="123 Business Rd, Suite 100&#10;City, State 12345">{{ setting('company_address') }}</textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="company_email" class="block text-sm font-medium text-macgray-700">Email</label>
                                        <input type="email" name="company_email" id="company_email" value="{{ setting('company_email') }}" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm" placeholder="contact@yourcompany.com">
                                    </div>
                                    <div>
                                        <label for="company_phone" class="block text-sm font-medium text-macgray-700">Phone</label>
                                        <input type="tel" name="company_phone" id="company_phone" value="{{ setting('company_phone') }}" class="mt-1 block w-full rounded-md border-macgray-300 shadow-sm focus:border-macblue-500 focus:ring-macblue-500 sm:text-sm" placeholder="(123) 456-7890">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-macgray-50 px-6 py-3 text-right rounded-b-xl">
                            <button type="submit" class="px-5 py-2 bg-macblue-600 text-white rounded-md hover:bg-macblue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-macblue-500">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Other sections will go here -->
                 <div x-show="activeSection === 'branding'" style="display: none;" class="p-6">
                     <h3 class="text-lg font-semibold text-macgray-800 mb-1">Logo & Branding</h3>
                     <p class="text-sm text-macgray-500">Placeholder for logo and branding settings.</p>
                </div>
                <div x-show="activeSection === 'currency'" style="display: none;" class="p-6">
                     <h3 class="text-lg font-semibold text-macgray-800 mb-1">Currency</h3>
                     <p class="text-sm text-macgray-500">Placeholder for currency settings.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- AlpineJS for UI functionality -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection