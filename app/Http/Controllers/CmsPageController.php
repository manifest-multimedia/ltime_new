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
     * @return View
     */
    public function show(string $slug): View
    {
        $page = CmsPage::where('slug', $slug)
            ->where('status', 'published')
            ->with(['sections.contentBlocks'])
            ->firstOrFail();

        return view('cms.page', compact('page'));
    }

    /**
     * Display the homepage (can be a special CMS page)
     *
     * @return View
     */
    public function home(): View
    {
        $page = CmsPage::where('slug', 'home')
            ->where('status', 'published')
            ->with(['sections.contentBlocks'])
            ->first();

        // If no home page is defined, show a default welcome page
        if (!$page) {
            return view('welcome');
        }

        return view('cms.page', compact('page'));
    }
}
