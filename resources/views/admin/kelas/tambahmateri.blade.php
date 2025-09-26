@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kelas.simpanvideo', $id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Judul Materi</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="type">Tipe Materi</label>
                        <select class="form-control" id="type" name="type" required onchange="toggleFields()">
                            <option value="">Pilih Tipe</option>
                            <option value="video">Video</option>
                            <option value="text">Teks</option>
                            <option value="document">Dokumen</option>
                        </select>
                    </div>

                    <div class="form-group" id="urlField" style="display: none;">
                        <label for="url">URL Video</label>
                        <input type="url" class="form-control" id="url" name="url" placeholder="Masukkan URL video">
                    </div>

                    <div class="form-group" id="contentField" style="display: none;">
                        <label for="content">Konten Teks</label>
                        <textarea class="form-control" id="content" name="content" rows="10"></textarea>
                        <script>
                            CKEDITOR.replace('content', {
                                height: 400,
                                filebrowserUploadUrl: "{{ route('admin.upload', ['_token' => csrf_token()]) }}",
                                filebrowserUploadMethod: 'form'
                            });
                        </script>
                    </div>

                    <div class="form-group" id="fileField" style="display: none;">
                        <label for="file">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx,.mp4,.avi,.mov">
                        <small class="form-text text-muted">Maksimal 50MB. Format: PDF, DOC, DOCX, MP4, AVI, MOV</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.kelas.detail', $id) }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFields() {
    const type = document.getElementById('type').value;
    const urlField = document.getElementById('urlField');
    const contentField = document.getElementById('contentField');
    const fileField = document.getElementById('fileField');

    // Hide all fields first
    urlField.style.display = 'none';
    contentField.style.display = 'none';
    fileField.style.display = 'none';

    // Show relevant field based on type
    if (type === 'video') {
        urlField.style.display = 'block';
    } else if (type === 'text') {
        contentField.style.display = 'block';
    } else if (type === 'document') {
        fileField.style.display = 'block';
    }
}
</script>

@endsection
