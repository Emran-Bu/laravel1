<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            Hi... {{ Auth::user()->name }}
            <b class="float-end">Total Users <span class="badge bg-success">{{ count($user) }}</span></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div> --}}


            <div class="container">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created_at</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($user as $users )
                            <tr>
                                <th scope="row">{{ $users->id }}</th>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->name }}</td>
                                {{-- <td>{{ $users->created_at }}</td> --}}
                                <td>{{ $users->created_at }} &ensp; {{ Carbon\Carbon::parse($users->created_at)->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
