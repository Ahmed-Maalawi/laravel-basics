<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           All Category <b>  </b>
            <b style="float:right;">
                Total Category <span class="badge bg-danger"> </span>
            </b>
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
                        <tr>
                            <th scope="col">Sl No</th>
                            <th scope="col">cate.Name</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                        </table>
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
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>