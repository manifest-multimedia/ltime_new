<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\CmsSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CmsSectionAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $pageId): RedirectResponse
    {
        $page = CmsPage::findOrFail($pageId);
        return redirect()->route('cms-pages.edit', $page);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $pageId): View
    {
        $page = CmsPage::findOrFail($pageId);
        $sectionTypes = [
            'standard' => 'Standard Section',
            'hero' => 'Hero Banner',
            'features' => 'Features Grid',
            'testimonials' => 'Testimonials',
            'contact' => 'Contact Form'
        ];
        
        return view('admin.cms.sections.create', compact('page', 'sectionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $pageId): RedirectResponse
    {
        $page = CmsPage::findOrFail($pageId);
        
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'background_color' => 'nullable|string|max:50',
            'text_color' => 'nullable|string|max:50',
            'settings' => 'nullable|json',
        ]);
        
        // Determine the sort order for the new section
        $lastSortOrder = $page->sections()->max('sort_order') ?? 0;
        $validated['sort_order'] = $lastSortOrder + 10;
        
        $section = $page->sections()->create($validated);
        
        return redirect()->route('sections.edit', $section)
            ->with('success', 'Section created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $section = CmsSection::with(['page', 'contentBlocks' => function($query) {
            $query->orderBy('sort_order');
        }])->findOrFail($id);
        
        $sectionTypes = [
            'standard' => 'Standard Section',
            'hero' => 'Hero Banner',
            'features' => 'Features Grid',
            'testimonials' => 'Testimonials',
            'contact' => 'Contact Form'
        ];
        
        return view('admin.cms.sections.edit', compact('section', 'sectionTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $section = CmsSection::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'background_color' => 'nullable|string|max:50',
            'text_color' => 'nullable|string|max:50',
            'settings' => 'nullable|json',
        ]);
        
        $section->update($validated);
        
        return redirect()->route('sections.edit', $section)
            ->with('success', 'Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $section = CmsSection::findOrFail($id);
        $pageId = $section->cms_page_id;
        
        $section->delete();
        
        return redirect()->route('cms-pages.edit', $pageId)
            ->with('success', 'Section deleted successfully.');
    }
    
    /**
     * Reorder sections within a page.
     */
    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'sections' => 'required|array',
            'sections.*.id' => 'required|integer|exists:cms_sections,id',
            'sections.*.order' => 'required|integer|min:0',
        ]);
        
        foreach ($validated['sections'] as $item) {
            CmsSection::where('id', $item['id'])->update(['sort_order' => $item['order']]);
        }
        
        return response()->json(['success' => true]);
    }
}
