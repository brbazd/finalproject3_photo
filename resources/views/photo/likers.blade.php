<x-app-layout>


    <div class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700 shadow ">
        <div class="max-w-7xl mx-auto py-2 px-3 sm:py-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <h3 class="font-semibold text-2xl sm:text-3xl text-gray-800 dark:text-gray-200 leading-none md:text-4xl">
                    People who liked: <a href="{{route('photos.show',$photo->id)}}">{{$photo->title}}</a>
                </h3>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto dark:bg-gray-900 py-10 lg:py-12">
        <div class="w-full px-4">
            @if (count($likers) == 0)
                <div class="mx-auto text-center dark:text-gray-300">
                    <h4 class="font-semibold text-xl">Nobody liked this post!</h4>
                    <span>Be the first one to show support.</span>
                </div>
            @else
            <div class="rounded-md overflow-hidden">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($likers as $liker)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{route('users.show',$liker->id)}}">
                                    @if ($liker->picture_url === null)
                                    <img class="mr-2 w-8 h-8 rounded-full" src="{{url('/').'/profiles/default.jpg'}}" alt="{{$liker->name}}">
                                    @else
                                    <img class="mr-2 w-8 h-8 rounded-full" src="/storage/profiles/images/{{$liker->picture_url}}" alt="{{$liker->name}}">
                                    @endif
                                </a>
                                <div class="pl-3">
                                    <div class="text-base font-semibold"><a href="{{route('users.show',$liker->id)}}">{{$liker->name}}</a></div>
                                    <div class="font-normal text-gray-500">Joined: {{\Carbon\Carbon::parse($liker->created_at)->format('j F Y')}}</div>
                                </div>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $likers->links() }}
            @endif
        </div>
    </section>

</x-app-layout>
