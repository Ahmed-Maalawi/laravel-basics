<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           All Category
{{--            <b style="float:right;">--}}
{{--                Total Category <span class="badge bg-danger"> {{count($categories)}} </span>--}}
{{--            </b>--}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> {{ session('success')}} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header">All Category</div>
                        <div class="card-body">
                        <table class="table">
                        <thead>
                        <tr class="text-capitalize">
                            <th scope="col">Sl No</th>
                            <th scope="col">category Name</th>
                            <th scope="col">user</th>
                            <th scope="col">created at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->user->name }}</td>
                                <td>
                                    @if($category->created_at == NULL)
                                        <span class="text-danger">no data set</span>
                                    @else
                                        {{ $category->created_at->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('category/edit/'.$category->id)}}" class="btn btn-secondary">edit</a>
                                    <a href="{{url('softdelete/category/'.$category->id)}}" class="btn btn-danger">delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                            {{ $categories->links() }}

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-capitalize">add category</div>
                    <div class="card-body">
                        <form action="{{ route('store.category') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="category-name" class="form-label">category name</label>
                                <input type="text" name="category_name" class="form-control" id="category-name">
                            </div>
                            @error('category_name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                            <button type="submit" class="btn btn-outline-primary">Add Category</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Deleted Category</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr class="text-capitalize">
                                    <th scope="col">Sl No</th>
                                    <th scope="col">$category Name</th>
                                    <th scope="col">user</th>
                                    <th scope="col">created at</th>
                                    <th scope="col">action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trashCategories as $item)
                                    <tr>
                                        <th scope="row">{{ $trashCategories->firstItem()+$loop->index }}</th>
                                        <td>{{ $item->category_name }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            @if($item->created_at == NULL)
                                                <span class="text-danger">no data set</span>
                                            @else
                                                {{ $item->created_at->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('category/restore/'.$item->id)}}" class="btn btn-secondary">Restore</a>
                                            <a href="{{url('destroy/category/'.$item->id)}}" class="btn btn-danger">delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $trashCategories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
