<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Products') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3"><i class="bi bi-bag"></i> My Products</h1>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add New Product
                    </a>
                </div>

                @if($products->count() > 0)
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-4 col-lg-3 mb-4">
                                <div class="card h-100 shadow-sm">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             class="card-img-top"
                                             alt="{{ $product->name }}"
                                             style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                             style="height: 200px;">
                                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif

                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text text-muted small flex-grow-1">
                                            {{ Str::limit($product->description, 100) }}
                                        </p>
                                        <div class="mt-auto">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="h5 text-success mb-0">
                                                    ${{ number_format($product->price, 2) }}
                                                </span>
                                                <small class="text-muted">
                                                    {{ $product->created_at->format('M d, Y') }}
                                                </small>
                                            </div>
                                            <div class="btn-group w-100" role="group">
                                                <a href="{{ route('products.show', $product) }}"
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                                <a href="{{ route('products.edit', $product) }}"
                                                   class="btn btn-outline-warning btn-sm">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <button type="button"
                                                        class="btn btn-outline-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $product->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal for each product -->
                                <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Delete Product</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-1">Delete <strong>{{ $product->name }}</strong>?</p>
                                                <small class="text-muted">This cannot be undone.</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-bag text-muted" style="font-size: 4rem;"></i>
                        <h3 class="text-muted mt-3">No products yet</h3>
                        <p class="text-muted">Start building your product catalog!</p>
                        <a href="{{ route('products.create') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Add Your First Product
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
