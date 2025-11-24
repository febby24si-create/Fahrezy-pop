@extends('layouts.admin.app')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="Detail Pelanggan">Detail Pelanggan</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Detail Pelanggan</h1>
                <p class="mb-0">Data lengkap pelanggan dan file pendukung.</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row">
                        <!-- Data Pelanggan -->
                        <div class="col-md-6">
                            <h5 class="mb-3">Data Pribadi</h5>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th width="30%">First Name</th>
                                    <td>{{ $dataPelanggan->first_name }}</td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td>{{ $dataPelanggan->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Birthday</th>
                                    <td>{{ $dataPelanggan->birthday ? \Carbon\Carbon::parse($dataPelanggan->birthday)->format('d/m/Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>
                                        @if($dataPelanggan->gender == 'Male')
                                            <span class="badge bg-primary">Laki-laki</span>
                                        @elseif($dataPelanggan->gender == 'Female')
                                            <span class="badge bg-success">Perempuan</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $dataPelanggan->gender }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $dataPelanggan->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $dataPelanggan->phone }}</td>
                                </tr>
                            </table>

                            <div class="mt-4">
                                <a href="{{ route('pelanggan.edit', $dataPelanggan->pelanggan_id) }}" class="btn btn-primary me-2">
                                    <i class="fas fa-edit me-1"></i> Edit Data
                                </a>
                            </div>
                        </div>

                        <!-- File Upload Section -->
                        <div class="col-md-6">
                            <h5 class="mb-3">File Pendukung</h5>
                            
                            <!-- Form Upload File -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <form action="{{ route('multipleupload.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="ref_table" value="pelanggan">
                                        <input type="hidden" name="ref_id" value="{{ $dataPelanggan->pelanggan_id }}">
                                        
                                        <div class="mb-3">
                                            <label for="files" class="form-label">Upload File Pendukung</label>
                                            <input type="file" class="form-control @error('files.*') is-invalid @enderror" 
                                                   id="files" name="files[]" multiple required>
                                            @error('files.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                Format yang didukung: JPG, JPEG, PNG, GIF, PDF, DOC, DOCX, XLS, XLSX. Maksimal 2MB per file.
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-upload me-1"></i> Upload File
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Daftar File -->
                            <h6 class="mb-3">Daftar File Pendukung ({{ $files->count() }})</h6>
                            @if($files->count() > 0)
                                <div class="row">
                                    @foreach($files as $file)
                                        <div class="col-lg-4 col-md-6 mb-4">
                                            <div class="card file-card h-100">
                                                <div class="card-body">
                                                    <!-- File Icon/Thumbnail -->
                                                    <div class="text-center mb-3">
                                                        @php
                                                            $extension = strtolower(pathinfo($file->original_name, PATHINFO_EXTENSION));
                                                            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                                                            $fileTypes = [
                                                                'pdf' => ['icon' => 'file-pdf', 'color' => 'danger', 'bg' => 'bg-danger-light'],
                                                                'doc' => ['icon' => 'file-word', 'color' => 'primary', 'bg' => 'bg-primary-light'],
                                                                'docx' => ['icon' => 'file-word', 'color' => 'primary', 'bg' => 'bg-primary-light'],
                                                                'xls' => ['icon' => 'file-excel', 'color' => 'success', 'bg' => 'bg-success-light'],
                                                                'xlsx' => ['icon' => 'file-excel', 'color' => 'success', 'bg' => 'bg-success-light'],
                                                                'zip' => ['icon' => 'file-archive', 'color' => 'warning', 'bg' => 'bg-warning-light'],
                                                                'rar' => ['icon' => 'file-archive', 'color' => 'warning', 'bg' => 'bg-warning-light'],
                                                                'default' => ['icon' => 'file', 'color' => 'secondary', 'bg' => 'bg-secondary-light']
                                                            ];
                                                            
                                                            $fileType = $fileTypes[$extension] ?? $fileTypes['default'];
                                                        @endphp
                                                        
                                                        @if($isImage)
                                                            <div class="file-thumbnail mb-2">
                                                                <img src="{{ asset('storage/' . $file->file_path) }}" 
                                                                     alt="{{ $file->original_name }}" 
                                                                     class="rounded img-fluid"
                                                                     style="max-height: 120px; width: auto; object-fit: cover;"
                                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                                <div class="file-icon-placeholder {{ $fileType['bg'] }} rounded d-none" 
                                                                     style="height: 120px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fas fa-{{ $fileType['icon'] }} fa-3x text-{{ $fileType['color'] }}"></i>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="file-icon {{ $fileType['bg'] }} rounded p-4 mb-2">
                                                                <i class="fas fa-{{ $fileType['icon'] }} fa-3x text-{{ $fileType['color'] }}"></i>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <!-- File Info -->
                                                    <div class="file-info text-center">
                                                        <h6 class="file-name text-truncate" title="{{ $file->original_name }}">
                                                            {{ $file->original_name }}
                                                        </h6>
                                                        <small class="text-muted">
                                                            {{ strtoupper($extension) }} • 
                                                            {{ \Carbon\Carbon::parse($file->created_at)->format('d/m/Y H:i') }}
                                                        </small>
                                                    </div>

                                                    <!-- Action Buttons -->
                                                    <div class="file-actions mt-3">
                                                        <div class="btn-group w-100" role="group">
                                                            <!-- Preview Button -->
                                                            <a href="{{ asset('storage/' . $file->file_path) }}" 
                                                               target="_blank" 
                                                               class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center"
                                                               data-bs-toggle="tooltip"
                                                               data-bs-placement="top"
                                                               title="Lihat File">
                                                                <i class="fas fa-eye me-1"></i>
                                                                <span class="d-none d-sm-inline">Lihat</span>
                                                            </a>
                                                            
                                                            <!-- Download Button -->
                                                            <a href="{{ asset('storage/' . $file->file_path) }}" 
                                                               download="{{ $file->original_name }}"
                                                               class="btn btn-outline-success btn-sm d-flex align-items-center justify-content-center"
                                                               data-bs-toggle="tooltip"
                                                               data-bs-placement="top"
                                                               title="Download File">
                                                                <i class="fas fa-download me-1"></i>
                                                                <span class="d-none d-sm-inline">Download</span>
                                                            </a>
                                                            
                                                            <!-- Delete Button -->
                                                            <form action="{{ route('multipleupload.destroy', $file->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="Hapus File"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus file {{ $file->original_name }}?')">
                                                                    <i class="fas fa-trash me-1"></i>
                                                                    <span class="d-none d-sm-inline">Hapus</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada file pendukung</h5>
                                        <p class="text-muted">Upload file pertama Anda dengan form di atas</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .file-card {
            border: 1px solid #e3f2fd;
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .file-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-color: #2196F3;
        }
        
        .file-icon {
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .file-card:hover .file-icon {
            transform: scale(1.05);
        }
        
        .file-thumbnail {
            position: relative;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .file-thumbnail img {
            transition: transform 0.3s ease;
        }
        
        .file-card:hover .file-thumbnail img {
            transform: scale(1.05);
        }
        
        .file-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.25rem;
        }
        
        .file-actions .btn-group {
            gap: 1px;
        }
        
        .file-actions .btn {
            flex: 1;
            padding: 0.375rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 0;
            transition: all 0.2s ease;
        }
        
        .file-actions .btn:first-child {
            border-top-left-radius: 0.375rem;
            border-bottom-left-radius: 0.375rem;
        }
        
        .file-actions .btn:last-child {
            border-top-right-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
        }
        
        .file-actions .btn:hover {
            transform: translateY(-1px);
        }
        
        /* Background colors for file types */
        .bg-danger-light { background-color: rgba(220, 53, 69, 0.1); }
        .bg-primary-light { background-color: rgba(13, 110, 253, 0.1); }
        .bg-success-light { background-color: rgba(25, 135, 84, 0.1); }
        .bg-warning-light { background-color: rgba(255, 193, 7, 0.1); }
        .bg-secondary-light { background-color: rgba(108, 117, 125, 0.1); }
        
        .empty-state {
            opacity: 0.7;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .file-actions .btn span {
                display: none;
            }
            
            .file-actions .btn i {
                margin-right: 0 !important;
            }
            
            .file-name {
                font-size: 0.8rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            document.querySelectorAll('.file-thumbnail img').forEach(function(img) {
                img.addEventListener('error', function() {
                    this.style.display = 'none';
                    var placeholder = this.nextElementSibling;
                    if (placeholder) {
                        placeholder.style.display = 'flex';
                    }
                });
            });
        });
    </script>
@endsection