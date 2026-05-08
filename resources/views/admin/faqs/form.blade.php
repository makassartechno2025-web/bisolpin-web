@extends('admin.layout')
@section('title', isset($faq) ? 'Edit FAQ' : 'Tambah FAQ')
@section('page-title', isset($faq) ? 'Edit FAQ' : 'Tambah FAQ Baru')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header"><i class="fas fa-question-circle me-2" style="color:#1BA89C;"></i>{{ isset($faq) ? 'Edit' : 'Tambah' }} FAQ</div>
            <div class="card-body p-4">
                <form action="{{ isset($faq) ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}" method="POST">
                    @csrf @if(isset($faq)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                        <input type="text" name="question" class="form-control" required
                               value="{{ old('question', $faq->question ?? '') }}"
                               placeholder="Tulis pertanyaan yang sering ditanyakan...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jawaban <span class="text-danger">*</span></label>
                        <textarea name="answer" id="faqAnswer" class="form-control" rows="6" required
                                  placeholder="Tulis jawaban yang jelas dan informatif...">{{ old('answer', $faq->answer ?? '') }}</textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kategori <span class="text-muted fw-normal">(opsional)</span></label>
                            <input type="text" name="category" class="form-control"
                                   value="{{ old('category', $faq->category ?? '') }}"
                                   placeholder="cth: Umum, Pembayaran, Teknis"
                                   list="categoryList">
                            <datalist id="categoryList">
                                <option value="Umum">
                                <option value="Pembayaran">
                                <option value="Kursus">
                                <option value="Akun">
                                <option value="Teknis">
                            </datalist>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Urutan Tampil <span class="text-muted fw-normal">(angka kecil = lebih atas)</span></label>
                            <input type="number" name="order" class="form-control" min="0"
                                   value="{{ old('order', $faq->order ?? 0) }}">
                        </div>
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1"
                               {{ old('is_published', $faq->is_published ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label">Tampilkan di Halaman FAQ Publik</label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="fas fa-save me-2"></i>{{ isset($faq) ? 'Perbarui' : 'Simpan' }} FAQ
                        </button>
                        <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="admin-card card">
            <div class="card-header"><i class="fas fa-info-circle me-2"></i>Tips Menulis FAQ</div>
            <div class="card-body p-3" style="font-size:13px;">
                <ul class="ps-3 mb-0 text-muted">
                    <li class="mb-2">Tulis pertanyaan dari sudut pandang pengguna, misal <em>"Bagaimana cara mendaftar?"</em></li>
                    <li class="mb-2">Jawaban sebaiknya singkat, jelas, dan langsung ke poin utama</li>
                    <li class="mb-2">Gunakan <strong>Kategori</strong> untuk mengelompokkan FAQ sejenis</li>
                    <li>Atur <strong>Urutan</strong> untuk menentukan FAQ mana yang muncul paling atas</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
