@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <h1 class="adm-page-title">Edit FAQ</h1>
        <a href="{{ route('admin.faqs.index') }}" class="adm-back">&larr; Back to FAQs</a>
    </div>

    @if($errors->any())
        <div class="adm-alert adm-alert-err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
        </div>
    @endif

    <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="adm-card">
            <div class="adm-card-head">FAQ Details</div>
            <div class="adm-card-body">
                <div class="adm-form-group">
                    <label class="adm-label">Question *</label>
                    <input type="text" name="question" value="{{ old('question', $faq->question) }}" required class="adm-input" placeholder="e.g., What is a birth doula?">
                </div>
                <div class="adm-form-group" style="margin-top:16px;">
                    <label class="adm-label">Answer *</label>
                    <textarea name="answer" rows="5" required class="adm-input" placeholder="Write the answer here...">{{ old('answer', $faq->answer) }}</textarea>
                </div>
                <div class="adm-form-grid" style="margin-top:16px;">
                    <div class="adm-form-group">
                        <label class="adm-label">Sort Order</label>
                        <input type="number" name="order" value="{{ old('order', $faq->order) }}" class="adm-input">
                        <p class="adm-hint">Lower numbers appear first.</p>
                    </div>
                    <div class="adm-form-group">
                        <label class="adm-label">Visibility</label>
                        <label class="adm-check" style="margin-top:8px;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                            <span>Show on home page</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="adm-form-actions">
            <button type="submit" class="adm-btn adm-btn-primary">Update FAQ</button>
            <a href="{{ route('admin.faqs.index') }}" class="adm-btn adm-btn-cancel">Cancel</a>
        </div>
    </form>

    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this FAQ?')">
        @csrf @method('DELETE')
        <button type="submit" class="adm-btn adm-btn-danger" style="margin-top:8px;">Delete</button>
    </form>
</div>
@endsection
