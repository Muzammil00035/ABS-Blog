<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('/images/logo.svg') }}" alt="" srcset="">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <!-- User Type -->
            <div class="mt-4">
                <x-label for="type" :value="__('Type')" />
                <select name="user_type" id="user_type"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                    <option value="author">Author</option>
                    <option value="writer">Writer</option>
                </select>
            </div>

            <!-- Intro -->
            <div class="mt-4">
                <x-label for="intro" :value="__('Intro')" />
                <x-input id="user_intro" class="block mt-1 w-full" type="text" name="user_intro" :value="old('Intro')"
                    required />


            </div>

            <!-- Website -->
            <div class="mt-4">
                <x-label for="website" :value="__('Website')" />
                <x-input id="user_website" class="block mt-1 w-full" type="url" name="user_website"
                    :value="old('Website')" />


            </div>
            <div class="mt-4">
                <x-label for="image" :value="__('Image')" />
                {{-- <x-input  class="block mt-/ w-full" type="file" name="image" /> --}}
                <input type="file" name="image" id="image"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">

            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
