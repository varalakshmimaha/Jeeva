@extends('layouts.admin')

@section('admin-content')
<div>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="color: #0a1628; margin: 0; margin-top: 0; font-family: 'Playfair Display';">Blogs</h1>
        <a href="{{ route('admin.blogs.create') }}" style="background: #18b4d4; color: white; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-weight: 500;">+ Add Blog</a>
    </div>
    
    @if(session('success'))
        <div style="background: #c8e6c9; color: #2e7d32; padding: 15px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #2e7d32;">
            {{ session('success') }}
        </div>
    @endif
    
    @if($blogs->isEmpty())
        <div style="background: #f5f8fc; padding: 40px; border-radius: 10px; text-align: center; color: #666;">
            <p style="font-size: 16px;">No blogs found. <a href="{{ route('admin.blogs.create') }}" style="color: #18b4d4; text-decoration: underline;">Create one now.</a></p>
        </div>
    @else
        <div style="overflow-x: auto; background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f5f8fc; border-bottom: 2px solid #e0e0e0;">
                        <th style="padding: 15px; text-align: left; color: #0a1628; font-weight: 600;">Title</th>
                        <th style="padding: 15px; text-align: left; color: #0a1628; font-weight: 600;">Category</th>
                        <th style="padding: 15px; text-align: left; color: #0a1628; font-weight: 600;">Slug</th>
                        <th style="padding: 15px; text-align: center; color: #0a1628; font-weight: 600;">Status</th>
                        <th style="padding: 15px; text-align: center; color: #0a1628; font-weight: 600;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                        <tr style="border-bottom: 1px solid #e0e0e0;">
                            <td style="padding: 15px; color: #0a1628;">{{ $blog->title }}</td>
                            <td style="padding: 15px; color: #666; font-size: 14px;">{{ $blog->category }}</td>
                            <td style="padding: 15px; color: #666; font-size: 13px;">{{ $blog->slug }}</td>
                            <td style="padding: 15px; text-align: center;">
                                @if($blog->published)
                                    <span style="background: #c8e6c9; color: #2e7d32; padding: 4px 10px; border-radius: 3px; font-size: 12px;">Published</span>
                                @else
                                    <span style="background: #ffe0b2; color: #e65100; padding: 4px 10px; border-radius: 3px; font-size: 12px;">Draft</span>
                                @endif
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" style="background: #4a90e2; color: white; padding: 8px 12px; border-radius: 3px; text-decoration: none; font-size: 12px; margin-right: 5px;">Edit</a>
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: #e74c3c; color: white; padding: 8px 12px; border-radius: 3px; border: none; cursor: pointer; font-size: 12px;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
