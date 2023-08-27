<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Image: {{$photo->title}}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">


        <form action="{{route('photos.update',$photo->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="my-2">
                <label for="title" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Title<span class="text-red-500 dark:text-red-300">*</span></label>
                <input type="text" id="title" name="title" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-white sm:text-xs focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white" aria-describedby="title_help" value="{{ $photo->title }}" placeholder="Some title here...">
                @error('title')
                    <div class="mt-1 text-sm text-red-500 dark:text-red-300" id="title_help">*{{ $message }}</div>
                @enderror
            </div>
            <div class="my-2">
                <label for="description" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Description</label>
                <textarea type="text" id="description" name="description" rows="4" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-md bg-white sm:text-xs focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white" placeholder="Some description here...">{{ $photo->description }}</textarea>
            </div>

            <div class="flex items-center my-4">
                <input id="checkbox" type="checkbox" value="1" {{  ($photo->is_private == 1 ? ' checked' : '') }} name="is_private" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 text-indigo-500 dark:text-indigo-600">
                <label for="checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">This image is private.</label>
            </div>


            <div class="my-3 text-sm text-red-500 dark:text-red-300">*Required</div>

            <button type="submit" class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 tracking-widest dark:focus:ring-indigo-800">UPLOAD</button>
        </form>

    </div>
</x-app-layout>
