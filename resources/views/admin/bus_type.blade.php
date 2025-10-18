@extends('home')
@section('title', 'Tipe Bus')
@section('content')

<!-- Include TailwindCSS -->
<script src="https://cdn.tailwindcss.com"></script>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Data Tipe Bus</h1>
        <a href="{{ route('bus.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition duration-300 flex items-center gap-2">
            <i class="fas fa-plus"></i>
            <span>Tambah Data</span>
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Form -->
    <div class="mb-6">
        <form method="GET" action="{{ request()->url() }}" class="flex gap-4 items-center">
            <div class="flex-1">
                <input type="text" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       name="search" 
                       placeholder="Cari tipe bus, kapasitas, atau fasilitas..." 
                       value="{{ request('search') }}">
            </div>
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-300 flex items-center gap-2" type="submit">
                <i class="fas fa-search"></i>
                <span>Cari</span>
            </button>
            @if(request('search'))
                <a href="{{ request()->url() }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-times"></i> Hapus
                </a>
            @endif
        </form>
    </div>

    <!-- Card Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($data as $value)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
            <!-- Bus Image -->
            <div class="h-48 w-full overflow-hidden">
                @if(!empty($value->image))
                    <img src="{{ asset('storage/images/'.$value->image) }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <div class="text-center text-gray-500">
                            <i class="fas fa-bus text-4xl mb-2"></i>
                            <p class="text-sm">Tidak ada gambar</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Card Content -->
            <div class="p-6">
                <!-- Bus Type Name -->
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $value->type }}</h3>
                
                <!-- Price -->
                <div class="mb-3">
                    <span class="text-2xl font-bold text-green-600">
                        Rp {{ number_format($value->price, 0, ',', '.') }}
                    </span>
                </div>

                <!-- Amenities and Capacity -->
                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-couch w-4 h-4 mr-2 text-blue-500"></i>
                        <span>{{ $value->facility }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-users w-4 h-4 mr-2 text-purple-500"></i>
                        <span>{{ $value->seat_capacity }} Kursi</span>
                    </div>
                </div>
                
                <div class="flex items-center text-sm text-gray-600">
                <i class="fas fa-info-circle w-4 h-4 mr-2 text-green-500"></i>
                <span>
                    Status: 
                    <span class="font-semibold 
                        {{ $value->status_ketersediaan == 'Tersedia' ? 'text-green-600' : 'text-yellow-600' }}">
                        {{ $value->status_ketersediaan }}
                    </span>
                </span>
            </div>


                <!-- Action Buttons -->
                <div class="flex gap-2 pt-4 border-t border-gray-100">
                    <!-- Edit Button -->
                    <a href="{{ route('bus.edit', $value->id) }}" 
                       class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-center transition duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-edit"></i>
                        <span class="text-sm font-medium">Edit</span>
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ url('/bus_type/delete/'.$value->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus tipe bus ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-trash"></i>
                            <span class="text-sm font-medium">Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($data->isEmpty())
        <div class="text-center py-12">
            <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-bus text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada data bus</h3>
            <p class="text-gray-500 mb-4">Mulai dengan menambahkan tipe bus pertama Anda</p>
            <a href="{{ route('bus.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-300">
                Tambah Bus Pertama
            </a>
        </div>
    @endif

    <!-- Pagination -->
    @if($data->hasPages())
        <div class="flex justify-center mt-8">
            {{ $data->appends(request()->query())->links() }}
        </div>
    @endif

</div>
@endsection
