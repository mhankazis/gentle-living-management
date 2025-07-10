<!-- Products Page -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <aside class="lg:w-1/4">
                @include('components.product-filter')
            </aside>
            <main class="lg:w-3/4">
                @include('components.product-grid')
            </main>
        </div>
    </div>
    @include('components.footer')
</div>
@endsection
