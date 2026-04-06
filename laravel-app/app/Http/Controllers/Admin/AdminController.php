<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $stats = [
            'services' => Service::count(),
            'banners' => Banner::count(),
            'blogs' => Blog::count(),
            'gallery' => GalleryItem::count(),
        ];
        return view('admin.dashboard', $stats);
    }

    // === SERVICES ===
    public function servicesIndex()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function servicesCreate()
    {
        return view('admin.services.create');
    }

    public function servicesStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        Service::create($validated);
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully!');
    }

    public function servicesEdit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function servicesUpdate(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $service->update($validated);
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully!');
    }

    public function servicesDestroy($id)
    {
        Service::findOrFail($id)->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully!');
    }

    // === BANNERS ===
    public function bannersIndex()
    {
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));
    }

    public function bannersCreate()
    {
        return view('admin.banners.create');
    }

    public function bannersStore(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'breadcrumb' => 'nullable|string|max:255',
        ]);

        Banner::create($validated);
        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully!');
    }

    public function bannersEdit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function bannersUpdate(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $validated = $request->validate([
            'page' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'breadcrumb' => 'nullable|string|max:255',
        ]);

        $banner->update($validated);
        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully!');
    }

    public function bannersDestroy($id)
    {
        Banner::findOrFail($id)->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully!');
    }

    // === BLOGS ===
    public function blogsIndex()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function blogsCreate()
    {
        return view('admin.blogs.create');
    }

    public function blogsStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:10',
            'slug' => 'required|string|unique:blogs',
            'published' => 'boolean',
        ]);

        Blog::create($validated);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    public function blogsEdit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function blogsUpdate(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:10',
            'slug' => 'required|string|unique:blogs,slug,' . $id,
            'published' => 'boolean',
        ]);

        $blog->update($validated);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function blogsDestroy($id)
    {
        Blog::findOrFail($id)->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }

    // === GALLERY ===
    public function galleryIndex()
    {
        $items = GalleryItem::orderBy('order')->get();
        return view('admin.gallery.index', compact('items'));
    }

    public function galleryCreate()
    {
        $colors = ['gc1', 'gc2', 'gc3', 'gc4', 'gc5', 'gc6', 'gc7', 'gc8', 'gc9'];
        return view('admin.gallery.create', compact('colors'));
    }

    public function galleryStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'color_class' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        GalleryItem::create($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item created successfully!');
    }

    public function galleryEdit($id)
    {
        $item = GalleryItem::findOrFail($id);
        $colors = ['gc1', 'gc2', 'gc3', 'gc4', 'gc5', 'gc6', 'gc7', 'gc8', 'gc9'];
        return view('admin.gallery.edit', compact('item', 'colors'));
    }

    public function galleryUpdate(Request $request, $id)
    {
        $item = GalleryItem::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'color_class' => 'required|string|in:gc1,gc2,gc3,gc4,gc5,gc6,gc7,gc8,gc9',
            'order' => 'nullable|integer',
        ]);

        $item->update($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully!');
    }

    public function galleryDestroy($id)
    {
        GalleryItem::findOrFail($id)->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully!');
    }
}
