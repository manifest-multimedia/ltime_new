<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CmsPageController extends Controller
{
    /**
     * Display a CMS page by its slug
     *
     * @param string $slug
     * @param Request $request
     * @return View
     */
    public function show(string $slug, Request $request): View
    {
        // Check if this is a preview request from the admin panel
        $isPreview = $request->has('preview') && auth()->check() && auth()->user()->can('viewDraft', CmsPage::class);
        
        $query = CmsPage::where('slug', $slug)
            ->with(['sections.contentBlocks']);
            
        // If not a preview request, only show published pages
        if (!$isPreview) {
            $query->where('status', 'published');
        }
        
        $page = $query->firstOrFail();

        return view('cms.page', compact('page'));
    }

    /**
     * Display the homepage (can be a special CMS page)
     *
     * @return View
     */
    public function home(): View
    {
        // First try to find a published home page
        $page = CmsPage::where('slug', 'home')
            ->where('status', 'published')
            ->with(['sections.contentBlocks'])
            ->first();
            
        // If no published home page exists, try to find any home page regardless of status
        if (!$page) {
            $page = CmsPage::where('slug', 'home')
                ->with(['sections.contentBlocks'])
                ->first();
        }

        // If no home page is defined at all, show a default welcome page
        if (!$page) {
            return view('welcome');
        }

        return view('cms.page', compact('page'));
    }
}
