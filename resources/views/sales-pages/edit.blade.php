<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('sales-pages.show', $salesPage) }}" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Edit & Regenerate: {{ $salesPage->product_name }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Info banner --}}
            <div class="mb-8 flex items-start gap-4 p-5 bg-amber-50 border border-amber-200 rounded-xl">
                <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-amber-500 rounded-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-amber-900">Update & Re-Generate</h3>
                    <p class="text-sm text-amber-800 mt-1">Modify the product details below and click regenerate. The AI will create a completely fresh sales page based on your updated information.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('sales-pages.update', $salesPage) }}" id="editForm">
                @csrf @method('PUT')

                <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                    {{-- Section: Product Info --}}
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h3 class="text-base font-semibold text-gray-900 mb-5 flex items-center gap-2">
                            <span class="w-6 h-6 flex items-center justify-center bg-amber-500 text-white text-xs font-bold rounded-full">1</span>
                            Product Information
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="sm:col-span-2">
                                <label for="product_name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Product / Service Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="product_name" id="product_name"
                                       value="{{ old('product_name', $salesPage->product_name) }}"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('product_name') border-red-400 @enderror">
                                @error('product_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                    Product Description <span class="text-red-500">*</span>
                                </label>
                                <textarea name="description" id="description" rows="4"
                                          class="w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('description') border-red-400 @enderror">{{ old('description', $salesPage->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="target_audience" class="block text-sm font-medium text-gray-700 mb-1">
                                    Target Audience <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="target_audience" id="target_audience"
                                       value="{{ old('target_audience', $salesPage->target_audience) }}"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('target_audience') border-red-400 @enderror">
                                @error('target_audience')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                                    Price / Pricing Plan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="price" id="price"
                                       value="{{ old('price', $salesPage->price) }}"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('price') border-red-400 @enderror">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Section: Features & USP --}}
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h3 class="text-base font-semibold text-gray-900 mb-5 flex items-center gap-2">
                            <span class="w-6 h-6 flex items-center justify-center bg-amber-500 text-white text-xs font-bold rounded-full">2</span>
                            Features & Selling Points
                        </h3>

                        <div class="space-y-5">
                            <div>
                                <label for="key_features" class="block text-sm font-medium text-gray-700 mb-1">
                                    Key Features <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="key_features" id="key_features"
                                       value="{{ old('key_features', $salesPage->key_features) }}"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('key_features') border-red-400 @enderror">
                                <p class="mt-1 text-xs text-gray-500">Separate features with commas</p>
                                @error('key_features')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="unique_selling_points" class="block text-sm font-medium text-gray-700 mb-1">
                                    Unique Selling Points <span class="text-gray-400 font-normal">(optional)</span>
                                </label>
                                <textarea name="unique_selling_points" id="unique_selling_points" rows="3"
                                          class="w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('unique_selling_points', $salesPage->unique_selling_points) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Section: Template --}}
                    <div class="px-6 py-5">
                        <h3 class="text-base font-semibold text-gray-900 mb-5 flex items-center gap-2">
                            <span class="w-6 h-6 flex items-center justify-center bg-amber-500 text-white text-xs font-bold rounded-full">3</span>
                            Choose Template Style
                        </h3>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            @foreach([
                                'modern'  => ['label'=>'Modern',  'color'=>'bg-indigo-600',  'desc'=>'Clean & professional'],
                                'bold'    => ['label'=>'Bold',    'color'=>'bg-red-600',     'desc'=>'High-energy & vibrant'],
                                'minimal' => ['label'=>'Minimal', 'color'=>'bg-gray-800',    'desc'=>'Simple & elegant'],
                                'elegant' => ['label'=>'Elegant', 'color'=>'bg-amber-500',   'desc'=>'Luxury & refined'],
                            ] as $value => $info)
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="template" value="{{ $value }}"
                                           class="peer sr-only"
                                           {{ old('template', $salesPage->template) === $value ? 'checked' : '' }}>
                                    <div class="border-2 border-gray-200 rounded-xl p-3 text-center peer-checked:border-amber-500 peer-checked:bg-amber-50 hover:border-gray-300 transition">
                                        <div class="h-8 {{ $info['color'] }} rounded-lg mb-2"></div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $info['label'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $info['desc'] }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <a href="{{ route('sales-pages.show', $salesPage) }}" class="text-sm text-gray-500 hover:text-gray-700">
                        Cancel
                    </a>
                    <button type="submit" id="submitBtn"
                            class="inline-flex items-center px-8 py-3 bg-amber-500 text-white font-semibold rounded-lg hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Regenerate Sales Page
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.getElementById('editForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = `<svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg> Regenerating with AI...`;
    });
    </script>
</x-app-layout>
