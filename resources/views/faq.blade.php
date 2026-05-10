@extends('layout.mainlayout')
@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-bar" style="background:linear-gradient(135deg,#1BA89C 0%,#0d7a71 100%);padding:40px 0;">
    <div class="container">
        <div class="breadcrumb-list text-center">
            <h2 class="breadcrumb-title text-white mb-2" style="font-weight:700;">FAQ</h2>
            <p class="text-white mb-0" style="opacity:0.85;">Pertanyaan yang sering ditanyakan</p>
        </div>
    </div>
</div>

<section class="page-content" style="padding:60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                @forelse($faqs as $category => $items)
                {{-- Category heading --}}
                <div class="mb-2 mt-{{ $loop->first ? '0' : '5' }}">
                    <h5 class="fw-bold" style="color:#1BA89C;">
                        <i class="fas fa-tag me-2"></i>{{ $category ?: 'Umum' }}
                    </h5>
                    <hr style="border-color:#1BA89C;opacity:0.3;">
                </div>

                {{-- Accordion --}}
                <div class="accordion mb-2" id="faq-{{ $loop->index }}">
                    @foreach($items as $j => $faq)
                    <div class="accordion-item border-0 mb-2" style="border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.06);">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $loop->first && $loop->parent->first ? '' : 'collapsed' }} fw-semibold"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq-item-{{ $loop->parent->index }}-{{ $j }}"
                                    aria-expanded="{{ $loop->first && $loop->parent->first ? 'true' : 'false' }}"
                                    style="border-radius:12px;font-size:15px;">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="faq-item-{{ $loop->parent->index }}-{{ $j }}"
                             class="accordion-collapse collapse {{ $loop->first && $loop->parent->first ? 'show' : '' }}"
                             data-bs-parent="#faq-{{ $loop->parent->index }}">
                            <div class="accordion-body" style="font-size:14px;color:#555;line-height:1.8;">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @empty
                {{-- No FAQs in DB yet --}}
                <div class="text-center py-5">
                    <i class="fas fa-question-circle fa-4x mb-3" style="color:#1BA89C;opacity:0.4;"></i>
                    <h5 class="text-muted">Belum ada FAQ yang ditambahkan</h5>
                    <p class="text-muted">Admin dapat menambahkan FAQ melalui dashboard admin.</p>
                    @auth
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.faqs.create') }}" class="btn btn-sm text-white mt-2"
                       style="background:#1BA89C;border-radius:8px;">
                        <i class="fas fa-plus me-1"></i>Tambah FAQ
                    </a>
                    @endif
                    @endauth
                </div>
                @endforelse

                {{-- CTA: masih punya pertanyaan? --}}
                @if($faqs->isNotEmpty())
                <div class="text-center mt-5 p-4 rounded-3"
                     style="background:linear-gradient(135deg,#e8f8f6,#f0fefa);border:1px solid #b2e8e4;">
                    <h5 class="fw-bold mb-2">Masih punya pertanyaan?</h5>
                    <p class="text-muted mb-3" style="font-size:14px;">Tim kami siap membantu Anda</p>
                    <a href="{{ url('contact-us') }}" class="btn text-white"
                       style="background:linear-gradient(135deg,#1BA89C,#0d7a71);border-radius:10px;padding:10px 28px;">
                        <i class="fas fa-envelope me-2"></i>Hubungi Kami
                    </a>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

<style>
.accordion-button:not(.collapsed) {
    background-color: #e8f8f6;
    color: #1BA89C;
    box-shadow: none;
}
.accordion-button:focus { box-shadow: 0 0 0 2px rgba(27,168,156,0.25); }
.accordion-button::after { filter: hue-rotate(160deg); }
</style>

@endsection
