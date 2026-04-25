@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <h1 class="adm-page-title">Edit Service</h1>
        <a href="{{ route('admin.services.index') }}" class="adm-back">&larr; Back to Services</a>
    </div>

    @if($errors->any())
        <div class="adm-alert adm-alert-err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
        </div>
    @endif

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="adm-card">
            <div class="adm-card-head">Service Details</div>
            <div class="adm-card-body">
                <table class="adm-form-table">
                    <tr>
                        <td class="adm-fl">Title *</td>
                        <td class="adm-fi">
                            <input type="text" name="title" value="{{ old('title', $service->title) }}" required class="adm-input">
                        </td>
                    </tr>
                    <tr>
                        <td class="adm-fl">Subtitle</td>
                        <td class="adm-fi">
                            <input type="text" name="subtitle" value="{{ old('subtitle', $service->subtitle) }}" class="adm-input">
                        </td>
                    </tr>
                    <tr>
                        <td class="adm-fl">Description *</td>
                        <td class="adm-fi">
                            <textarea name="description" required rows="4" class="adm-input">{{ old('description', $service->description) }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="adm-fl">Detailed Content</td>
                        <td class="adm-fi">
                            <textarea name="content" rows="8" class="adm-input" placeholder="Full detailed content for the service detail page">{{ old('content', $service->content) }}</textarea>
                            <p class="adm-hint">Shown on the individual service detail page</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="adm-fl">Benefits</td>
                        <td class="adm-fi">
                            <textarea name="benefits" rows="6" class="adm-input" placeholder="One benefit per line, e.g.&#10;Personalised care plan&#10;24/7 support during labour&#10;Postnatal check-in">{{ old('benefits', $service->benefits) }}</textarea>
                            <p class="adm-hint">Enter <strong>one benefit per line</strong>. Each line renders as a bullet on the service page.</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="adm-fl">Image</td>
                        <td class="adm-fi">
                            @if($service->icon)
                                <div style="margin-bottom:10px;">
                                    <img src="{{ asset($service->icon) }}" alt="Current image" style="max-height:100px;border-radius:8px;border:1px solid #e5e7eb;">
                                    <p class="adm-hint" style="margin-top:4px;">Current image — upload a new one to replace it</p>
                                </div>
                            @endif
                            <input type="file" name="icon" accept="image/jpeg,image/png,image/webp" class="adm-input">
                            <p class="adm-hint">Leave empty to keep current image. JPG, PNG or WebP. Recommended: <strong>800×600 px</strong> (4:3 ratio) for service cards. Max 2MB.</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="adm-fl">Display Order</td>
                        <td class="adm-fi">
                            <input type="number" name="order" value="{{ old('order', $service->order) }}" class="adm-input">
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="adm-card">
            <div class="adm-card-head" style="display:flex;justify-content:space-between;align-items:center;">
                <span>Packages</span>
                <button type="button" class="adm-btn adm-btn-primary adm-btn-sm" onclick="addPackageRow()">+ Add Package</button>
            </div>
            <div class="adm-card-body">
                <p class="adm-hint" style="margin-top:0;">Optional. Add one or more pricing packages that appear on the service detail page. Each package needs a title and a list of what it includes (one item per line).</p>
                <div id="pkgList">
                    @php
                        $existingPackages = old('packages', $service->packages ?? []);
                        if (!is_array($existingPackages)) { $existingPackages = []; }
                    @endphp
                    @foreach($existingPackages as $i => $pkg)
                        @php
                            $pkgIncludes = $pkg['includes'] ?? '';
                            if (is_array($pkgIncludes)) { $pkgIncludes = implode("\n", $pkgIncludes); }
                        @endphp
                        <div class="pkg-row" data-pkg-row>
                            <div class="pkg-row-head">
                                <span class="pkg-row-label">Package #{{ $i + 1 }}</span>
                                <button type="button" class="pkg-row-remove" onclick="this.closest('[data-pkg-row]').remove()">Remove</button>
                            </div>
                            <div class="pkg-row-grid">
                                <label class="pkg-row-field">
                                    <span>Title</span>
                                    <input type="text" name="packages[{{ $i }}][title]" value="{{ $pkg['title'] ?? '' }}" class="adm-input" placeholder="e.g. Complete Doula Package">
                                </label>
                                <label class="pkg-row-field">
                                    <span>Price</span>
                                    <input type="text" name="packages[{{ $i }}][price]" value="{{ $pkg['price'] ?? '' }}" class="adm-input" placeholder="e.g. $1850 or ₹25,000">
                                </label>
                            </div>
                            <label class="pkg-row-field pkg-row-field--full">
                                <span>Includes (one item per line)</span>
                                <textarea name="packages[{{ $i }}][includes]" rows="5" class="adm-input" placeholder="2 Prenatal Meetings&#10;24/7 on-call support from week 37&#10;Postnatal follow-up">{{ $pkgIncludes }}</textarea>
                            </label>
                            <label class="pkg-row-featured">
                                <input type="checkbox" name="packages[{{ $i }}][featured]" value="1" {{ !empty($pkg['featured']) ? 'checked' : '' }}>
                                <span>Mark as <strong>Most Popular</strong> (shows a highlighted badge on the service page)</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="adm-form-actions">
            <button type="submit" class="adm-btn adm-btn-primary">Update Service</button>
            <a href="{{ route('admin.services.index') }}" class="adm-btn adm-btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<template id="pkgTemplate">
  <div class="pkg-row" data-pkg-row>
    <div class="pkg-row-head">
      <span class="pkg-row-label">New Package</span>
      <button type="button" class="pkg-row-remove" onclick="this.closest('[data-pkg-row]').remove()">Remove</button>
    </div>
    <div class="pkg-row-grid">
      <label class="pkg-row-field">
        <span>Title</span>
        <input type="text" name="packages[__INDEX__][title]" class="adm-input" placeholder="e.g. Complete Doula Package">
      </label>
      <label class="pkg-row-field">
        <span>Price</span>
        <input type="text" name="packages[__INDEX__][price]" class="adm-input" placeholder="e.g. $1850 or ₹25,000">
      </label>
    </div>
    <label class="pkg-row-field pkg-row-field--full">
      <span>Includes (one item per line)</span>
      <textarea name="packages[__INDEX__][includes]" rows="5" class="adm-input" placeholder="One inclusion per line"></textarea>
    </label>
    <label class="pkg-row-featured">
      <input type="checkbox" name="packages[__INDEX__][featured]" value="1">
      <span>Mark as <strong>Most Popular</strong> (shows a highlighted badge on the service page)</span>
    </label>
  </div>
</template>

<style>
.pkg-row {
    background: #fbf7f4;
    border: 1px solid #e7dcd4;
    border-radius: 12px;
    padding: 16px 18px;
    margin-bottom: 14px;
}
.pkg-row-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}
.pkg-row-label { font-weight: 600; color: #1f3b38; }
.pkg-row-remove {
    background: #fdecec;
    color: #a22d2d;
    border: 1px solid #f3c6c6;
    border-radius: 8px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
}
.pkg-row-remove:hover { background: #f7d7d7; }
.pkg-row-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px; }
.pkg-row-field { display: flex; flex-direction: column; gap: 6px; }
.pkg-row-field--full { grid-column: 1 / -1; }
.pkg-row-field > span { font-size: 12px; font-weight: 600; color: #3d2b2b; letter-spacing: .2px; }
.pkg-row-featured {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
    padding: 10px 14px;
    background: #fff8ec;
    border: 1px dashed #f0c060;
    border-radius: 8px;
    cursor: pointer;
    font-size: 13px;
    color: #5a3e00;
}
.pkg-row-featured input[type="checkbox"] { width: 16px; height: 16px; accent-color: #e6a800; flex-shrink: 0; cursor: pointer; }
</style>

<script>
function addPackageRow() {
    var list = document.getElementById('pkgList');
    var tpl = document.getElementById('pkgTemplate');
    var nextIndex = list.querySelectorAll('[data-pkg-row]').length;
    var html = tpl.innerHTML.replace(/__INDEX__/g, nextIndex);
    var wrap = document.createElement('div');
    wrap.innerHTML = html.trim();
    list.appendChild(wrap.firstElementChild);
}
</script>
@endsection
