{{-- MODERN TEMPLATE: Indigo/Blue gradient, clean, professional --}}
<div class="font-sans">

    {{-- Hero Section --}}
    <div class="bg-gradient-to-br from-indigo-600 via-indigo-700 to-purple-800 text-white">
        <div class="max-w-5xl mx-auto px-6 py-20 text-center">
            <div class="inline-flex items-center px-4 py-1.5 bg-white/10 rounded-full text-sm font-medium mb-6 backdrop-blur-sm">
                ✨ AI-Generated Sales Page &bull; {{ ucfirst($salesPage->template) }} Template
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 tracking-tight">
                {{ $salesPage->headline ?? 'Transform Your Business Today' }}
            </h1>
            <p class="text-xl sm:text-2xl text-indigo-200 max-w-3xl mx-auto mb-10 leading-relaxed">
                {{ $salesPage->sub_headline ?? 'The ultimate solution for your needs.' }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#pricing"
                   class="inline-flex items-center justify-center px-8 py-4 bg-white text-indigo-700 font-bold text-lg rounded-xl hover:bg-indigo-50 transition shadow-lg">
                    {{ $salesPage->call_to_action ?? 'Get Started Now' }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
                <a href="#features"
                   class="inline-flex items-center justify-center px-8 py-4 border-2 border-white/40 text-white font-semibold text-lg rounded-xl hover:bg-white/10 transition">
                    Learn More
                </a>
            </div>
        </div>
    </div>

    {{-- Benefits Section --}}
    @if($salesPage->benefits && count($salesPage->benefits))
    <div class="bg-gray-50 py-16">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Why Choose {{ $salesPage->product_name }}?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Everything you need to succeed, all in one place.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($salesPage->benefits as $benefit)
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="text-3xl mb-3">{{ $benefit['icon'] ?? '✅' }}</div>
                    <p class="text-gray-800 font-medium leading-relaxed">{{ $benefit['text'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Product Description --}}
    @if($salesPage->generated_description)
    <div class="bg-white py-16">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">About {{ $salesPage->product_name }}</h2>
            </div>
            <div class="prose prose-lg max-w-none text-gray-700">
                @foreach(explode("\n", $salesPage->generated_description) as $paragraph)
                    @if(trim($paragraph))
                        <p class="mb-5 leading-relaxed text-lg text-gray-600">{{ $paragraph }}</p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Features Breakdown --}}
    @if($salesPage->features_breakdown && count($salesPage->features_breakdown))
    <div id="features" class="bg-indigo-50 py-16">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Powerful Features</h2>
                <p class="text-gray-600">Built specifically for {{ $salesPage->target_audience }}.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($salesPage->features_breakdown as $feature)
                <div class="flex gap-4 bg-white rounded-xl p-6 shadow-sm border border-indigo-100">
                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-indigo-600 rounded-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">{{ $feature['title'] ?? '' }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $feature['description'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Social Proof --}}
    @if($salesPage->social_proof)
    <div class="bg-white py-16">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">What Our Customers Say</h2>
                <div class="flex justify-center gap-1">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach(array_filter(explode("\n\n", $salesPage->social_proof)) as $testimonial)
                    @if(trim($testimonial))
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                        <svg class="w-8 h-8 text-indigo-300 mb-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p class="text-gray-700 leading-relaxed text-sm">{{ trim($testimonial) }}</p>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Pricing Section --}}
    <div id="pricing" class="bg-gradient-to-br from-indigo-600 to-purple-800 py-20">
        <div class="max-w-2xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Simple, Transparent Pricing</h2>
            <div class="bg-white rounded-2xl p-10 shadow-2xl">
                <div class="text-5xl font-extrabold text-indigo-600 mb-2">{{ $salesPage->price }}</div>
                <p class="text-gray-500 mb-6">For {{ $salesPage->target_audience }}</p>
                <ul class="text-left space-y-3 mb-8">
                    @foreach($salesPage->key_features_array as $feature)
                        <li class="flex items-center gap-2 text-gray-700">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ ucfirst(trim($feature)) }}
                        </li>
                    @endforeach
                </ul>
                <a href="#"
                   class="block w-full py-4 bg-indigo-600 text-white font-bold text-xl rounded-xl hover:bg-indigo-700 transition shadow-lg">
                    {{ $salesPage->call_to_action ?? 'Get Started Now' }}
                </a>
                <p class="text-xs text-gray-400 mt-3">30-day money-back guarantee &bull; No hidden fees</p>
            </div>
        </div>
    </div>

    {{-- Footer CTA --}}
    <div class="bg-gray-900 py-12 text-center">
        <p class="text-gray-400 text-sm">
            &copy; {{ date('Y') }} {{ $salesPage->product_name }} &bull; All rights reserved
        </p>
    </div>
</div>
