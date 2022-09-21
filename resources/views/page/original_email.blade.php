@extends('template.email.email_layout')   
            <!-- directory.file_name -->
            @section('content')

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <a href="{{route('home')}}">home</a>
                <a href="{{route('page2')}}">Page 2</a>

                   <h1>email template</h1>
                </div>
            @endsection