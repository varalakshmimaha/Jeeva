@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <div>
            <h1 class="adm-page-title">Blog Posts</h1>
            <p class="adm-page-sub">Manage articles, wellness tips, and updates.</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="adm-btn adm-btn-primary">+ Write New Article</a>
    </div>

    @if(session('success'))
        <div class="adm-alert adm-alert-ok">{{ session('success') }}</div>
    @endif

    @if($blogs->isEmpty())
        <div class="adm-empty">
            <div class="adm-empty-icon">
                <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </div>
            <h3>No articles published</h3>
            <p>Start sharing wellness resources with your clients.</p>
            <a href="{{ route('admin.blogs.create') }}" class="adm-btn adm-btn-primary">Write Your First Blog</a>
        </div>
    @else
        <div class="adm-card">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Article Title</th>
                        <th>Category</th>
                        <th class="col-center">Status</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                        <td>
                            <div style="font-weight:700;">{{ Str::limit($blog->title, 65) }}</div>
                            <div style="font-size:12px;color:var(--muted);margin-top:2px;">/blog/{{ $blog->slug }}</div>
                        </td>
                        <td><span class="adm-badge adm-badge-blue">{{ $blog->category }}</span></td>
                        <td class="col-center">
                            @if($blog->published)
                                <span class="adm-badge adm-badge-green">Published</span>
                            @else
                                <span class="adm-badge adm-badge-amber">Draft</span>
                            @endif
                        </td>
                        <td class="col-actions">
                            <div class="adm-actions">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="adm-btn adm-btn-dark adm-btn-sm">Edit</a>
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Delete this article?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
