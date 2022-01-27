<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semisolid text-xl text-gray-800 leading-tight">
            All Brands
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
                        <div class="card-header">All Brands</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr class="text-capitalize">
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">created at</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($brands as $brand)
                                    <tr>
                                        <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td><img src="{{ asset($brand->brand_image) }}" alt="brand image" style="height:40px; width:70px;"></td>
                                        <td>
                                            @if( $brand->created_at == NULL )
                                                <span class="text-danger">no data set</span>
                                            @else
                                                {{ $brand->created_at->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('brand.edit', ['id' => $brand->id]) }}" class="btn btn-secondary">edit</a>
                                            <a href="{{ route('brand.softdelete',['id' => $brand->id]) }}" class="btn btn-danger">delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $brands->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-capitalize">add Brand</div>
                        <div class="card-body">
                            <form class="text-capitalize" action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="brand_name" class="form-label">brand name</label>
                                    <input type="text" name="brand_name" class="form-control" id="brand_name">
                                </div>
                                @error('brand_name')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                                <div class=" form-group mb-3">
                                    <label for="brand_image" class="form-label">brand name</label>
                                    <input type="file" name="brand_image" class="form-control" id="brand_image">
                                </div>
                                @error('brand_image')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                                <button type="submit" class="btn btn-outline-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
