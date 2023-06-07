<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('/images/logo.svg') }}" alt="" srcset="">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus />
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
            <div class="mb-4" id="terms-and-condition-error" style="display : none">

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    <li id="terms-and-condition-error-message"></li>

                </ul>
            </div>

            <div class="flex items-center justify-end mt-4">
                <div><u id="terms-and-condition-check-modal">Terms and Conditions<u></div>
            </div>



            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>


                <button type="button" id="registerButton"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">Register</button>

                {{-- <x-button type="button" class="ml-4" id="registerButton">
                    {{ __('Register') }}
                </x-button> --}}
            </div>



            <!-- Thankyou Modal -->
            <div class="flex items-center justify-end mt-4">
                <!-- Button trigger modal -->
                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Launch demo modal
                </button> --}}

                <!-- Modal -->

                <!-- Thankyou Modal -->
                <div tabindex="-1" class="modal pmd-modal fade text-center" id="terms-and-condition-modal"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="terms-and-condition">Terms and Conditions</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="pmd-card-icon d-flex justify-center">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        width="75px" height="75px" viewBox="162.5 162.5 75 75"
                                        enable-background="new 162.5 162.5 75 75" xml:space="preserve">
                                        <g>
                                            <path fill="#33CC99"
                                                d="M199.943,162.54c-20.711,0-37.5,16.789-37.5,37.5c0,20.71,16.789,37.5,37.5,37.5
                                            c20.711,0,37.5-16.789,37.5-37.5C237.443,179.329,220.654,162.54,199.943,162.54L199.943,162.54z M199.943,234.332
                                            c-18.938,0-34.291-15.354-34.291-34.292c0-18.938,15.353-34.291,34.291-34.291c18.939,0,34.292,15.353,34.292,34.291l0,0
                                            C234.234,218.979,218.882,234.332,199.943,234.332z">
                                            </path>
                                            <path fill="none" d="M176.333,176.333h46.334v46.334h-46.334V176.333z">
                                            </path>
                                            <path fill="#33CC99"
                                                d="M193.765,207.568l-8.108-8.108l-2.703,2.704l10.811,10.811l23.167-23.167l-2.703-2.703L193.765,207.568z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                                {{-- <h2>Thank you for showing interest in Propeller!</h2> --}}
                                @if (!empty($terms_and_condition))
                                    <div class="mt-4">
                                        <p>{!! $terms_and_condition->meta_value !!}</p>
                                    </div>
                                @else
                                    <p>No</p>
                                @endif
                            </div>
                            <div class="modal-footer justify-content-center">
                                <div class="w-100 d-flex justify-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="termsAndConditionAccept" />
                                        <label class="form-check-label" for="flexCheckDefault">Accept</label>
                                    </div>
                                    <div>
                                        <button data-dismiss="modal" class="btn pmd-ripple-effect btn-primary"
                                            type="button">Got It!</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                {{-- <div class="modal fade" id="terms-and-condition-modal" tabindex="-1" role="dialog"
                    aria-labelledby="terms-and-condition" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="terms-and-condition">Terms and Conditions</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
