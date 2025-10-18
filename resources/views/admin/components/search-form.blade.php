<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ request()->url() }}" class="row g-3">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" 
                           class="form-control" 
                           name="search" 
                           placeholder="Cari data..." 
                           value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </div>
            <div class="col-md-4 text-end">
                @if(request('search'))
                    <a href="{{ request()->url() }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Hapus Pencarian
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

