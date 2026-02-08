@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Display Order</label>
        <input type="number" min="0" name="display_order" value="{{ old('display_order', $page->display_order ?? 0) }}" class="mt-1 w-full border rounded px-3 py-2">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
    <div>
        <label class="block text-sm font-medium text-gray-700">Title (EN)</label>
        <input type="text" name="title" value="{{ old('title', $page->title) }}" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Title (AR)</label>
        <input type="text" name="ar_title" value="{{ old('ar_title', $page->ar_title) }}" class="mt-1 w-full border rounded px-3 py-2">
    </div>
</div>

<div class="mt-3">
    <label class="block text-sm font-medium text-gray-700">Content (HTML)</label>
    <textarea name="content" rows="6" class="mt-1 w-full border rounded px-3 py-2">{{ old('content', $page->content) }}</textarea>
</div>

<div class="mt-3">
    <label class="block text-sm font-medium text-gray-700">Content (AR)</label>
    <textarea name="ar_content" rows="6" class="mt-1 w-full border rounded px-3 py-2">{{ old('ar_content', $page->ar_content) }}</textarea>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
    <div>
        <label class="block text-sm font-medium text-gray-700">Meta Title</label>
        <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="mt-1 w-full border rounded px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Meta Description</label>
        <textarea name="meta_description" rows="2" class="mt-1 w-full border rounded px-3 py-2">{{ old('meta_description', $page->meta_description) }}</textarea>
    </div>
</div>

<div class="flex items-center gap-2 mt-4">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $page->is_active ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary">
    <span class="text-sm text-gray-700">Active</span>
</div>
