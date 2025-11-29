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
                <li class="breadcrumb-item active" aria-current="Edit Pelanggan">Edit Pelanggan</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit Pelanggan</h1>
                <p class="mb-0">Ubah data pelanggan yang dipilih.</p>
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
                    <!-- Form Edit Data Pelanggan -->
                    <form action="{{ route('pelanggan.update', $dataPelanggan->pelanggan_id) }}" method="POST">
                        @csrf
                        @method('PUT')

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
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                                    value="{{ old('first_name', $dataPelanggan->first_name) }}" placeholder="Masukkan nama depan" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                                    value="{{ old('last_name', $dataPelanggan->last_name) }}" placeholder="Masukkan nama belakang" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="birthday" class="form-label">Birthday <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <svg class="icon icon-xs text-gray-600" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                    <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="birthday" name="birthday"
                                        value="{{ old('birthday', $dataPelanggan->birthday) }}" required>
                                    @error('birthday')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                    <option value="">-- Pilih Gender --</option>
                                    <option value="Male" {{ old('gender', $dataPelanggan->gender) == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Female" {{ old('gender', $dataPelanggan->gender) == 'Female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                    value="{{ old('email', $dataPelanggan->email) }}" placeholder="Masukkan alamat email" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                    value="{{ old('phone', $dataPelanggan->phone) }}" placeholder="Masukkan nomor telepon" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Data Pelanggan
                            </button>
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary ms-2">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                        </div>
                    </form>

                    <!-- Form Upload File (Terpisah) -->
                    <hr class="my-5">
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="mb-3">Upload File Pendukung</h5>
                            
                            <!-- Form Upload File -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <form action="{{ route('multipleupload.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                                        @csrf
                                        <input type="hidden" name="ref_table" value="pelanggan">
                                        <input type="hidden" name="ref_id" value="{{ $dataPelanggan->pelanggan_id }}">
                                        
                                        <div class="mb-3">
                                            <label for="files" class="form-label">Upload File Pendukung (Dokumen, Gambar, Video)</label>
                                            <input type="file" class="form-control @error('files.*') is-invalid @enderror" 
                                                   id="files" name="files[]" multiple required>
                                            @error('files.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                Format yang didukung: 
                                                <strong>Dokumen:</strong> PDF, DOC, DOCX, XLS, XLSX | 
                                                <strong>Gambar:</strong> JPG, JPEG, PNG, GIF | 
                                                <strong>Video:</strong> MP4, AVI, MOV, WMV, FLV, WEBM.
                                                Maksimal 50MB per file.
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-upload me-1"></i> Upload File
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Daftar File -->
                            <h6 class="mb-3">Daftar File Pendukung ({{ $dataPelanggan->files->count() }})</h6>
                            @if($dataPelanggan->files->count() > 0)
                                <div class="row">
                                    @foreach($dataPelanggan->files as $file)
                                        <div class="col-lg-4 col-md-6 mb-4">
                                            <div class="card file-card h-100">
                                                <div class="card-body">
                                                    <!-- File Icon/Thumbnail/Video Player -->
                                                    <div class="text-center mb-3">
                                                        @php
                                                            $extension = strtolower(pathinfo($file->original_name, PATHINFO_EXTENSION));
                                                            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                                                            $isVideo = in_array($extension, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm']);
                                                            $fileTypes = [
                                                                'pdf' => ['icon' => 'file-pdf', 'color' => 'danger', 'bg' => 'bg-danger-light'],
                                                                'doc' => ['icon' => 'file-word', 'color' => 'primary', 'bg' => 'bg-primary-light'],
                                                                'docx' => ['icon' => 'file-word', 'color' => 'primary', 'bg' => 'bg-primary-light'],
                                                                'xls' => ['icon' => 'file-excel', 'color' => 'success', 'bg' => 'bg-success-light'],
                                                                'xlsx' => ['icon' => 'file-excel', 'color' => 'success', 'bg' => 'bg-success-light'],
                                                                'mp4' => ['icon' => 'file-video', 'color' => 'warning', 'bg' => 'bg-warning-light'],
                                                                'avi' => ['icon' => 'file-video', 'color' => 'warning', 'bg' => 'bg-warning-light'],
                                                                'mov' => ['icon' => 'file-video', 'color' => 'warning', 'bg' => 'bg-warning-light'],
                                                                'wmv' => ['icon' => 'file-video', 'color' => 'warning', 'bg' => 'bg-warning-light'],
                                                                'flv' => ['icon' => 'file-video', 'color' => 'warning', 'bg' => 'bg-warning-light'],
                                                                'webm' => ['icon' => 'file-video', 'color' => 'warning', 'bg' => 'bg-warning-light'],
                                                                'zip' => ['icon' => 'file-archive', 'color' => 'secondary', 'bg' => 'bg-secondary-light'],
                                                                'rar' => ['icon' => 'file-archive', 'color' => 'secondary', 'bg' => 'bg-secondary-light'],
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
                                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                                                                <div class="file-icon-placeholder {{ $fileType['bg'] }} rounded d-none" 
                                                                     style="height: 120px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fas fa-{{ $fileType['icon'] }} fa-3x text-{{ $fileType['color'] }}"></i>
                                                                </div>
                                                            </div>
                                                        @elseif($isVideo)
                                                            <div class="file-video mb-2">
                                                                <video controls style="max-height: 120px; width: 100%; border-radius: 8px;">
                                                                    <source src="{{ asset('storage/' . $file->file_path) }}" type="video/{{ $extension }}">
                                                                    Browser Anda tidak mendukung pemutar video.
                                                                </video>
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
                                                            @if($isImage || $isVideo)
                                                                <a href="{{ asset('storage/' . $file->file_path) }}" 
                                                                   target="_blank" 
                                                                   class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center"
                                                                   data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   title="Lihat File">
                                                                    <i class="fas fa-eye me-1"></i>
                                                                    <span class="d-none d-sm-inline">Lihat</span>
                                                                </a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $file->file_path) }}" 
                                                                   target="_blank" 
                                                                   class="btn btn-outline-info btn-sm d-flex align-items-center justify-content-center"
                                                                   data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   title="Preview File">
                                                                    <i class="fas fa-search me-1"></i>
                                                                    <span class="d-none d-sm-inline">Preview</span>
                                                                </a>
                                                            @endif
                                                            
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
@endsection
