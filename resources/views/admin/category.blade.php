<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Category
            <b class="float-end">Total Category <span class="badge bg-success">{{ count($category) }}</span></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- main container --}}
            @if($category[0])

            <div class="container">
                <div class="row">
                    {{-- <div class="col-sm-8"> --}}
                    @if($category[0])
                    <div class="col-sm-8">
                        @else
                        <div class="">
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show p-2 d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>&emsp;
                            <strong class="fs-5">{{ session('success') }}</strong>
                            <button type="button" class="btn-close pt-1" data-bs-dismiss="alert">
                            </button>
                        </div>
                    @endif

                    @if($category[0])
                        <div class="card shadow">
                            <div class="card-header">
                                <h4>All Category</h4>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">#SL</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Created_at</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category as $cat)
                                            <tr>
                                                <td>{{ $category->firstItem() + $loop->index }}</td>
                                                <td>{{ $cat->cat_name }}</td>
                                                <td>{{ $cat->user->name; }}</td>
                                                {{-- <td>{{ $cat->name; }}</td> --}}
                                                <td>
                                                    @if($cat->created_at == NULL)
                                                    <span class="text-danger">Date Not Found</span>
                                                    @else
                                                    {{ Carbon\Carbon::parse($cat->created_at)->diffForHumans() }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- {{ url('/edit/category/'. $cat->id) }} --}}
                                                    <a href="{{ route('edit.cat', $cat->id) }}" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="{{ route('softDelete.cat', $cat->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $category->links() }}
                            </div>
                        </div>
                    @endif
                    </div>
            @endif

                    <div class=@if($category[0]) "col-sm-4" @else "col-sm-8" @endif>
                        <div class="card shadow">
                            <div class="card-header">
                                <h4>Add Category</h4>
                            </div>
                            <div class="card-body">
                                <form class="form" action="{{ route('add.cat') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="">Name</label>
                                        <input class="form-control @error('cat_name')
                                            is-invalid
                                        @enderror " type="text" name="cat_name" id="">
                                        @error('cat_name')
                                            <span class="text-danger"><i>{{ $message }}</i></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="" id="" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- reccycle bin area --}}

            @if(isset($trash[0]['cat_name']))

            <div class="container mt-3">
                <div class="row">
                    <div class="col-sm-8">

                        <div class="card shadow">
                            <div class="card-header">
                                <h4>Category Recycle bin</h4>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">#SL</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Created_at</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trash as $tr)
                                            <tr>
                                                <td>{{ $trash->firstItem() + $loop->index }}</td>
                                                <td>{{ $tr->cat_name }}</td>
                                                <td>{{ $tr->user->name; }}</td>
                                                <td>
                                                    @if($tr->created_at == NULL)
                                                    <span class="text-danger">Date Not Found</span>
                                                    @else
                                                    {{ Carbon\Carbon::parse($tr->created_at)->diffForHumans() }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- {{ url('/edit/trash/'. $tr->id) }} --}}
                                                    <a href="{{ route('restore.cat', $tr->id) }}" class="btn btn-info btn-sm">Restore</a>
                                                    <a href="{{ route('perDelete.cat', $tr->id) }}" class="btn btn-danger btn-sm">Permanent Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $trash->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>


<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    {{-- <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol> --}}
    {{-- <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol> --}}
  </svg>
