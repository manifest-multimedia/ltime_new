<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsContentBlock;
use App\Models\CmsSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CmsContentBlockAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $sectionId): RedirectResponse
    {
        $section = CmsSection::findOrFail($sectionId);
        return redirect()->route('admin.sections.edit', $section);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $sectionId): View
    {
        $section = CmsSection::with('page')->findOrFail($sectionId);
        $blockTypes = [
            'text' => 'Text Block',
            'image' => 'Image Block',
            'cta' => 'Call to Action',
            'quote' => 'Quote/Testimonial',
            'video' => 'Video',
            'phone' => 'Phone Number',
            'email' => 'Email Address',
        ];
        
        return view('admin.cms.content-blocks.create', compact('section', 'blockTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $sectionId): RedirectResponse
    {
        $section = CmsSection::findOrFail($sectionId);
        
        $validated = $request->validate([
            'type' => 'required|string|max:50',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'link_text' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'settings' => 'nullable|json',
        ]);
        
        // Handle file upload if present
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cms/images', 'public');
            $validated['image'] = $path;
        }
        
        // Set the sort order for the new block
        $lastSortOrder = $section->contentBlocks()->max('sort_order') ?? 0;
        $validated['sort_order'] = $lastSortOrder + 10;
        
        $contentBlock = $section->contentBlocks()->create($validated);
        
        return redirect()->route('admin.sections.edit', $section)
            ->with('success', 'Content block created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $contentBlock = CmsContentBlock::with(['section.page'])->findOrFail($id);
        
        $blockTypes = [
            'text' => 'Text Block',
            'image' => 'Image Block',
            'cta' => 'Call to Action',
            'quote' => 'Quote/Testimonial',
            'video' => 'Video',
            'phone' => 'Phone Number',
            'email' => 'Email Address',
        ];
        
        return view('admin.cms.content-blocks.edit', compact('contentBlock', 'blockTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $contentBlock = CmsContentBlock::findOrFail($id);
        
        $validated = $request->validate([
            'type' => 'required|string|max:50',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'link_text' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'settings' => 'nullable|json',
        ]);
        
        // Handle file upload if present
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($contentBlock->image) {
                Storage::disk('public')->delete($contentBlock->image);
            }
            
            $path = $request->file('image')->store('cms/images', 'public');
            $validated['image'] = $path;
        }
        
        $contentBlock->update($validated);
        
        return redirect()->route('admin.sections.edit', $contentBlock->section)
            ->with('success', 'Content block updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $contentBlock = CmsContentBlock::findOrFail($id);
        $section = $contentBlock->section;
        
        // Delete associated image if it exists
        if ($contentBlock->image) {
            Storage::disk('public')->delete($contentBlock->image);
        }
        
        $contentBlock->delete();
        
        return redirect()->route('admin.sections.edit', $section)
            ->with('success', 'Content block deleted successfully.');
    }
    
    /**
     * Reorder content blocks within a section.
     */
    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'blocks' => 'required|array',
            'blocks.*.id' => 'required|integer|exists:cms_content_blocks,id',
            'blocks.*.order' => 'required|integer|min:0',
        ]);
        
        foreach ($validated['blocks'] as $item) {
            CmsContentBlock::where('id', $item['id'])->update(['sort_order' => $item['order']]);
        }
        
        return response()->json(['success' => true]);
    }
}
