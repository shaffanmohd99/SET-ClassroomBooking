
            @extends('template.outer_layout')   
            <!-- directory.file_name -->
            @section('content')

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <a href="{{route('home')}}">home</a>
                <a href="{{route('page3')}}">Page 3</a>
                   <h1>testing123</h1>
                   @if (isset($totalSum))
                   <h3> total is {{$totalSum ?? null}}</h3>
                    @else
                    <h3> no sum</h3>
                   @endif
                </div>
            @endsection
      