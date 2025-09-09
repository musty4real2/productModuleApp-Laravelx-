<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-4">
                    <i class="bi bi-speedometer2"></i> Welcome back, {{ auth()->user()->name }}!
                </h1>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">My Products</h5>
                                <h2 class="mb-0">{{ auth()->user()->products()->count() }}</h2>
                            </div>
                            <div class="text-primary-emphasis">
                                <i class="bi bi-bag" style="font-size: 2rem; opacity: 0.5;"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('products.my-products') }}" class="btn btn-light btn-sm">
                                View All <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Value</h5>
                                <h2 class="mb-0">
                                    ${{ number_format(auth()->user()->products()->sum('price'), 2) }}
                                </h2>
                            </div>
                            <div class="text-success-emphasis">
                                <i class="bi bi-currency-dollar" style="font-size: 2rem; opacity: 0.5;"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            <small>Combined value of all products</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-info text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Latest Product</h5>
                                <h6 class="mb-0">
                                    @if(auth()->user()->products()->count() > 0)
                                        {{ Str::limit(auth()->user()->products()->latest()->first()->name, 20) }}
                                    @else
                                        None yet
                                    @endif
                                </h6>
                            </div>
                            <div class="text-info-emphasis">
                                <i class="bi bi-clock-history" style="font-size: 2rem; opacity: 0.5;"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            @if(auth()->user()->products()->count() > 0)
                                <small>Added {{ auth()->user()->products()->latest()->first()->created_at->diffForHumans() }}</small>
                            @else
                                <a href="{{ route('products.create') }}" class="btn btn-light btn-sm">
                                    Add First Product <i class="bi bi-plus"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-lightning"></i> Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('products.create') }}" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-plus-circle"></i><br>
                                    <small>Add Product</small>
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('products.my-products') }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-bag"></i><br>
                                    <small>My Products</small>
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-info w-100">
                                    <i class="bi bi-grid"></i><br>
                                    <small>Browse All</small>
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-warning w-100">
                                    <i class="bi bi-person"></i><br>
                                    <small>Edit Profile</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Products -->
        @php
            $recentProducts = auth()->user()->products()->latest()->take(3)->get();
        @endphp

        @if($recentProducts->count() > 0)
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="bi bi-clock-history"></i> Your Recent Products</h5>
                            <a href="{{ route('products.my-products') }}" class="btn btn-sm btn-outline-primary">
                                View All <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($recentProducts as $product)
                                    <div class="col-md-4 mb-3">
                                        <div class="card border">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                     class="card-img-top"
                                                     alt="{{ $product->name }}"
                                                     style="height: 150px; object-fit: cover;">
                                            @else
                                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                                     style="height: 150px;">
                                                    <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                                </div>
                                            @endif
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $product->name }}</h6>
                                                <p class="card-text">
                                                    <span class="text-success fw-bold">${{ number_format($product->price, 2) }}</span><br>
                                                    <small class="text-muted">{{ $product->created_at->diffForHumans() }}</small>
                                                </p>
                                                <a href="{{ route('products.show', $product) }}"
                                                   class="btn btn-sm btn-outline-primary">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-bag text-muted" style="font-size: 4rem;"></i>
                            <h4 class="text-muted mt-3">No products yet!</h4>
                            <p class="text-muted">Start by adding your first product to get started.</p>
                            <a href="{{ route('products.create') }}" class="btn btn-primary mt-2">
                                <i class="bi bi-plus-circle"></i> Add Your First Product
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
