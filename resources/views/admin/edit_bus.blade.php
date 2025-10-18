@extends('home')
@section('title', 'Edit Tipe Bus')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Edit Tipe Bus</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg mb-4">
        <div class="card-body">
            <form action="{{ url('/bus_type/update/'.$bus->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="type">Tipe Bus</label>
                    <input type="text" name="type" id="type" class="form-control" value="{{ old('type', $bus->type) }}" required>
                </div>
                <div class="mb-3">
                    <label for="price">Harga</label>
                    <input type="text" name="price" id="price" class="form-control" value="{{ old('price', $bus->price) }}" required>
                </div>
                <div class="mb-3">
                    <label for="facility">Fasilitas</label>
                    <input type="text" name="facility" id="facility" class="form-control" value="{{ old('facility', $bus->facility) }}" required>
                </div>
                <div class="mb-3">
                    <label for="seat_capacity">Kapasitas</label>
                    <textarea name="seat_capacity" id="seat_capacity" rows="3" class="form-control" required>{{ old('seat_capacity', $bus->seat_capacity) }}</textarea>
                </div>

                <div class="mb-3">
                <label for="status_ketersediaan" class="form-label">Status Ketersediaan</label>
                <select name="status_ketersediaan" id="status_ketersediaan" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Tersedia" {{ old('status_ketersediaan') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Dipesan" {{ old('status_ketersediaan') == 'Dipesan' ? 'selected' : '' }}>Dipesan</option>
                    <option value="Dalam Perawatan" {{ old('status_ketersediaan') == 'Dalam Perawatan' ? 'selected' : '' }}>Dalam Perawatan</option>
                </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="image">Upload Foto (opsional)</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-6 mb-3">
                        @if($bus->image)
                            <label>Foto Saat Ini</label>
                            <div>
                                <img src="{{ asset('storage/'.$bus->image) }}" alt="Foto Bus" style="max-height: 120px;"/>
                            </div>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection



