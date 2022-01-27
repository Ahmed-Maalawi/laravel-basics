<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Brand
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> {{ session('success')}} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header text-capitalize">Edit Brand</div>
                        <div class="card-body">
                            <form class="text-capitalize" action="{{ route('brand.update', ['id' => $brands->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input hidden name="old_image" class="form-control" id="old_image" value="{{ $brands->brand_image }}">
                                <div class="mb-3">
                                    <label for="brand_name" class="form-label">update brand name</label>
                                    <input type="text" name="brand_name" class="form-control" id="brand_name" value="{{ $brands->brand_name }}">
                                </div>
                                @error('brand_name')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                                <div class="mb-3">
                                    <label for="brand_image" class="form-label">update brand image</label>
                                    <input type="file" name="brand_image" class="form-control" id="brand_image" value=" {{ $brands->brand_image }}">
                                </div>
                                @error('brand_image')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror

                                <div class="form-group mb-5">
                                    <img src="{{asset($brands->brand_image)}}" alt="brand-image" class="rounded" style="width:400px;height:200px;">
                                </div>
                                <button type="submit" class="btn btn-outline-primary">update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
