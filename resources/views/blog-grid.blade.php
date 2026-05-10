@extends('layout.mainlayout')
@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-bar" style="background:linear-gradient(135deg,#1BA89C 0%,#0d7a71 100%);padding:40px 0;">
    <div class="container">
        <div class="breadcrumb-list text-center">
            <h2 class="breadcrumb-title text-white mb-2" style="font-weight:700;">Blog</h2>
            <p class="text-white mb-0" style="opacity:0.85;">Artikel terbaru seputar pendidikan & teknologi</p>
        </div>
    </div>
</div>

<section class="page-content" style="padding:60px 0;">
    <div class="container">
        <div class="row">
            {{-- Articles Grid --}}
            <div class="col-lg-9">
                @if($articles->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-4x mb-3" style="color:#1BA89C;opacity:0.4;"></i>
                    <h5 class="text-muted">Belum ada artikel yang diterbitkan</h5>
                    <p class="text-muted">Admin dapat menambahkan artikel melalui dashboard.</p>
                    @auth
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.articles.create') }}" class="btn btn-sm text-white mt-2"
                       style="background:#1BA89C;border-radius:8px;">
                        <i class="fas fa-plus me-1"></i>Tulis Artikel
                    </a>
                    @endif
                    @endauth
                </div>
                @else
                <div class="row g-4">
                    @foreach($articles as $article)
                    <div class="col-md-6 col-xl-4">
                        <div class="card h-100 border-0 shadow-sm" style="border-radius:14px;overflow:hidden;transition:transform 0.2s;">
                            {{-- Thumbnail --}}
                            <div style="height:180px;overflow:hidden;background:#f0fafa;">
                                @if($article->image_url)
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                     class="w-100 h-100" style="object-fit:cover;">
                                @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                     style="background:linear-gradient(135deg,#e8f8f6,#d0f0ec);">
                                    <i class="fas fa-newspaper fa-3x" style="color:#1BA89C;opacity:0.4;"></i>
                                </div>
                                @endif
                            </div>

                            <div class="card-body p-3">
                                {{-- Category badge --}}
                                @if($article->category)
                                <span class="badge mb-2" style="background:#e8f8f6;color:#1BA89C;font-size:11px;border-radius:20px;padding:3px 10px;">
                                    {{ $article->category->name }}
                                </span>
                                @endif

                                {{-- Title --}}
                                <h6 class="fw-bold mb-2" style="font-size:15px;line-height:1.4;">
                                    {{ $article->title }}
                                </h6>

                                {{-- Excerpt --}}
                                @if($article->excerpt)
                                <p class="text-muted mb-2" style="font-size:13px;line-height:1.6;">
                                    {{ Str::limit($article->excerpt, 100) }}
                                </p>
                                @endif

                                {{-- Meta --}}
                                <div class="d-flex align-items-center justify-content-between mt-2" style="font-size:12px;color:#888;">
                                    <span><i class="fas fa-user me-1"></i>{{ $article->author ?? 'Tim Bisolpin' }}</span>
                                    <span><i class="fas fa-calendar me-1"></i>{{ $article->published_at?->format('d M Y') ?? $article->created_at->format('d M Y') }}</span>
                                </div>
                            </div>

                            {{-- Read more link --}}
                            <div class="card-footer bg-white border-0 px-3 pb-3">
                                <a href="{{ url('blog-details') }}" class="btn btn-sm w-100 text-white"
                                   style="background:#1BA89C;border-radius:8px;font-weight:600;">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($articles->hasPages())
                <div class="mt-5">{{ $articles->links() }}</div>
                @endif
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-3">
                {{-- Categories --}}
                @if($categories->isNotEmpty())
                <div class="card border-0 shadow-sm mb-4" style="border-radius:14px;">
                    <div class="card-body p-3">
                        <h6 class="fw-bold mb-3" style="color:#1BA89C;">
                            <i class="fas fa-tags me-2"></i>Kategori
                        </h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <a href="{{ url('blog-grid') }}" class="d-flex justify-content-between align-items-center text-decoration-none"
                                   style="font-size:13px;color:#555;">
                                    <span><i class="fas fa-folder me-2" style="color:#1BA89C;"></i>Semua</span>
                                    <span class="badge" style="background:#e8f8f6;color:#1BA89C;">{{ $articles->total() }}</span>
                                </a>
                            </li>
                            @foreach($categories as $cat)
                            <li class="mb-2">
                                <a href="{{ url('blog-grid') }}?category={{ $cat->id }}" class="d-flex justify-content-between align-items-center text-decoration-none"
                                   style="font-size:13px;color:#555;">
                                    <span><i class="fas fa-folder me-2" style="color:#1BA89C;"></i>{{ $cat->name }}</span>
                                    <span class="badge" style="background:#e8f8f6;color:#1BA89C;">{{ $cat->courses_count }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                {{-- Latest articles --}}
                @if($articles->isNotEmpty())
                <div class="card border-0 shadow-sm" style="border-radius:14px;">
                    <div class="card-body p-3">
                        <h6 class="fw-bold mb-3" style="color:#1BA89C;">
                            <i class="fas fa-clock me-2"></i>Artikel Terbaru
                        </h6>
                        @foreach($articles->take(3) as $art)
                        <div class="d-flex gap-2 mb-3">
                            <div style="width:50px;height:50px;flex-shrink:0;border-radius:8px;overflow:hidden;background:#e8f8f6;">
                                @if($art->image_url)
                                <img src="{{ $art->image_url }}" class="w-100 h-100" style="object-fit:cover;">
                                @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-newspaper" style="color:#1BA89C;font-size:18px;"></i>
                                </div>
                                @endif
                            </div>
                            <div>
                                <div class="fw-semibold" style="font-size:12px;line-height:1.4;">{{ Str::limit($art->title, 50) }}</div>
                                <div class="text-muted" style="font-size:11px;">{{ $art->published_at?->format('d M Y') }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<style>
.col-md-6 .card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important; }
</style>

@endsection
