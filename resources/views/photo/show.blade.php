<x-app-layout>




    <div class="bg-gray-300 dark:bg-gray-950 mx-auto">
        <div class="p-4 flex justify-center max-h-[40rem] max-w-7xl md:h-[40rem] mx-auto">
            <img src="/storage/images/{{$photo->url}}" alt="" class="inline-block object-contain box-border">
        </div>
    </div>

    <div class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700 shadow ">
        <div class="max-w-7xl mx-auto py-2 px-3 sm:py-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h3 class="font-semibold text-lg py-3 break-all sm:text-xl text-gray-800 dark:text-gray-200 leading-none md:text-2xl">
                    {{$photo->title}}
                </h3>
                <div>
                    <form action="{{route('like.photo',$photo->id)}}" method="post">
                        @csrf
                        @if ($photo->likers()->where('user_id',auth()->user()->id)->exists())
                        <button type="submit" class="w-8 h-8">

                            <svg fill="none" height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 512.001 512.001" xml:space="preserve" class="stroke-[24px] stroke-rose-500 w-8 h-8 fill-rose-500 transition-all ease-in-out">
                            <path d="M368.459,20.727c-44.919,0-85.82,20.784-112.458,54.367c-26.583-33.509-67.448-54.367-112.459-54.367
			                C64.392,20.727,0,85.119,0,164.267c0,91.398,58.04,172.206,124.794,234.054c60.426,55.986,120.038,89.32,122.546,90.711
			                c2.693,1.495,5.677,2.242,8.661,2.242c2.983,0,5.968-0.747,8.661-2.242c2.508-1.391,62.121-34.727,122.546-90.711
			                c66.784-61.878,124.793-142.68,124.793-234.054C512,85.119,447.608,20.727,368.459,20.727z"/>
                            </svg>
                        </button>
                        @else

                        <button type="submit" class="w-8 h-8">

                            <svg fill="none" height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 512.001 512.001" xml:space="preserve" class="stroke-[24px] stroke-rose-500 w-8 h-8 transition-all ease-in-out hover:fill-rose-500">
                            <path d="M368.459,20.727c-44.919,0-85.82,20.784-112.458,54.367c-26.583-33.509-67.448-54.367-112.459-54.367
			                C64.392,20.727,0,85.119,0,164.267c0,91.398,58.04,172.206,124.794,234.054c60.426,55.986,120.038,89.32,122.546,90.711
			                c2.693,1.495,5.677,2.242,8.661,2.242c2.983,0,5.968-0.747,8.661-2.242c2.508-1.391,62.121-34.727,122.546-90.711
			                c66.784-61.878,124.793-142.68,124.793-234.054C512,85.119,447.608,20.727,368.459,20.727z"/>
                            </svg>
                        </button>
                        @endif


                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto dark:bg-gray-900 pb-20 pt-6 flex flex-col-reverse md:flex-row justify-between">
        <div class="w-full md:w-3/5 px-2 md:px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Comments (<a href="{{route('photos.comment.show',$photo->id)}}">{{$comment_count}}</a>)</h2>
            </div>
            <form class="mb-6" action="{{route('photos.comment.store',$photo->id)}}" method="post">
                @csrf
                <div class="py-2 px-4 mb-4 bg-white rounded-md rounded-t-md border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <label for="comment" class="sr-only">Your comment</label>
                    <textarea name="body" id="comment" rows="4"
                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                      placeholder="Write a comment..." required></textarea>
                </div>
                <button type="submit"
                  class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-indigo-700 rounded-lg focus:ring-4 focus:ring-indigo-200 dark:focus:ring-indigo-900 dark:bg-indigo-600 hover:bg-indigo-800">
                  Post comment
                </button>
            </form>
            @if (count($comments) == 0)
                <div class="mx-auto text-center text-gray-800 dark:text-gray-300">
                    <h4 class="font-semibold text-xl">No comments!</h4>
                    <span>Post a comment to start a conversation.</span>
                </div>
            @else
            @foreach ($comments as $comment)
            <article class="p-2 mb-2 text-base rounded-lg dark:bg-gray-900">
                <div class="flex justify-between group">
                    <div class="flex flex-col justify-center items-start">
                        <div class="flex items-center mb-2">
                            <p class="inline-flex items-center mr-1 text-sm text-gray-900 dark:text-white">
                                <a href="{{route('users.show',$comment->user->id)}}">
                                @if ($comment->user->picture_url === null)
                                    <img class="mr-2 w-6 h-6 rounded-full" src="{{url('/').'/profiles/default.jpg'}}" alt="{{$comment->user->name}}">
                                @else
                                    <img class="mr-2 w-6 h-6 rounded-full" src="/storage/profiles/images/{{$comment->user->picture_url}}" alt="{{$comment->user->name}}">
                                @endif
                                </a>
                                <a href="{{route('users.show',$comment->user->id)}}" class="font-semibold">
                                    {{$comment->user->name}}
                                </a>
                            </p>
                            @if ($comment->user->role->name == "admin")
                                <div class="mx-0">
                                    <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-indigo-600 text-indigo-600 w-4 h-4 sm:w-4 sm:h-4">
                                        <path d="M11.2691 4.41115C11.5006 3.89177 11.6164 3.63208 11.7776 3.55211C11.9176 3.48263 12.082 3.48263 12.222 3.55211C12.3832 3.63208 12.499 3.89177 12.7305 4.41115L14.5745 8.54808C14.643 8.70162 14.6772 8.77839 14.7302 8.83718C14.777 8.8892 14.8343 8.93081 14.8982 8.95929C14.9705 8.99149 15.0541 9.00031 15.2213 9.01795L19.7256 9.49336C20.2911 9.55304 20.5738 9.58288 20.6997 9.71147C20.809 9.82316 20.8598 9.97956 20.837 10.1342C20.8108 10.3122 20.5996 10.5025 20.1772 10.8832L16.8125 13.9154C16.6877 14.0279 16.6252 14.0842 16.5857 14.1527C16.5507 14.2134 16.5288 14.2807 16.5215 14.3503C16.5132 14.429 16.5306 14.5112 16.5655 14.6757L17.5053 19.1064C17.6233 19.6627 17.6823 19.9408 17.5989 20.1002C17.5264 20.2388 17.3934 20.3354 17.2393 20.3615C17.0619 20.3915 16.8156 20.2495 16.323 19.9654L12.3995 17.7024C12.2539 17.6184 12.1811 17.5765 12.1037 17.56C12.0352 17.5455 11.9644 17.5455 11.8959 17.56C11.8185 17.5765 11.7457 17.6184 11.6001 17.7024L7.67662 19.9654C7.18404 20.2495 6.93775 20.3915 6.76034 20.3615C6.60623 20.3354 6.47319 20.2388 6.40075 20.1002C6.31736 19.9408 6.37635 19.6627 6.49434 19.1064L7.4341 14.6757C7.46898 14.5112 7.48642 14.429 7.47814 14.3503C7.47081 14.2807 7.44894 14.2134 7.41394 14.1527C7.37439 14.0842 7.31195 14.0279 7.18708 13.9154L3.82246 10.8832C3.40005 10.5025 3.18884 10.3122 3.16258 10.1342C3.13978 9.97956 3.19059 9.82316 3.29993 9.71147C3.42581 9.58288 3.70856 9.55304 4.27406 9.49336L8.77835 9.01795C8.94553 9.00031 9.02911 8.99149 9.10139 8.95929C9.16534 8.93081 9.2226 8.8892 9.26946 8.83718C9.32241 8.77839 9.35663 8.70162 9.42508 8.54808L11.2691 4.41115Z"/>
                                    </svg>
                                </div>
                            @endif
                            <p class="text-sm text-gray-600 ml-1 dark:text-gray-400">{{$comment->created_at->diffForHumans()}}</p>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 break-words">{{$comment->body}}</p>
                    </div>
                    <div class="flex items-center invisible group-hover:visible">
                        @if ($comment->user->id == auth()->user()->id)
                        <a href="{{route('photos.comment.edit',['comment' => $comment->id, 'photo' => $photo->id])}}">
                            <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
	                        width="800px" height="800px" viewBox="0 0 494.936 494.936"
	                        xml:space="preserve" class="w-6 h-6 mx-1 fill-black dark:fill-gray-200">
		                        <path d="M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157
		                        	c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21
		                        	s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741
		                        	c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z"/>
		                        <path d="M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069
		                        	c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963
		                        	c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692
		                        	C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107
		                        	l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005
		                        	c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z"/>
                            </svg>
                        </a>
                        @endif
                        @if ($comment->user->id == auth()->user()->id || $photo->user->id == auth()->user()->id || auth()->user()->role->name == 'admin')
                        {{-- <form action="{{route('photos.comment.destroy',['comment' => $comment->id, 'photo' => $photo->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <svg fill="#000000" width="800px" height="800px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 fill-rose-500">
                                    <path d="M0 14.545L1.455 16 8 9.455 14.545 16 16 14.545 9.455 8 16 1.455 14.545 0 8 6.545 1.455 0 0 1.455 6.545 8z" fill-rule="evenodd"/>
                                </svg>
                            </button>
                        </form> --}}
                        <a href="">
                            <x-delete-x-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-comment-deletion-{{$comment->id}}')"
                            class="w-4 h-4 fill-rose-500"/>
                        </a>
                        <x-modal name="confirm-comment-deletion-{{$comment->id}}" focusable>

                            <form action="{{route('photos.comment.destroy',['comment' => $comment->id, 'photo' => $photo->id])}}" method="post" class="p-6">

                                @csrf
                                @method('delete')

                                <h2 class="text-xl text-center font-medium text-gray-900 dark:text-gray-100 pb-3">
                                    {{ __('Are you sure you want to delete this comment?') }}
                                </h2>
                                <div class="mt-6 flex justify-center">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ml-3">
                                        {{ __('Delete Comment') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                        @endif
                    </div>
                </div>
            </article>
            @endforeach


            <div class="flex justify-center dark:text-gray-300">
                <a href="{{route('photos.comment.show',$photo->id)}}">View all {{$comment_count}} comments</a>
            </div>
            @endif
        </div>
        <div class="w-full md:w-2/5 px-2 md:px-4 mb-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">About this photo</h2>
            </div>
            <div class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow rounded-lg">

                <div class="w-full md:max-w-xl">
                    <div class="flex justify-between items-center pb-4 flex-row md:flex-col md:items-start lg:flex-row border-b border-gray-300 dark:border-gray-700">
                        <div class="flex justify-start items-center">
                            <div class="rounded-full overflow-hidden h-8 w-8 sm:h-12 sm:w-12 mr-1 xs:mx-1 sm:mx-2">
                                <a href="{{route('users.show',$photo->user->id)}}">
                                @if ($photo->user->picture_url === null)
                                    <img src="{{url('/').'/profiles/default.jpg'}}" alt="">
                                @else
                                    <img src="/storage/profiles/images/{{$photo->user->picture_url}}" alt="">
                                @endif
                                </a>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex justify-start items-center">
                                    <h2 class="font-semibold text-base text-sm xs:text-base sm:text-lg text-gray-800 dark:text-gray-200 md:text-lg">
                                        <a href="{{route('users.show',$photo->user->id)}}">
                                        {{$photo->user->name}}
                                        </a>
                                    </h2>
                                    @if ($photo->user->role->name == "admin")
                                        <div class="mx-0 sm:mx-1">
                                            <svg width="48px" height="48px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-indigo-600 text-indigo-600 w-6 h-6 lg:w-8 lg:h-8">
                                                <path d="M11.2691 4.41115C11.5006 3.89177 11.6164 3.63208 11.7776 3.55211C11.9176 3.48263 12.082 3.48263 12.222 3.55211C12.3832 3.63208 12.499 3.89177 12.7305 4.41115L14.5745 8.54808C14.643 8.70162 14.6772 8.77839 14.7302 8.83718C14.777 8.8892 14.8343 8.93081 14.8982 8.95929C14.9705 8.99149 15.0541 9.00031 15.2213 9.01795L19.7256 9.49336C20.2911 9.55304 20.5738 9.58288 20.6997 9.71147C20.809 9.82316 20.8598 9.97956 20.837 10.1342C20.8108 10.3122 20.5996 10.5025 20.1772 10.8832L16.8125 13.9154C16.6877 14.0279 16.6252 14.0842 16.5857 14.1527C16.5507 14.2134 16.5288 14.2807 16.5215 14.3503C16.5132 14.429 16.5306 14.5112 16.5655 14.6757L17.5053 19.1064C17.6233 19.6627 17.6823 19.9408 17.5989 20.1002C17.5264 20.2388 17.3934 20.3354 17.2393 20.3615C17.0619 20.3915 16.8156 20.2495 16.323 19.9654L12.3995 17.7024C12.2539 17.6184 12.1811 17.5765 12.1037 17.56C12.0352 17.5455 11.9644 17.5455 11.8959 17.56C11.8185 17.5765 11.7457 17.6184 11.6001 17.7024L7.67662 19.9654C7.18404 20.2495 6.93775 20.3915 6.76034 20.3615C6.60623 20.3354 6.47319 20.2388 6.40075 20.1002C6.31736 19.9408 6.37635 19.6627 6.49434 19.1064L7.4341 14.6757C7.46898 14.5112 7.48642 14.429 7.47814 14.3503C7.47081 14.2807 7.44894 14.2134 7.41394 14.1527C7.37439 14.0842 7.31195 14.0279 7.18708 13.9154L3.82246 10.8832C3.40005 10.5025 3.18884 10.3122 3.16258 10.1342C3.13978 9.97956 3.19059 9.82316 3.29993 9.71147C3.42581 9.58288 3.70856 9.55304 4.27406 9.49336L8.77835 9.01795C8.94553 9.00031 9.02911 8.99149 9.10139 8.95929C9.16534 8.93081 9.2226 8.8892 9.26946 8.83718C9.32241 8.77839 9.35663 8.70162 9.42508 8.54808L11.2691 4.41115Z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                {{-- <div class="font-semibold dark:text-slate-300 text-xs">
                                    Joined: {{\Carbon\Carbon::parse($comment->user->created_at)->format('j F Y')}}
                                </div> --}}
                            </div>
                        </div>
                        <div>
                            <form action="{{route('follow.user',$photo->user->id)}}" method="post">
                                @csrf
                                @if ($photo->user->id === auth()->user()->id)
                                <button type="submit" disabled class="mt-1 sm:mx-2 text-white text-xs bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg lg:text-sm px-2 py-1 xs:px-4 xs:py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 tracking-widest dark:focus:ring-indigo-800 disabled:bg-indigo-200 disabled:dark:bg-indigo-800">FOLLOW &#124; {{count($photo->user->followers()->get())}}</button>
                                @else
                                <button type="submit" class="mt-1 sm:mx-2 text-white text-xs bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg lg:text-sm px-2 py-1 xs:px-4 xs:py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 tracking-widest dark:focus:ring-indigo-800">
                                @if ($photo->user->followers()->where('follower_id',auth()->user()->id)->exists())
                                    UNFOLLOW
                                @else
                                    FOLLOW
                                @endif
                                &#124; {{count($photo->user->followers()->get())}}</button>
                                @endif
                            </form>
                        </div>

                    </div>
                    <div class="py-4 dark:text-gray-200">
                        <div>
                            <span class="font-semibold">Uploaded on:</span>
                            <span class="dark:text-gray-400">{{\Carbon\Carbon::parse($photo->created_at)->format('j F Y')}}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Description:</span>
                            @if ($photo->description === null)
                                <span class="italic dark:text-gray-400">No description given.</span>
                            @else
                                <span class="dark:text-gray-400">{{$photo->description}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="py-4 border-t border-gray-300 dark:border-gray-700">
                        <div class="flex dark:text-gray-400">
                            <div class="flex flex-col mx-1">
                                <a href="{{route('photos.comment.show',$photo->id)}}">
                                    <div class="text-2xl dark:text-white">{{$comment_count}}</div>
                                    <div>Comments</div>
                                </a>
                            </div>
                            <div class="flex flex-col mx-1">
                                <a href="{{route('photos.likers',$photo->id)}}">
                                    <div class="text-2xl dark:text-white">{{$photo->likers()->count()}}</div>
                                    <div>Likes</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @if (auth()->user()->id === $photo->user->id || auth()->user()->role->name === 'admin')
                        <div class="py-4 border-t border-gray-300 dark:border-gray-700">
                            <div class="w-full flex justify-start">
                                @if (auth()->user()->id === $photo->user->id)
                                <a href="{{route('photos.edit',$photo->id)}}" class='mr-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>
                                    EDIT
                                </a>

                                @endif
                                <x-danger-button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-photo-deletion')"
                                >DELETE</x-danger-button>
                                <x-modal name="confirm-photo-deletion" focusable>

                                    <form action="{{route('photos.destroy',$photo->id)}}" method="post" class="p-6">

                                        @csrf
                                        @method('delete')

                                        <h2 class="text-xl text-center font-medium text-gray-900 dark:text-gray-100 pb-3">
                                            {{ __('Are you sure you want to delete this photo?') }}
                                        </h2>
                                        <div class="mt-6 flex justify-center">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-secondary-button>

                                            <x-danger-button class="ml-3">
                                                {{ __('Delete Photo') }}
                                            </x-danger-button>
                                        </div>
                                    </form>
                                </x-modal>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if (count($more_photos) > 0)
        <div class="max-w-7xl mx-auto pt-10 pb-20 px-2 lg:px-4">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-800 dark:text-gray-200 py-4">More from this user:</h2>
            <div class="grid grid-cols-4 gap-1 md:gap-4">
                @foreach ($more_photos as $user_photo)
                <a href="{{route('photos.show',$user_photo->id)}}" class="inline-block">
                    <div class="aspect-video overflow-hidden flex items-center rounded-lg">
                        <img class="h-auto w-auto max-w-full object-contain block " src="/storage/images/{{$user_photo->url}}" alt="">
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    @endif

</x-app-layout>
