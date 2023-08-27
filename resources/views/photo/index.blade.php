<x-app-layout>
    {{-- <div class="h-24 w-full mx-auto sm:h-52 bg-user-banner-dark bg-center">

    </div> --}}
    <header class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700 shadow ">
        <div class="max-w-7xl mx-auto py-3 px-3 sm:py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex justify-start items-center">
                    <div class="flex flex-col">
                            <h2 class="font-semibold text-2xl sm:text-5xl text-gray-800 dark:text-gray-200 leading-none">
                                Browse our Gallery
                            </h2>
                    </div>
                </div>


            </div>
        </div>
    </header>
    <div class="max-w-7xl mx-auto pb-20 pt-4 px-2 sm:px-4 lg:px-8">
        <div class="grid grid-cols-2 mb-4 items-start self-end auto-rows-max mb-2 gap-2 sm:mb-4 sm:gap-4">

                <div class="grid gap-2 sm:gap-4 col-auto">
                    @foreach ($photos as $key => $photo)
                    @if ($key % 2 == 0)
                    <div class="relative group">
                        <a href="{{route('photos.show',$photo->id)}}" class="absolute top-0 block w-full h-full z-10">
                        </a>
                                <div class="absolute inset-x-0 bottom-0 h-1/3 bg-opacity-0 rounded-b-lg group-hover:bg-gradient-to-t from-black/75 to-transparent">
                                    <div class="flex flex-col justify-center absolute text-gray-300 left-2 bottom-2 text-xs invisible group-hover:visible">
                                        <div class="font-semibold break-all">{{$photo->title}}</div>
                                        <div class="relative z-20">
                                            <a href="{{route('users.show',$photo->user->id)}}" class="block">
                                                by <span class="font-semibold break-all">{{$photo->user->name}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <img class="h-auto w-full object-cover max-w-full rounded-lg" src="/storage/images/{{$photo->url}}" alt="">
                        </div>
                    @endif
                @endforeach
                </div>
                <div class="grid gap-2 sm:gap-4 col-auto">
                    @foreach ($photos as $key => $photo)
                    @if ($key % 2 == 1)
                    <div class="relative group">
                        <a href="{{route('photos.show',$photo->id)}}" class="absolute top-0 block w-full h-full z-10">
                        </a>
                                <div class="absolute inset-x-0 bottom-0 h-1/3 bg-opacity-0 rounded-b-lg group-hover:bg-gradient-to-t from-black/75 to-transparent">
                                    <div class="flex flex-col justify-center absolute text-gray-300 left-2 bottom-2 text-xs invisible group-hover:visible">
                                        <div class="font-semibold break-all">{{$photo->title}}</div>
                                        <div class="relative z-20">
                                            <a href="{{route('users.show',$photo->user->id)}}" class="block">
                                                by <span class="font-semibold break-all">{{$photo->user->name}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <img class="h-auto w-full object-cover max-w-full rounded-lg" src="/storage/images/{{$photo->url}}" alt="">
                        </div>
                    @endif
                @endforeach
                </div>



            </div>
        {{$photos->links()}}
    </div>


</x-app-layout>
