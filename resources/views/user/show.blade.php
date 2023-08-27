<x-app-layout>
    <div class="h-32 w-full mx-auto sm:h-72 bg-user-banner-light bg-center dark:bg-user-banner-dark">

    </div>
    <header class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700 shadow ">
        <div class="max-w-7xl mx-auto py-3 px-3 sm:py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex justify-start items-center">
                    <div class="rounded-full overflow-hidden h-8 w-8 xs:h-12 xs:w-12 sm:h-20 sm:w-20 mr-1 xs:mx-2 sm:mx-4">
                        @if ($user->picture_url === null)
                            <img src="{{url('/').'/profiles/default.jpg'}}" alt="">
                        @else
                            <img src="/storage/profiles/images/{{$user->picture_url}}" alt="">
                        @endif
                    </div>
                    <div class="flex flex-col">
                        <div class="flex justify-start items-center">
                            <h2 class="font-semibold text-base xs:text-2xl sm:text-3xl lg:text-5xl text-gray-800 dark:text-gray-200 leading-none">
                                {{$user->name}}
                            </h2>
                            @if ($user->role->name == "admin")
                                <div class="mx-0 sm:mx-2">
                                    <svg width="48px" height="48px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-indigo-600 text-indigo-600 w-6 h-6 sm:w-12 sm:h-12">
                                        <path d="M11.2691 4.41115C11.5006 3.89177 11.6164 3.63208 11.7776 3.55211C11.9176 3.48263 12.082 3.48263 12.222 3.55211C12.3832 3.63208 12.499 3.89177 12.7305 4.41115L14.5745 8.54808C14.643 8.70162 14.6772 8.77839 14.7302 8.83718C14.777 8.8892 14.8343 8.93081 14.8982 8.95929C14.9705 8.99149 15.0541 9.00031 15.2213 9.01795L19.7256 9.49336C20.2911 9.55304 20.5738 9.58288 20.6997 9.71147C20.809 9.82316 20.8598 9.97956 20.837 10.1342C20.8108 10.3122 20.5996 10.5025 20.1772 10.8832L16.8125 13.9154C16.6877 14.0279 16.6252 14.0842 16.5857 14.1527C16.5507 14.2134 16.5288 14.2807 16.5215 14.3503C16.5132 14.429 16.5306 14.5112 16.5655 14.6757L17.5053 19.1064C17.6233 19.6627 17.6823 19.9408 17.5989 20.1002C17.5264 20.2388 17.3934 20.3354 17.2393 20.3615C17.0619 20.3915 16.8156 20.2495 16.323 19.9654L12.3995 17.7024C12.2539 17.6184 12.1811 17.5765 12.1037 17.56C12.0352 17.5455 11.9644 17.5455 11.8959 17.56C11.8185 17.5765 11.7457 17.6184 11.6001 17.7024L7.67662 19.9654C7.18404 20.2495 6.93775 20.3915 6.76034 20.3615C6.60623 20.3354 6.47319 20.2388 6.40075 20.1002C6.31736 19.9408 6.37635 19.6627 6.49434 19.1064L7.4341 14.6757C7.46898 14.5112 7.48642 14.429 7.47814 14.3503C7.47081 14.2807 7.44894 14.2134 7.41394 14.1527C7.37439 14.0842 7.31195 14.0279 7.18708 13.9154L3.82246 10.8832C3.40005 10.5025 3.18884 10.3122 3.16258 10.1342C3.13978 9.97956 3.19059 9.82316 3.29993 9.71147C3.42581 9.58288 3.70856 9.55304 4.27406 9.49336L8.77835 9.01795C8.94553 9.00031 9.02911 8.99149 9.10139 8.95929C9.16534 8.93081 9.2226 8.8892 9.26946 8.83718C9.32241 8.77839 9.35663 8.70162 9.42508 8.54808L11.2691 4.41115Z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="font-semibold hidden sm:block dark:text-slate-300 text-xs sm:text-sm md:text-base">
                            Joined: {{\Carbon\Carbon::parse($user->created_at)->format('j F Y')}}
                        </div>
                    </div>

                </div>

                <div>
                    <form action="{{route('follow.user',$user->id)}}" method="post">
                        @csrf
                        @if ($user->id === auth()->user()->id)
                        <button type="submit" disabled class="text-white text-xs bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg sm:text-sm px-2 py-1 xs:px-5 xs:py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 tracking-widest dark:focus:ring-indigo-800 disabled:bg-indigo-200 disabled:dark:bg-indigo-800">FOLLOW &#124; {{count($user->followers()->get())}}</button>
                        @else
                        <button type="submit" class="text-white text-xs bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg sm:text-sm px-2 py-1 xs:px-5 xs:py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 tracking-widest dark:focus:ring-indigo-800">
                        @if ($user->followers()->where('follower_id',auth()->user()->id)->exists())
                            UNFOLLOW
                        @else
                            FOLLOW
                        @endif
                        &#124; {{count($user->followers()->get())}}</button>
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </header>
    <div class="max-w-7xl mx-auto pb-16 pt-6 px-4 sm:px-6 lg:px-8">
        @if (count($photos) === 0)
            <div class="w-full px-6 sm:px-12 md:px-20 py-36 lg:w-1/2 lg:px-6 lg:py-48 mx-auto">
                <div class="text-center text-3xl md:text-6xl text-gray-800 dark:text-gray-200">Nothing to see here!</div>
                <div class="text-center text-base md:text-lg text-gray-800 dark:text-gray-200">This user hasn't uploaded any photos yet.</div>

            </div>
        @else
        <div class="grid grid-cols-2 mb-4 items-start self-end auto-rows-max md:grid-cols-4 mb-4 gap-4">

            <div class="grid gap-4 col-auto">
                @foreach ($photos as $key => $photo)
                @if ($key == 0 || $key == 4 || $key == 8)
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
            <div class="grid gap-4 col-auto">
                @foreach ($photos as $key => $photo)
                @if ($key == 1 || $key == 5 || $key == 9)
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
            <div class="grid gap-4 col-auto">
                @foreach ($photos as $key => $photo)
                @if ($key == 2 || $key == 6 || $key == 10)
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
            <div class="grid gap-4 col-auto">
                @foreach ($photos as $key => $photo)
                @if ($key == 3 || $key == 7 || $key == 11)
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
        @endif
    </div>


</x-app-layout>
