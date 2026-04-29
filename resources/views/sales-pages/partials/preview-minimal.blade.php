{{-- MINIMAL TEMPLATE: Clean white/dark, typography-focused --}}
<div class="font-sans bg-white">

    {{-- Hero --}}
    <div class="max-w-4xl mx-auto px-6 pt-24 pb-20 text-center">
        <p class="text-xs uppercase tracking-[0.3em] text-gray-400 font-medium mb-6">
            Designed for {{ $salesPage->target_audience }}
        </p>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-light text-gray-900 leading-tight mb-8 tracking-tight">
            {{ $salesPage->headline ?? 'Less noise. More results.' }}
        </h1>
        <p class="text-xl text-gray-500 max-w-2xl mx-auto mb-12 leading-relaxed font-light">
            {{ $salesPage->sub_headline ?? 'The minimal approach to maximum impact.' }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#pricing"
               class="inline-flex items-center justify-center px-10 py-4 bg-gray-900 text-white font-medium rounded-none hover:bg-gray-700 transition tracking-wide">
                {{ $salesPage->call_to_action ?? 'Get Started' }}
            </a>
            <a href="#features"
               class="inline-flex items-center justify-center px-10 py-4 border border-gray-300 text-gray-700 font-medium rounded-none hover:bg-gray-50 transition tracking-wide">
                See Features
            </a>
        </div>
    </div>

    {{-- Divider --}}
    <div class="max-w-4xl mx-auto px-6">
        <hr class="border-gray-200">
    </div>

    {{-- Benefits --}}
    @if($salesPage->benefits && count($salesPage->benefits))
    <div class="max-w-4xl mx-auto px-6 py-20">
        <p class="text-xs uppercase tracking-[0.3em] text-gray-400 font-medium mb-3 text-center">Benefits</p>
        <h2 class="text-3xl font-light text-gray-900 text-center mb-16">Why it works</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($salesPage->benefits as $benefit)
            <div class="text-center">
                <div class="text-3xl mb-3">{{ $benefit['icon'] ?? '○' }}</div>
                <p class="text-gray-600 leading-relaxed font-light">{{ $benefit['text'] ?? '' }}</p>
            </div>
            @endforeach
        </div>
    </div>
    <div class="max-w-4xl mx-auto px-6"><hr class="border-gray-200"></div>
    @endif

    {{-- Product Description --}}
    @if($salesPage->generated_description)
    <div class="max-w-3xl mx-auto px-6 py-20">
        <p class="text-xs uppercase tracking-[0.3em] text-gray-400 font-medium mb-3 text-center">About</p>
        <h2 class="text-3xl font-light text-gray-900 text-center mb-10">{{ $salesPage->product_name }}</h2>
        @foreach(explode("\n", $salesPage->generated_description) as $paragraph)
            @if(trim($paragraph))
                <p class="mb-5 text-gray-600 leading-loose font-light text-lg">{{ $paragraph }}</p>
            @endif
        @endforeach
    </div>
    <div class="max-w-4xl mx-auto px-6"><hr class="border-gray-200"></div>
    @endif

    {{-- Features --}}
    @if($salesPage->features_breakdown && count($salesPage->features_breakdown))
    <div id="features" class="max-w-4xl mx-auto px-6 py-20">
        <p class="text-xs uppercase tracking-[0.3em] text-gray-400 font-medium mb-3 text-center">Features</p>
        <h2 class="text-3xl font-light text-gray-900 text-center mb-16">What's included</h2>
        <div class="space-y-10">
            @foreach($salesPage->features_breakdown as $i => $feature)
            <div class="flex gap-8 items-start">
                <div class="flex-shrink-0 w-8 text-center">
                    <span class="text-xs text-gray-300 font-medium">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="flex-1 border-t border-gray-100 pt-4">
                    <h3 class="font-medium text-gray-900 mb-2">{{ $feature['title'] ?? '' }}</h3>
                    <p class="text-gray-500 leading-relaxed font-light">{{ $feature['description'] ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="max-w-4xl mx-auto px-6"><hr class="border-gray-200"></div>
    @endif

    {{-- Social Proof --}}
    @if($salesPage->social_proof)
    <div class="max-w-4xl mx-auto px-6 py-20">
        <p class="text-xs uppercase tracking-[0.3em] text-gray-400 font-medium mb-3 text-center">Testimonials</p>
        <h2 class="text-3xl font-light text-gray-900 text-center mb-16">What people say</h2>
        <div class="space-y-8">
            @foreach(array_filter(explode("\n\n", $salesPage->social_proof)) as $testimonial)
                @if(trim($testimonial))
                <blockquote class="border-l-2 border-gray-300 pl-8">
                    <p class="text-gray-600 leading-loose font-light italic text-lg">{{ trim($testimonial) }}</p>
                </blockquote>
                @endif
            @endforeach
        </div>
    </div>
    <div class="max-w-4xl mx-auto px-6"><hr class="border-gray-200"></div>
    @endif

    {{-- Pricing --}}
    <div id="pricing" class="max-w-2xl mx-auto px-6 py-24 text-center">
        <p class="text-xs uppercase tracking-[0.3em] text-gray-400 font-medium mb-3">Pricing</p>
        <h2 class="text-4xl font-light text-gray-900 mb-6">Simple pricing.</h2>
        <div class="text-6xl font-thin text-gray-900 mb-3">{{ $salesPage->price }}</div>
        <p class="text-gray-500 font-light mb-10">For {{ $salesPage->target_audience }}</p>
        <ul class="text-left max-w-sm mx-auto space-y-3 mb-10">
            @foreach($salesPage->key_features_array as $feature)
                <li class="flex items-center gap-3 text-gray-600 font-light">
                    <span class="text-gray-400">—</span>
                    {{ ucfirst(trim($feature)) }}
                </li>
            @endforeach
        </ul>
        <a href="#" class="block w-full py-4 bg-gray-900 text-white font-medium hover:bg-gray-700 transition tracking-widest uppercase text-sm">
            {{ $salesPage->call_to_action ?? 'Get Started' }}
        </a>
    </div>

    <div class="border-t border-gray-100 py-8 text-center">
        <p class="text-gray-300 text-xs tracking-widest uppercase">&copy; {{ date('Y') }} {{ $salesPage->product_name }}</p>
    </div>
</div>
