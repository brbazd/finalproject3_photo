<x-app-layout>


    <div class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700 shadow ">
        <div class="max-w-7xl mx-auto py-2 px-3 sm:py-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <h3 class="font-semibold text-2xl sm:text-3xl text-gray-800 dark:text-gray-200 leading-none md:text-4xl">
                    My Photos
                </h3>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto dark:bg-gray-900 pt-6 pb-20 lg:pt-12">
        <div class="w-full px-4">
            @if (count($photos) == 0)
                <div class="mx-auto text-center dark:text-gray-300">
                    <h4 class="font-semibold text-xl">You don't have any photos!</h4>
                    <span>Upload some photos to view them here.</span>
                </div>
            @else
            <div class="rounded-md overflow-hidden">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-1 md:px-6 md:py-3">
                                Preview
                            </th>
                            <th scope="col" class="px-3 py-1 md:px-6 md:py-3">
                                Name
                            </th>
                            <th scope="col" class="px-3 py-1 md:px-6 md:py-3">
                                Upload Date
                            </th>
                            <th scope="col" class="px-3 py-1 md:px-6 md:py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    @foreach ($photos as $photo)
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="h-8 md:h-12 aspect-video flex items-center">
                                    <a href="{{route('photos.show',$photo->id)}}">
                                    <img src="/storage/images/{{$photo->url}}" alt="" class="object-contain overflow-hidden">
                                    </a>
                                </div>
                            </th>

                            <th>
                                <div class="pl-3">
                                    <div class="text-xs md:text-base font-semibold text-gray-800 dark:text-gray-200 px-2 break-all">
                                        <a href="{{route('photos.show',$photo->id)}}">{{$photo->title}}</a>
                                    </div>
                                </div>
                            </th>
                            <td>
                                <div class="pl-3">
                                    <div class="text-xs md:text-base font-normal text-gray-500 px-2 break-all">{{\Carbon\Carbon::parse($photo->created_at)->format('j F Y')}}</div>
                                </div>
                            </td>
                            <td>
                                <div class="px-3 inline">
                                    <a href="{{route('photos.edit',$photo->id)}}" class='mr-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>
                                        EDIT
                                    </a>
                                </div>

                                <div class="px-3 inline">
                                    <x-danger-button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-photo-deletion-{{$photo->id}}')"
                                >DELETE</x-danger-button>
                                </div>
                                <x-modal name="confirm-photo-deletion-{{$photo->id}}" focusable>

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


                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>

            {{ $photos->links() }}
            @endif
        </div>
    </section>

</x-app-layout>
