@extends('layouts.admin')

@section('admin-content')
<div>
    <div class="adm-page-header">
        <h1 class="adm-page-title">Add New Service</h1>
        <a href="{{ route('admin.services.index') }}" class="adm-back">&larr; Back to Services</a>
    </div>

    @if($errors->any())
        <div class="adm-alert adm-alert-err">
            @foreach($errors->all() as $error){{ $error }}<br>@endforeach
        </div>
    @endif

    <form action="{{ route('admin.services.store') }}" method="POST">
        @csrf

        <div class="adm-card">
            <div class="adm-card-head">Service Details</div>
            <div class="adm-card-body">
                <table class="adm-form-table">
                    <tr>
                        <td class="adm-fl">Title *</td>
                        <td class="adm-fi">
                            <input type="text" name="title" value="{{ old('title') }}" required class="adm-input" placeholder="e.g., Birth Doula Support">
                        </td>
                    </tr>
                    <tr>
                        <td class="adm-fl">Subtitle</td>
                        <td class="adm-fi">
                            <input type="text" name="subtitle" value="{{ old('subtitle') }}" class="adm-input" placeholder="e.g., Prenatal Care">
                        </td>
                    </tr>
                    <tr>
                        <td class="adm-fl">Description *</td>
                        <td class="adm-fi">
                            <textarea name="description" required rows="4" class="adm-input" placeholder="Short description for the services listing page">{{ old('description') }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="adm-fl">Detailed Content</td>
                        <td class="adm-fi">
                            <textarea name="content" rows="8" class="adm-input" placeholder="Full detailed content shown on the service detail page. Use separate paragraphs for readability.">{{ old('content') }}</textarea>
                            <p class="adm-hint">Shown on the individual service detail page</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="adm-fl">Icon</td>
                        <td class="adm-fi">
                            <input type="text" name="icon" value="{{ old('icon') }}" maxlength="10" class="adm-input" placeholder="Emoji or character">
                        </td>
                    </tr>
                    <tr>
                        <td class="adm-fl">Display Order</td>
                        <td class="adm-fi">
                            <input type="number" name="order" value="{{ old('order') }}" class="adm-input" placeholder="0">
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="adm-form-actions">
            <button type="submit" class="adm-btn adm-btn-primary">Create Service</button>
            <a href="{{ route('admin.services.index') }}" class="adm-btn adm-btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
