<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('category')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $articles = $query->paginate(15)->appends($request->only(['search', 'status']));
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::where('type', 'blog')->orderBy('name')->get();
        return view('admin.articles.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'content'          => 'required|string',
            'excerpt'          => 'nullable|string|max:500',
            'meta_description' => 'nullable|string|max:160',
            'category_id'      => 'nullable|exists:categories,id',
            'author'           => 'nullable|string|max:255',
            'image'            => 'nullable|image|max:5120',
            'is_published'     => 'boolean',
        ]);

        $validated['slug']         = Str::slug($validated['title']);
        $validated['author']       = $validated['author'] ?? 'Tim Bisolpin';
        $validated['is_published'] = $request->boolean('is_published', false);
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('bisolpin/articles', 'cloudinary');
            /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
            $disk = \Illuminate\Support\Facades\Storage::disk('cloudinary');
            $validated['image_url'] = $disk->url($path);
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(Article $article)
    {
        $categories = Category::where('type', 'blog')->orderBy('name')->get();
        return view('admin.articles.form', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'content'          => 'required|string',
            'excerpt'          => 'nullable|string|max:500',
            'meta_description' => 'nullable|string|max:160',
            'category_id'      => 'nullable|exists:categories,id',
            'author'           => 'nullable|string|max:255',
            'image'            => 'nullable|image|max:5120',
            'is_published'     => 'boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published', false);
        if ($validated['is_published'] && !$article->published_at) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('bisolpin/articles', 'cloudinary');
            /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
            $disk = \Illuminate\Support\Facades\Storage::disk('cloudinary');
            $validated['image_url'] = $disk->url($path);
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
    }

    public function show(Article $article)
    {
        return redirect()->route('admin.articles.edit', $article);
    }
}
