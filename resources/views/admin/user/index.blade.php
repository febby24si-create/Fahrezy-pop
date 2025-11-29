@extends('layouts.admin.app')

@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data User</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Data User</h1>
            <p class="mb-0">Kelola seluruh data pengguna sistem</p>
        </div>
        <div>
            <a href="{{ route('user.create') }}" class="btn btn-primary d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah User
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                <h2 class="h5 mb-0">Daftar Pengguna</h2>
                <div class="d-flex">
                    @if(request()->has('search') || request()->has('role') || request()->has('status'))
                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-outline-secondary me-2">
                            <svg class="icon icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reset Filter
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">

                <!-- SEARCH & FILTER -->
                <form method="GET" action="{{ route('user.index') }}">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama atau email..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="role">
                                <option value="all" {{ request('role') == 'all' || !request('role') ? 'selected' : '' }}>Semua Role</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pegawai" {{ request('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="status">
                                <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>Semua Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Terapkan</button>
                        </div>
                    </div>
                </form>

                <!-- FILTER ACTIVE BADGES -->
                @if(request()->has('search') || (request('role') && request('role') != 'all') || (request('status') && request('status') != 'all'))
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <small class="text-muted">Filter aktif:</small>
                            @if(request('search'))
                            <span class="badge bg-primary">
                                Pencarian: "{{ request('search') }}"
                                <a href="{{ route('user.index', array_merge(request()->except('search'), ['role' => request('role'), 'status' => request('status')])) }}" class="text-white ms-1">
                                    <svg class="icon icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </span>
                            @endif
                            @if(request('role') && request('role') != 'all')
                            <span class="badge bg-info">
                                Role: {{ ucfirst(request('role')) }}
                                <a href="{{ route('user.index', array_merge(request()->except('role'), ['search' => request('search'), 'status' => request('status')])) }}" class="text-white ms-1">
                                    <svg class="icon icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </span>
                            @endif
                            @if(request('status') && request('status') != 'all')
                            <span class="badge bg-warning">
                                Status: {{ ucfirst(request('status')) }}
                                <a href="{{ route('user.index', array_merge(request()->except('status'), ['search' => request('search'), 'role' => request('role')])) }}" class="text-white ms-1">
                                    <svg class="icon icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0 rounded-start">User</th>
                                <th class="border-0">Email</th>
                                <th class="border-0">Role</th>
                                <th class="border-0">Status</th>
                                <th class="border-0 text-center rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataUser as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($item->profile_picture)
                                                <img src="{{ asset('storage/' . $item->profile_picture) }}" 
                                                     alt="Profile Picture" 
                                                     class="avatar rounded-circle me-3" 
                                                     width="40" 
                                                     height="40"
                                                     style="object-fit: cover;">
                                            @else
                                                <div class="avatar rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold me-3"
                                                     style="width: 40px; height: 40px;">
                                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div class="d-block">
                                                <span class="fw-bold">{{ $item->name }}</span>
                                                <div class="small text-gray">{{ $item->created_at->format('d M Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">{{ $item->email }}</td>
                                    <td>
                                        <span class="badge {{ $item->role == 'admin' ? 'bg-danger' : 'bg-primary' }} rounded-pill">
                                            <svg class="icon icon-xs me-1" fill="currentColor" viewBox="0 0 20 20">
                                                @if($item->role == 'admin')
                                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                                @else
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                                @endif
                                            </svg>
                                            {{ ucfirst($item->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $item->status == 'active' ? 'bg-success' : 'bg-warning' }} rounded-pill">
                                            <svg class="icon icon-xs me-1" fill="currentColor" viewBox="0 0 20 20">
                                                @if($item->status == 'active')
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                @else
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                @endif
                                            </svg>
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-sm btn-outline-gray-600 me-2">
                                                <svg class="icon icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('user.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus user?')">
                                                    <svg class="icon icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <svg class="icon icon-xxs text-gray-400 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Tidak ada data user yang ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="mt-4 d-flex justify-content-between align-items-center flex-column flex-md-row">
                    <div class="text-muted small mb-3 mb-md-0">
                        Menampilkan {{ $dataUser->firstItem() ?? 0 }} - {{ $dataUser->lastItem() ?? 0 }} dari {{ $dataUser->total() }} user
                    </div>
                    <div>
                        {{ $dataUser->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
.avatar {
    object-fit: cover;
}
.table > :not(caption) > * > * {
    padding: 1rem 0.5rem;
}
.card-header {
    background-color: rgba(0,0,0,.03);
    border-bottom: 1px solid rgba(0,0,0,.125);
}
</style>
@endpush