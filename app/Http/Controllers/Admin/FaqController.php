<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->orderBy('id')->paginate(20);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question'     => 'required|string|max:500',
            'answer'       => 'required|string',
            'category'     => 'nullable|string|max:100',
            'order'        => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['order']        = $validated['order'] ?? 0;

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.form', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question'     => 'required|string|max:500',
            'answer'       => 'required|string',
            'category'     => 'nullable|string|max:100',
            'order'        => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['order']        = $validated['order'] ?? 0;

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus!');
    }

    public function show(Faq $faq)
    {
        return redirect()->route('admin.faqs.edit', $faq);
    }
}
