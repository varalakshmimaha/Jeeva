<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Faq;
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
            'benefits' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'order' => 'nullable|integer',
            'packages' => 'nullable|array',
            'packages.*.title' => 'nullable|string|max:255',
            'packages.*.price' => 'nullable|string|max:50',
            'packages.*.includes' => 'nullable|string',
        ]);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/services'), $filename);
            $validated['icon'] = 'images/services/' . $filename;
        } else {
            unset($validated['icon']);
        }

        $validated['packages'] = $this->cleanPackages($validated['packages'] ?? []);

        Service::create($validated);
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully!');
    }

    private function cleanPackages(array $packages): array
    {
        return array_values(array_filter(array_map(function ($pkg) {
            $title = trim($pkg['title'] ?? '');
            $price = trim($pkg['price'] ?? '');
            $includesRaw = trim($pkg['includes'] ?? '');
            if ($title === '' && $price === '' && $includesRaw === '') {
                return null;
            }
            $includes = array_values(array_filter(array_map('trim', preg_split('/\r?\n/', $includesRaw))));
            return [
                'title'    => $title,
                'price'    => $price,
                'includes' => $includes,
                'featured' => !empty($pkg['featured']),
            ];
        }, $packages)));
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
            'benefits' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'order' => 'nullable|integer',
            'packages' => 'nullable|array',
            'packages.*.title' => 'nullable|string|max:255',
            'packages.*.price' => 'nullable|string|max:50',
            'packages.*.includes' => 'nullable|string',
        ]);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/services'), $filename);
            $validated['icon'] = 'images/services/' . $filename;
        } else {
            unset($validated['icon']);
        }

        $validated['packages'] = $this->cleanPackages($validated['packages'] ?? []);

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
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
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
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
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
            'category' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $base = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safe = \Illuminate\Support\Str::slug($base);
            if (!$safe) { $safe = 'image'; }
            $filename = time() . '_' . $safe . '.' . $ext;
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
            'category' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                $oldPath = public_path($testimonial->image);
                if (is_file($oldPath)) { @unlink($oldPath); }
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $base = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safe = \Illuminate\Support\Str::slug($base);
            if (!$safe) { $safe = 'image'; }
            $filename = time() . '_' . $safe . '.' . $ext;
            $file->move(public_path('images/testimonials'), $filename);
            $validated['image'] = 'images/testimonials/' . $filename;
        } elseif ($request->input('remove_image')) {
            if ($testimonial->image) {
                $oldPath = public_path($testimonial->image);
                if (is_file($oldPath)) { @unlink($oldPath); }
            }
            $validated['image'] = null;
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

    public function messagesUpdateStatus(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);
        $validated = $request->validate([
            'consultation_status' => 'required|in:pending,consulted,no_response',
        ]);
        $message->update($validated);
        return redirect()->route('admin.messages.show', $id)->with('success', 'Status updated successfully!');
    }

    // === FAQs ===
    public function faqsIndex()
    {
        $faqs = Faq::orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function faqsCreate()
    {
        return view('admin.faqs.create');
    }

    public function faqsStore(Request $request)
    {
        $validated = $request->validate([
            'question'  => 'required|string|max:500',
            'answer'    => 'required|string',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        Faq::create($validated);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully!');
    }

    public function faqsEdit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    public function faqsUpdate(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $validated = $request->validate([
            'question'  => 'required|string|max:500',
            'answer'    => 'required|string',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $faq->update($validated);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully!');
    }

    public function faqsDestroy($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted.');
    }
}
