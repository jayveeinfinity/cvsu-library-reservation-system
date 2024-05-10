@extends('layouts.landing')

@section('content') 
<div class="h-full flex justify-center">
    <div class="h-screen flex lg:flex flex-row w-full h-screen">
        <div class="flex bg-cover bg-center h-full lg:w-1/2 flex flex-col bg-cover bg-center h-full" style="background-image: url('images/landing/CvSU.jpg');">
            <div class="flex items-center justify-center h-screen">
                <div class="items-center pb-28 lg:pb-2 flex flex-col items-center sm:flex flex-col items-center">
                    <img class="w-24 lg:w-80 mb-3" src="images/CvSU-logo.png" alt="cvsu logo">
                    <div class=" align-text-top text-center lg:text-center text-white mb-2">
                        <p class="font-bold text-lg md:text-2xl lg:text-2xl"><b class="uppercase">Cavite State University</b> <br> Office of Alumni Affairs</p>
                        <p class="text-white font-semibold text-lg pb-16">System</p>
                    </div>
                    <!--form-->
                    <div class="p-8 py-5 px-px bg-white text-center rounded-2xl shadow-inner border border-gray-2 lg:hidden">
                    <div>
                        <h1 class="text-2xl font-medium text-center mb-2 text-gray-700">Accessing the CvSU - Office of Alumni Affairs System
                        <br>
                        <span class="text-base font-normal">
                            <i>(For librarian and library staffs only)</i>
                        </span>
                        </h1>
                        <hr class="mb-2">
                        <p class="text-center text-lg mb-6 p-2 font-semibold text-gray-700 tracking-wide">
                            The CvSU Control Center intelligently adapts based on your login information. It dynamically presents the modules you need for essential library tasks
                                within the Ladislao N. Diwa Memorial Library system.</p>
                    </div>
                    <div class="flex items-center justify-center ">
                        <a href="{{ url('auth/google') }}"                 
                            class="px-4 py-2 border flex gap-2 border-slate-200 rounded-lg text-slate-700 hover:border-slate-400 hover:text-slate-900 hover:shadow transition duration-150">
                            <img class="w-6 h-6" src="images/CvSU-logo-64x64.webp"
                                loading="lazy" alt="google logo">
                            <span class="text-gray-700">Sign in with CvSU Email</span>
                        </a>
                    </div>
                    </div>
                    <div class="absolute bottom-0 text-center ml-4 sm:ml-10 md:ml-20 lg:hidden">
                        <p class="text-base font-medium text-white">© Copyright 2024 &sdot; Cavite State University  - Office of Alumni Affairs</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- right side -->
        <div class="hidden lg:block w-1/2 flex flex-col">
            <div class="flex h-full justify-center items-center space-y-8 bg-[#F6FFF1]">
                <div class="text-center rounded-3xl px-72">
                    <div class="py-5 px-10 bg-white rounded-2xl shadow-xl z-20 border border-gray-2 00">
                        <div>
                            <h1 class="text-2xl font-medium text-center mb-2 mt-3">Accessing the CvSU - Office of Alumni Affairs System
                            <br><span class="text-base font-normal"><i>(For alumni students and authorized personnel of CvSU Main)</i></span>
                            </h1>
                            <!-- <p class="text-center text-lg mb-6 p-2 font-semibold text-gray-700 tracking-wide">
                                The CvSU Control Center intelligently adapts based on your login information. It dynamically presents the modules you need for essential library tasks
                                within the Ladislao N. Diwa Memorial Library system.</p> -->
                        </div>
                        <div class="flex items-center justify-center ">
                            <a href="{{ url('auth') }}"                 
                                class="px-4 py-2 border flex gap-2 border-slate-200 rounded-lg text-slate-700 hover:border-slate-400 hover:text-slate-900 hover:shadow transition duration-150">
                                <img class="w-6 h-6" src="images/Google-logo-512x512.webp"
                                    loading="lazy" alt="google logo">
                                <span class="text-gray-700">Sign in with Google</span>
                            </a>
                        </div>
                        <hr class="my-6">
                        <div class="flex items-center justify-center flex-col">
                            <span class="text-gray-500 font-normal mb-3">Don't have an account yet? 
                                <a href="{{ url('signup') }}" class="text-blue-900 hover:underline-offset-4">Create an account</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 text-center p-4 ml-10 lg:absolute bottom-0 text-center p-4 ml-2">
                <p class="text-base font-medium text-gray-700">© Copyright 2024 &sdot; Cavite State University - Office of Alumni Affairs</p>
            </div>
        </div>
        <div class="hidden lg:block flex-none absolute bottom-0 right-0">
            <img src="images/landing/laya at diwa - Edited.png" alt="Image" class="w-auto h-96 opacity-40" />
        </div>
    </div>
</div>
@endsection