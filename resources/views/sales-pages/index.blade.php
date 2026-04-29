<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Sales Pages
            </h2>
            <a href="{{ route('sales-pages.create') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Sales Page
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 flex items-center p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($pages->isEmpty())
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-indigo-100 rounded-full mb-6">
                        <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No sales pages yet</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">Create your first AI-powered sales page and transform your product into a compelling landing page in seconds.</p>
                    <a href="{{ route('sales-pages.create') }}"
                       class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Your First Page
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($pages as $page)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition overflow-hidden">
                            {{-- Template color bar --}}
                            @php
                                $colors = ['modern'=>'bg-indigo-500','bold'=>'bg-red-500','minimal'=>'bg-gray-700','elegant'=>'bg-amber-500'];
                                $color = $colors[$page->template] ?? 'bg-indigo-500';
                            @endphp
                            <div class="h-2 {{ $color }}"></div>

                            <div class="p-5">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-bold text-gray-900 text-lg truncate">{{ $page->product_name }}</h3>
                                        <p class="text-sm text-gray-500 mt-0.5">{{ ucfirst($page->template) }} template &bull; {{ $page->price }}</p>
                                    </div>
                                    @if($page->is_generated)
                                        <span class="ml-2 flex-shrink-0 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                            Generated
                                        </span>
                                    @endif
                                </div>

                                @if($page->headline)
                                    <p class="text-sm text-gray-600 italic mb-3 line-clamp-2">"{{ $page->headline }}"</p>
                                @endif

                                <p class="text-xs text-gray-400 mb-4">{{ $page->created_at->diffForHumans() }}</p>

                                <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                                    <a href="{{ route('sales-pages.show', $page) }}"
                                       class="flex-1 text-center px-3 py-1.5 bg-indigo-50 text-indigo-700 text-sm font-medium rounded-lg hover:bg-indigo-100 transition">
                                        Preview
                                    </a>
                                    <a href="{{ route('sales-pages.edit', $page) }}"
                                       class="flex-1 text-center px-3 py-1.5 bg-gray-50 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-100 transition">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('sales-pages.destroy', $page) }}"
                                          onsubmit="return confirm('Delete this sales page?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1.5 bg-red-50 text-red-600 text-sm font-medium rounded-lg hover:bg-red-100 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $pages->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
