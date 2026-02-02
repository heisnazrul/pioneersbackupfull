@php
    $content = $cmsPage->content ?? [];
    $inputClass = "mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:border-primary focus:ring focus:ring-primary dark:bg-black/20 dark:border-white/10 dark:text-white";
    $labelClass = "block text-sm font-medium text-gray-700 dark:text-white mb-2";
@endphp

{{-- Hero Section --}}
<div class="box border border-gray-200 dark:border-white/10 mb-4">
    <div class="box-header bg-gray-50 dark:bg-black/20">
        <div class="box-title">Hero Section</div>
    </div>
    <div class="box-body">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 md:col-span-4">
                <label class="{{ $labelClass }}">Badge Text</label>
                <input type="text" class="{{ $inputClass }}" name="content[hero][badge]"
                    value="{{ $content['hero']['badge'] ?? '' }}">
            </div>
            <div class="col-span-12 md:col-span-4">
                <label class="{{ $labelClass }}">Hero Title</label>
                <input type="text" class="{{ $inputClass }}" name="content[hero][title]"
                    value="{{ $content['hero']['title'] ?? '' }}">
            </div>
            <div class="col-span-12">
                <label class="{{ $labelClass }}">Hero Description</label>
                <textarea class="{{ $inputClass }}" name="content[hero][description]"
                    rows="3">{{ $content['hero']['description'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
</div>

{{-- Categories Section --}}
<div class="box border border-gray-200 dark:border-white/10 mb-4">
    <div class="box-header bg-gray-50 dark:bg-black/20">
        <div class="box-title">Guide Categories</div>
    </div>
    <div class="box-body">
        <div id="guide-categories">
            @foreach($content['categories'] ?? [] as $index => $category)
                <div class="border border-gray-200 dark:border-white/10 p-4 mb-3 rounded-sm relative">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-4">
                            <label class="{{ $labelClass }}">Title</label>
                            <input type="text" class="{{ $inputClass }}" name="content[categories][{{$index}}][title]"
                                value="{{ $category['title'] }}">
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label class="{{ $labelClass }}">Icon Class (FontAwesome)</label>
                            <input type="text" class="{{ $inputClass }}" name="content[categories][{{$index}}][icon]"
                                value="{{ $category['icon'] }}">
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label class="{{ $labelClass }}">Color Class</label>
                            <input type="text" class="{{ $inputClass }}" name="content[categories][{{$index}}][color]"
                                value="{{ $category['color'] }}">
                        </div>
                        <div class="col-span-12">
                            <label class="{{ $labelClass }}">Description</label>
                            <input type="text" class="{{ $inputClass }}" name="content[categories][{{$index}}][description]"
                                value="{{ $category['description'] }}">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <small class="text-gray-500">Note: Currently, adding new categories requires developer intervention for
            icons.</small>
    </div>
</div>

{{-- Trust Section --}}
<div class="box border border-gray-200 dark:border-white/10 mb-4">
    <div class="box-header bg-gray-50 dark:bg-black/20">
        <div class="box-title">Trust Section</div>
    </div>
    <div class="box-body">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 md:col-span-6">
                <label class="{{ $labelClass }}">Title</label>
                <input type="text" class="{{ $inputClass }}" name="content[trust_section][title]"
                    value="{{ $content['trust_section']['title'] ?? '' }}">
            </div>
            <div class="col-span-12 md:col-span-6">
                <label class="{{ $labelClass }}">CTA Button Text</label>
                <input type="text" class="{{ $inputClass }}" name="content[trust_section][cta_text]"
                    value="{{ $content['trust_section']['cta_text'] ?? '' }}">
            </div>
            <div class="col-span-12">
                <label class="{{ $labelClass }}">Description</label>
                <textarea class="{{ $inputClass }}" name="content[trust_section][description]"
                    rows="3">{{ $content['trust_section']['description'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
</div>