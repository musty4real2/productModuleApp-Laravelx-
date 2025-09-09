<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3"><i class="bi bi-grid"></i> All Products</h1>
                    @auth
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add New Product
                        </a>
                    @endauth
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
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="h5 text-success mb-0">
                                                    ${{ number_format($product->price, 2) }}
                                                </span>
                                                <small class="text-muted">
                                                    by {{ $product->user->name }}
                                                </small>
                                            </div>
                                            <div class="mt-2">
                                                <a href="{{ route('products.show', $product) }}"
                                                   class="btn btn-outline-primary btn-sm w-100">
                                                    <i class="bi bi-eye"></i> View Details
                                                </a>
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
                        <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                        <h3 class="text-muted mt-3">No products found</h3>
                        <p class="text-muted">Be the first to add a product!</p>
                        @auth
                            <a href="{{ route('products.create') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-plus-circle"></i> Add Your First Product
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-box-arrow-in-right"></i> Login to Add Products
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
