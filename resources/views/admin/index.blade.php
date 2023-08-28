<x-app-layout>


    <div class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700 shadow ">
        <div class="max-w-7xl mx-auto py-2 px-3 sm:py-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <h3 class="font-semibold text-2xl sm:text-3xl text-gray-800 dark:text-gray-200 leading-none md:text-4xl">
                    All Users
                </h3>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto dark:bg-gray-900 pt-6 pb-20 lg:pt-12">
        <div class="w-full px-4">
            <div class="rounded-md overflow-hidden">
                <table class="w-full text-xs md:text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-1 md:px-6 md:py-3">
                                Name
                            </th>
                            <th scope="col" class="px-3 py-1 md:px-6 md:py-3">
                                Email
                            </th>
                            <th scope="col" class="px-3 py-1 md:px-6 md:py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{route('users.show',$user->id)}}">
                                    @if ($user->picture_url === null)
                                    <img class="mr-2 w-8 h-8 rounded-full" src="{{url('/').'/profiles/default.jpg'}}" alt="{{$user->name}}">
                                    @else
                                    <img class="mr-2 w-8 h-8 rounded-full" src="/storage/profiles/images/{{$user->picture_url}}" alt="{{$user->name}}">
                                    @endif
                                </a>
                                <div class="pl-3">
                                    <div class="text-sm md:text-base font-semibold break-all"><a href="{{route('users.show',$user->id)}}">{{$user->name}}</a></div>
                                    <div class="font-normal text-gray-500 break-all">Joined: {{\Carbon\Carbon::parse($user->created_at)->format('j F Y')}}</div>
                                </div>
                            </th>
                            <td>
                                <div class="font-normal text-gray-500 break-all">{{$user->email}}</div>
                            </td>
                            <td>
                                <form action="{{route('admin.update',$user->id)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    @if ($user->id === auth()->user()->id)
                                    <button type="submit" disabled class="mt-1 sm:mx-2 text-white text-xs bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg lg:text-sm px-2 py-1 xs:px-4 xs:py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 tracking-widest dark:focus:ring-indigo-800 disabled:bg-indigo-200 disabled:dark:bg-indigo-800">GIVE ADMIN</button>
                                    @else
                                    <button type="submit" class="mt-1 sm:mx-2 text-white text-xs bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg lg:text-sm px-2 py-1 xs:px-4 xs:py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 tracking-widest dark:focus:ring-indigo-800">
                                    @if ($user->role->name === 'admin')
                                        REMOVE ADMIN
                                    @else
                                        GIVE ADMIN
                                    @endif</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $users->links() }}
        </div>
    </section>

</x-app-layout>
