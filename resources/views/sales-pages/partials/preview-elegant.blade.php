{{-- ELEGANT TEMPLATE: Amber/Gold, luxury, refined --}}
<div class="font-sans">

    {{-- Hero --}}
    <div class="bg-gradient-to-br from-stone-900 via-amber-950 to-stone-900 text-white">
        <div class="max-w-5xl mx-auto px-6 pt-8 pb-4 text-right">
            <span class="text-amber-400 text-xs uppercase tracking-[0.4em] font-light">
                Premium &bull; Exclusive &bull; {{ ucfirst($salesPage->template) }}
            </span>
        </div>
        <div class="max-w-5xl mx-auto px-6 pb-24 text-center">
            <div class="w-16 h-px bg-amber-400 mx-auto mb-8"></div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-light text-amber-50 leading-tight mb-6 tracking-wide">
                {{ $salesPage->headline ?? 'Elevate Your Standard' }}
            </h1>
            <div class="w-16 h-px bg-amber-400 mx-auto mb-8"></div>
            <p class="text-xl text-amber-200/80 max-w-2xl mx-auto mb-12 leading-relaxed font-light italic">
                {{ $salesPage->sub_headline ?? 'A refined experience for the discerning few.' }}
            </p>
            <a href="#pricing"
               class="inline-flex items-center justify-center px-12 py-4 border border-amber-400 text-amber-400 font-light text-lg tracking-widest uppercase hover:bg-amber-400 hover:text-stone-900 transition">
                {{ $salesPage->call_to_action ?? 'Discover More' }}
            </a>
        </div>
    </div>

    {{-- Benefits --}}
    @if($salesPage->benefits && count($salesPage->benefits))
    <div class="bg-amber-50 py-20">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-16">
                <p class="text-amber-600 text-xs uppercase tracking-[0.4em] font-medium mb-3">The Experience</p>
                <h2 class="text-3xl font-light text-stone-900 mb-4">Crafted for Excellence</h2>
                <div class="w-12 h-px bg-amber-400 mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($salesPage->benefits as $benefit)
                <div class="bg-white p-8 border border-amber-100 text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-4">{{ $benefit['icon'] ?? '✦' }}</div>
                    <p class="text-stone-600 leading-relaxed font-light">{{ $benefit['text'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Product Description --}}
    @if($salesPage->generated_description)
    <div class="bg-white py-20">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <p class="text-amber-600 text-xs uppercase tracking-[0.4em] font-medium mb-3">Our Story</p>
            <h2 class="text-3xl font-light text-stone-900 mb-4">{{ $salesPage->product_name }}</h2>
            <div class="w-12 h-px bg-amber-400 mx-auto mb-10"></div>
            @foreach(explode("\n", $salesPage->generated_description) as $paragraph)
                @if(trim($paragraph))
                    <p class="mb-6 text-stone-600 leading-loose font-light text-lg">{{ $paragraph }}</p>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    {{-- Features --}}
    @if($salesPage->features_breakdown && count($salesPage->features_breakdown))
    <div id="features" class="bg-stone-900 py-20">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-16">
                <p class="text-amber-400 text-xs uppercase tracking-[0.4em] font-medium mb-3">Capabilities</p>
                <h2 class="text-3xl font-light text-amber-50 mb-4">Exceptional Features</h2>
                <div class="w-12 h-px bg-amber-400 mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($salesPage->features_breakdown as $feature)
                <div class="border border-amber-800 p-8 hover:border-amber-400 transition">
                    <div class="text-amber-400 text-xs uppercase tracking-[0.3em] font-medium mb-2">Feature</div>
                    <h3 class="font-medium text-amber-50 text-xl mb-3">{{ $feature['title'] ?? '' }}</h3>
                    <p class="text-stone-400 leading-relaxed font-light">{{ $feature['description'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Social Proof --}}
    @if($salesPage->social_proof)
    <div class="bg-amber-50 py-20">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-16">
                <p class="text-amber-600 text-xs uppercase tracking-[0.4em] font-medium mb-3">Testimonials</p>
                <h2 class="text-3xl font-light text-stone-900 mb-4">Voices of Excellence</h2>
                <div class="w-12 h-px bg-amber-400 mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach(array_filter(explode("\n\n", $salesPage->social_proof)) as $testimonial)
                    @if(trim($testimonial))
                    <div class="bg-white p-8 border border-amber-100">
                        <div class="text-amber-300 text-4xl font-serif mb-4">"</div>
                        <p class="text-stone-600 leading-relaxed font-light italic text-sm">{{ trim($testimonial) }}</p>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Pricing --}}
    <div id="pricing" class="bg-stone-900 py-24">
        <div class="max-w-2xl mx-auto px-6 text-center">
            <p class="text-amber-400 text-xs uppercase tracking-[0.4em] font-medium mb-3">Investment</p>
            <h2 class="text-3xl font-light text-amber-50 mb-4">The Refined Choice</h2>
            <div class="w-12 h-px bg-amber-400 mx-auto mb-12"></div>
            <div class="border border-amber-700 p-12 hover:border-amber-400 transition">
                <div class="text-5xl font-light text-amber-400 mb-3">{{ $salesPage->price }}</div>
                <p class="text-stone-400 font-light mb-8 text-sm uppercase tracking-widest">For {{ $salesPage->target_audience }}</p>
                <ul class="text-left space-y-4 mb-10 max-w-xs mx-auto">
                    @foreach($salesPage->key_features_array as $feature)
                        <li class="flex items-center gap-3 text-stone-300 font-light">
                            <span class="text-amber-400">✦</span>
                            {{ ucfirst(trim($feature)) }}
                        </li>
                    @endforeach
                </ul>
                <a href="#"
                   class="block w-full py-4 border border-amber-400 text-amber-400 font-light tracking-[0.3em] uppercase text-sm hover:bg-amber-400 hover:text-stone-900 transition">
                    {{ $salesPage->call_to_action ?? 'Begin Your Journey' }}
                </a>
            </div>
        </div>
    </div>

    <div class="bg-stone-950 py-8 text-center">
        <p class="text-stone-600 text-xs tracking-widest uppercase">&copy; {{ date('Y') }} {{ $salesPage->product_name }} &bull; All Rights Reserved</p>
    </div>
</div>
