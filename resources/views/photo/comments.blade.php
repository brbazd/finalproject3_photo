<x-app-layout>


    <div class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700 shadow ">
        <div class="max-w-7xl mx-auto py-2 px-3 sm:py-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <h3 class="font-semibold text-2xl sm:text-3xl text-gray-800 dark:text-gray-200 leading-none md:text-4xl">
                    Comments on: <a href="{{route('photos.show',$photo->id)}}">{{$photo->title}}</a>
                </h3>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto dark:bg-gray-900 py-6 lg:py-12">
        <div class="w-full px-4">
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
                <div class="mx-auto text-center dark:text-gray-300">
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
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-avatar-deletion-{{$comment->id}}')"
                            class="w-4 h-4 fill-rose-500"/>
                        </a>
                        <x-modal name="confirm-avatar-deletion-{{$comment->id}}" focusable>

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

            {{ $comments->links() }}
            @endif
        </div>
    </section>

</x-app-layout>
