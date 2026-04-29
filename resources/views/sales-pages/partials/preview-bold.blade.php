{{-- BOLD TEMPLATE: Red/Orange, high-energy, aggressive marketing --}}
<div class="font-sans">

    {{-- Hero --}}
    <div class="bg-gradient-to-r from-red-600 to-orange-500 text-white">
        <div class="max-w-5xl mx-auto px-6 py-20">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center px-4 py-2 bg-black/20 rounded-full text-sm font-bold mb-6 uppercase tracking-widest">
                        🔥 Limited Time Offer
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight mb-6 uppercase">
                        {{ $salesPage->headline ?? 'TRANSFORM YOUR LIFE NOW' }}
                    </h1>
                    <p class="text-xl text-orange-100 max-w-2xl mb-8 leading-relaxed">
                        {{ $salesPage->sub_headline ?? 'The bold solution you have been waiting for.' }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#pricing"
                           class="inline-flex items-center justify-center px-10 py-5 bg-white text-red-600 font-black text-xl rounded-xl hover:bg-orange-50 transition shadow-2xl uppercase tracking-wide">
                            {{ $salesPage->call_to_action ?? 'YES! I WANT IN!' }}
                        </a>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-56 h-56 bg-white/10 rounded-full flex items-center justify-center border-4 border-white/30">
                        <span class="text-8xl">🚀</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Urgent Banner --}}
    <div class="bg-black text-yellow-400 py-4 text-center font-bold text-lg animate-pulse">
        ⚡ ACT NOW — Results Guaranteed for {{ $salesPage->target_audience }}!
    </div>

    {{-- Benefits --}}
    @if($salesPage->benefits && count($salesPage->benefits))
    <div class="bg-gray-900 py-16">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="text-4xl font-black text-white text-center mb-12 uppercase">
                Here's What You <span class="text-red-500">GET</span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($salesPage->benefits as $benefit)
                <div class="flex items-start gap-4 bg-gray-800 rounded-xl p-5 border-l-4 border-red-500">
                    <span class="text-3xl flex-shrink-0">{{ $benefit['icon'] ?? '✅' }}</span>
                    <p class="text-white font-semibold text-lg leading-snug">{{ $benefit['text'] ?? '' }}</p>
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
            <h2 class="text-4xl font-black text-gray-900 text-center mb-10 uppercase">
                The Full <span class="text-red-600">Story</span>
            </h2>
            @foreach(explode("\n", $salesPage->generated_description) as $paragraph)
                @if(trim($paragraph))
                    <p class="mb-5 text-lg text-gray-700 leading-relaxed">{{ $paragraph }}</p>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    {{-- Features --}}
    @if($salesPage->features_breakdown && count($salesPage->features_breakdown))
    <div id="features" class="bg-red-50 py-16">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="text-4xl font-black text-gray-900 text-center mb-12 uppercase">
                Killer <span class="text-red-600">Features</span>
            </h2>
            <div class="space-y-4">
                @foreach($salesPage->features_breakdown as $i => $feature)
                <div class="flex gap-5 bg-white rounded-xl p-6 shadow-sm border-2 border-red-100 hover:border-red-400 transition">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-red-600 rounded-full text-white font-black text-xl">
                        {{ $i + 1 }}
                    </div>
                    <div>
                        <h3 class="font-black text-gray-900 text-xl mb-1 uppercase">{{ $feature['title'] ?? '' }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $feature['description'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Social Proof --}}
    @if($salesPage->social_proof)
    <div class="bg-gray-900 py-16">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="text-4xl font-black text-white text-center mb-12 uppercase">
                Real <span class="text-yellow-400">Results</span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach(array_filter(explode("\n\n", $salesPage->social_proof)) as $testimonial)
                    @if(trim($testimonial))
                    <div class="bg-gray-800 rounded-xl p-6 border-2 border-yellow-400">
                        <div class="flex mb-3">
                            @for($i=0;$i<5;$i++)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <p class="text-gray-300 leading-relaxed">{{ trim($testimonial) }}</p>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Pricing --}}
    <div id="pricing" class="bg-gradient-to-r from-red-600 to-orange-500 py-20">
        <div class="max-w-2xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black text-white mb-4 uppercase">One Decision. Infinite Results.</h2>
            <div class="bg-white rounded-2xl p-10 shadow-2xl">
                <div class="bg-red-600 text-white text-sm font-bold uppercase tracking-widest py-2 px-6 rounded-full inline-block mb-4">
                    Best Value
                </div>
                <div class="text-6xl font-black text-red-600 mb-2">{{ $salesPage->price }}</div>
                <p class="text-gray-500 mb-6 font-semibold">For {{ $salesPage->target_audience }}</p>
                <ul class="text-left space-y-3 mb-8">
                    @foreach($salesPage->key_features_array as $feature)
                        <li class="flex items-center gap-3 text-gray-700 font-medium">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ ucfirst(trim($feature)) }}
                        </li>
                    @endforeach
                </ul>
                <a href="#"
                   class="block w-full py-5 bg-red-600 text-white font-black text-2xl rounded-xl hover:bg-red-700 transition shadow-2xl uppercase">
                    {{ $salesPage->call_to_action ?? 'GET INSTANT ACCESS NOW!' }}
                </a>
                <p class="text-xs text-gray-400 mt-3 font-semibold">✅ 100% Money-Back Guarantee &bull; ✅ Instant Access &bull; ✅ No Risk</p>
            </div>
        </div>
    </div>

    <div class="bg-black py-8 text-center">
        <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} {{ $salesPage->product_name }}. All Rights Reserved.</p>
    </div>
</div>
