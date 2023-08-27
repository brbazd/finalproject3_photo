<x-app-layout>


    <div class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700 shadow ">
        <div class="max-w-7xl mx-auto py-2 px-3 sm:py-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <h3 class="font-semibold text-2xl sm:text-3xl text-gray-800 dark:text-gray-200 leading-none md:text-4xl">
                    My Likes
                </h3>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto dark:bg-gray-900 py-6 lg:py-12">
        <div class="w-full px-4">
            @if (count($likes) == 0)
                <div class="mx-auto text-center dark:text-gray-300">
                    <h4 class="font-semibold text-xl">You haven't liked any photos yet!</h4>
                    <span>Start liking photos and they will appear here.</span>
                </div>
            @else
            <div class="rounded-md overflow-hidden">
                <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-1 md:px-6 md:py-3">
                                Preview
                            </th>
                            <th scope="col" class="px-3 py-1 md:px-6 md:py-3">
                                Name
                            </th>
                            <th scope="col" class="px-3 py-1 md:px-6 md:py-3">
                                Uploader
                            </th>
                            <th scope="col" class="px-3 py-1 md:px-6 md:py-3">
                                Upload Date
                            </th>
                            <th scope="col" class="px-3 py-1 md:px-6 md:py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    @foreach ($likes as $like)
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="h-8 md:h-12 aspect-video flex items-center">
                                    <a href="{{route('photos.show',$like->id)}}">
                                        <img src="/storage/images/{{$like->url}}" alt="" class="object-contain overflow-hidden">
                                    </a>
                                </div>
                            </th>

                            <th>
                                <div class="pl-3">
                                    <div class="text-xs md:text-base font-semibold text-gray-800 dark:text-gray-200 px-2 break-all">
                                        <a href="{{route('photos.show',$like->id)}}">{{$like->title}}</a>
                                    </div>
                                </div>
                            </th>
                            <td>
                                <div class="pl-3">
                                    <div class="text-xs md:text-base font-normal text-gray-500 px-2 break-all">
                                        <a href="{{route('users.show',$like->user->id)}}">{{$like->user->name}}</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pl-3">
                                    <div class="text-xs md:text-base font-normal text-gray-500 px-2 break-all">{{\Carbon\Carbon::parse($like->created_at)->format('j F Y')}}</div>
                                </div>
                            </td>
                            <td>

                                <div class="px-3 inline">
                                    <form action="{{route('like.photo',$like->id)}}" method="post">
                                        @csrf
                                        @if ($like->likers()->where('user_id',auth()->user()->id)->exists())
                                        <button type="submit" class="w-4 h-4 md:w-8 md:h-8">

                                            <svg fill="none" height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 512.001 512.001" xml:space="preserve" class="stroke-[24px] stroke-rose-500 w-4 h-4 md:w-8 md:h-8 fill-rose-500 transition-all ease-in-out">
                                            <path d="M368.459,20.727c-44.919,0-85.82,20.784-112.458,54.367c-26.583-33.509-67.448-54.367-112.459-54.367
                                            C64.392,20.727,0,85.119,0,164.267c0,91.398,58.04,172.206,124.794,234.054c60.426,55.986,120.038,89.32,122.546,90.711
                                            c2.693,1.495,5.677,2.242,8.661,2.242c2.983,0,5.968-0.747,8.661-2.242c2.508-1.391,62.121-34.727,122.546-90.711
                                            c66.784-61.878,124.793-142.68,124.793-234.054C512,85.119,447.608,20.727,368.459,20.727z"/>
                                            </svg>
                                        </button>
                                        @else

                                        <button type="submit" class="w-4 h-4 md:w-8 md:h-8">

                                            <svg fill="none" height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 512.001 512.001" xml:space="preserve" class="stroke-[24px] stroke-rose-500 w-4 h-4 md:w-8 md:h-8 transition-all ease-in-out hover:fill-rose-500">
                                            <path d="M368.459,20.727c-44.919,0-85.82,20.784-112.458,54.367c-26.583-33.509-67.448-54.367-112.459-54.367
                                            C64.392,20.727,0,85.119,0,164.267c0,91.398,58.04,172.206,124.794,234.054c60.426,55.986,120.038,89.32,122.546,90.711
                                            c2.693,1.495,5.677,2.242,8.661,2.242c2.983,0,5.968-0.747,8.661-2.242c2.508-1.391,62.121-34.727,122.546-90.711
                                            c66.784-61.878,124.793-142.68,124.793-234.054C512,85.119,447.608,20.727,368.459,20.727z"/>
                                            </svg>
                                        </button>
                                        @endif


                                    </form>
                                </div>


                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>

            {{ $likes->links() }}
            @endif
        </div>
    </section>

</x-app-layout>
