<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="img-fluid rounded shadow"
                         alt="{{ $product->name }}"
                         style="width: 100%; height: 400px; object-fit: cover;">
                @else
                    <div class="bg-light rounded shadow d-flex align-items-center justify-content-center"
                         style="width: 100%; height: 400px;">
                        <div class="text-center text-muted">
                            <i class="bi bi-image" style="font-size: 4rem;"></i>
                            <p class="mt-2">No image available</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title h3 mb-3">{{ $product->name }}</h1>

                        <div class="mb-3">
                            <span class="h2 text-success">${{ number_format($product->price, 2) }}</span>
                        </div>

                        @if($product->description)
                            <div class="mb-4">
                                <h5>Description</h5>
                                <p class="text-muted">{{ $product->description }}</p>
                            </div>
                        @endif

                        <div class="mb-4">
                            <small class="text-muted">
                                <i class="bi bi-person"></i> Listed by <strong>{{ $product->user->name }}</strong><br>
                                <i class="bi bi-calendar"></i> Added {{ $product->created_at->format('M d, Y') }}
                                @if($product->updated_at != $product->created_at)
                                    <br><i class="bi bi-pencil"></i> Updated {{ $product->updated_at->format('M d, Y') }}
                                @endif
                            </small>
                        </div>

                        @can('update', $product)
                            <div class="d-grid gap-2">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Edit Product
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash"></i> Delete Product
                                </button>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="text-center">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to All Products
                    </a>
                </div>
            </div>
        </div>
    </div>

    @can('delete', $product)
        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <strong>{{ $product->name }}</strong>?</p>
                        <p class="text-muted">This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
</x-app-layout>
