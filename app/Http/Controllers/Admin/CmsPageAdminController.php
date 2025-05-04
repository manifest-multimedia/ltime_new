<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;

class CmsPageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = CmsPage::orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.cms.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cms.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:cms_pages,slug|max:255',
            'meta_description' => 'nullable',
            'content' => 'nullable',
            'status' => 'required|in:draft,published,archived',
            'layout' => 'required',
        ]);

        $page = CmsPage::create($validated);

        return redirect()->route('cms-pages.index')
            ->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        return redirect()->route('page.show', $cmsPage->slug);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CmsPage $cmsPage)
    {
        return view('admin.cms.pages.edit', compact('cmsPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CmsPage $cmsPage)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:cms_pages,slug,' . $cmsPage->id,
            'meta_description' => 'nullable',
            'content' => 'nullable',
            'status' => 'required|in:draft,published,archived',
            'layout' => 'required',
        ]);

        $cmsPage->update($validated);

        return redirect()->route('cms-pages.index')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CmsPage $cmsPage)
    {
        $cmsPage->delete();

        return redirect()->route('cms-pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}
