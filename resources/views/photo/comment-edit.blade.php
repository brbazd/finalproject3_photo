<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Comment
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">


        <form action="{{route('photos.comment.update',['comment' => $comment->id, 'photo' => $photo->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="my-2">
                <label for="body" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Body<span class="text-red-500 dark:text-red-300">*</span></label></label>
                <textarea type="text" id="body" name="body" rows="4" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-white sm:text-xs focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white" placeholder="Write something here.">{{ $comment->body }}</textarea>
            </div>

            <div class="my-3 text-sm text-red-500 dark:text-red-300">*Required</div>

            <button type="submit" class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 tracking-widest dark:focus:ring-indigo-800">UPLOAD</button>
        </form>

    </div>
</x-app-layout>
