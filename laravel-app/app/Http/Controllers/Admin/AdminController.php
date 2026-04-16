<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\GalleryItem;
use App\Models\Testimonial;
use App\Models\ContactMessage;
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
            'testimonials' => Testimonial::count(),
            'messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
        ];
        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentServices = Service::latest()->take(5)->get();
        return view('admin.dashboard', array_merge($stats, ['recentMessages' => $recentMessages, 'recentServices' => $recentServices]));
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
        $banners = Banner::orderBy('order')->get();
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
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/banners'), $filename);
            $validated['image'] = 'images/banners/' . $filename;
        } else {
            unset($validated['image']);
        }

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
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/banners'), $filename);
            $validated['image'] = 'images/banners/' . $filename;
        } else {
            unset($validated['image']);
        }

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'slug' => 'required|string|unique:blogs',
            'published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/blogs'), $filename);
            $validated['image'] = 'images/blogs/' . $filename;
        } else {
            unset($validated['image']);
        }

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'slug' => 'required|string|unique:blogs,slug,' . $id,
            'published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/blogs'), $filename);
            $validated['image'] = 'images/blogs/' . $filename;
        } else {
            unset($validated['image']);
        }

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
        return view('admin.gallery.create');
    }

    public function galleryStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/gallery'), $filename);
            $validated['image'] = 'images/gallery/' . $filename;
        }

        GalleryItem::create($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item created successfully!');
    }

    public function galleryEdit($id)
    {
        $item = GalleryItem::findOrFail($id);
        return view('admin.gallery.edit', compact('item'));
    }

    public function galleryUpdate(Request $request, $id)
    {
        $item = GalleryItem::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/gallery'), $filename);
            $validated['image'] = 'images/gallery/' . $filename;
        } else {
            unset($validated['image']);
        }

        $item->update($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully!');
    }

    public function galleryDestroy($id)
    {
        GalleryItem::findOrFail($id)->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully!');
    }

    // === TESTIMONIALS ===
    public function testimonialsIndex()
    {
        $testimonials = Testimonial::orderBy('order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function testimonialsCreate()
    {
        return view('admin.testimonials.create');
    }

    public function testimonialsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/testimonials'), $filename);
            $validated['image'] = 'images/testimonials/' . $filename;
        } else {
            unset($validated['image']);
        }

        $validated['published'] = $request->has('published');
        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully!');
    }

    public function testimonialsEdit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function testimonialsUpdate(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/testimonials'), $filename);
            $validated['image'] = 'images/testimonials/' . $filename;
        } else {
            unset($validated['image']);
        }

        $validated['published'] = $request->has('published');
        $testimonial->update($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function testimonialsDestroy($id)
    {
        Testimonial::findOrFail($id)->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }

    // === CONTACT MESSAGES ===
    public function messagesIndex()
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function messagesShow($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);
        return view('admin.messages.show', compact('message'));
    }

    public function messagesDestroy($id)
    {
        ContactMessage::findOrFail($id)->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted.');
    }
}
