@extends('layouts.app')

@section('content')
<div id="createPage">
    <div class="create-page">
        <div class="create-header">
            <button onclick="window.location.href='{{ url('/') }}'">
                <i class="fas fa-arrow-left"></i>
            </button>
            <h2>Jual Buku</h2>
            <div style="width: 30px;"></div>
        </div>
        
        <div class="create-form">
            <form id="createItemForm" enctype="multipart/form-data">
                <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p style="font-size: 18px; color: #1e293b; font-weight: 600; margin-bottom: 5px;">Upload Gambar</p>
                    <p class="photo-count">Foto 0/1</p>
                    <p style="font-size: 13px;">Max 2mb</p>
                    <input type="file" id="fileInput" name="image" style="display: none;" accept="image/*">
                </div>
                
                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g., Kalkulus Lanjut" required>
                </div>
                
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" name="author" class="form-control" placeholder="e.g., John Doe" required>
                </div>
                
                <div class="form-group">
                    <label>Kategori Mata Kuliah</label>
                    <select name="category" class="custom-select" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="Manajemen Proses Bisnis">Manajemen Proses Bisnis</option>
                        <option value="Pemrograman">Pemrograman</option>
                        <option value="Matematika">Matematika</option>
                        <option value="Fisika">Fisika</option>
                        <option value="Kimia">Kimia</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Kondisi</label>
                    <select name="condition" class="custom-select" required>
                        <option value="" disabled selected>Pilih Kondisi</option>
                        <option value="Baru">Baru</option>
                        <option value="Seperti Baru">Seperti Baru</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="number" name="sell_price" class="form-control" placeholder="e.g., 50000" required>
                </div>
                
                <div class="form-group">
                    <label>Harga Sewa (per semester)</label>
                    <input type="number" name="rent_price" class="form-control" placeholder="Opsional">
                </div>
                
                <button type="submit" class="submit-btn">Jual/Sewa</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('createItemForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const token = localStorage.getItem('access_token');

        if (!token) {
            Swal.fire({
                icon: 'error',
                title: 'Authentication Error',
                text: 'You must be logged in to post an item.',
            });
            return;
        }

        try {
            const response = await fetch('{{ url('/api/books') }}', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '{{ url('/') }}';
                });
            } else {
                let errorMessage = 'Failed to post item.';
                if (data.errors) {
                    errorMessage = Object.values(data.errors).flat().join('\\n');
                } else if (data.message) {
                    errorMessage = data.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred. Please try again.',
            });
        }
    });
    
    // File upload handling
    document.getElementById('fileInput').addEventListener('change', function(e) {
        const count = e.target.files.length;
        document.querySelector('.photo-count').textContent = `Foto ${count}/1`;
    });
</script>
@endpush
