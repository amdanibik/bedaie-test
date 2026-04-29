<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AI Sales Page Generator — SalesCraft AI</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-white">

    <nav class="fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-md border-b border-gray-100 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="font-bold text-gray-900">SalesCraft AI</span>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('sales-pages.index') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">My Pages</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">Sign In</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Get Started Free</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="pt-24 pb-20 bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 text-center">
            <div class="inline-flex items-center px-4 py-2 bg-indigo-100 rounded-full text-sm font-medium text-indigo-700 mb-8">
                ✨ Powered by AI — No copywriting skills needed
            </div>
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-gray-900 leading-tight mb-8 tracking-tight">
                Turn Product Info Into
                <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent"> Killer Sales Pages</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-12 leading-relaxed">
                Describe your product in plain English. Our AI generates a complete, conversion-optimized sales page with headlines, benefits, features, social proof, and a compelling CTA — in seconds.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-indigo-600 text-white font-bold text-lg rounded-xl hover:bg-indigo-700 transition shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Generate Your First Page
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 text-gray-700 font-semibold text-lg rounded-xl hover:bg-gray-50 transition">
                    Sign In
                </a>
            </div>
        </div>
    </div>

    <div class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Everything You Need</h2>
                <p class="text-xl text-gray-500 max-w-2xl mx-auto">A complete platform to create, manage, and export professional sales pages.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-8 rounded-2xl bg-gray-50 hover:bg-indigo-50 transition border border-transparent hover:border-indigo-100">
                    <div class="text-4xl mb-4">🤖</div>
                    <h3 class="font-bold text-gray-900 text-xl mb-2">AI-Powered Copy</h3>
                    <p class="text-gray-600 leading-relaxed">GPT generates persuasive headlines, descriptions, benefits, and CTAs tailored to your product.</p>
                </div>
                <div class="p-8 rounded-2xl bg-gray-50 hover:bg-indigo-50 transition border border-transparent hover:border-indigo-100">
                    <div class="text-4xl mb-4">🎨</div>
                    <h3 class="font-bold text-gray-900 text-xl mb-2">4 Design Templates</h3>
                    <p class="text-gray-600 leading-relaxed">Choose from Modern, Bold, Minimal, and Elegant themes to match your brand personality.</p>
                </div>
                <div class="p-8 rounded-2xl bg-gray-50 hover:bg-indigo-50 transition border border-transparent hover:border-indigo-100">
                    <div class="text-4xl mb-4">⚡</div>
                    <h3 class="font-bold text-gray-900 text-xl mb-2">Instant Preview</h3>
                    <p class="text-gray-600 leading-relaxed">See your live sales page immediately after generation — no designer or developer needed.</p>
                </div>
                <div class="p-8 rounded-2xl bg-gray-50 hover:bg-indigo-50 transition border border-transparent hover:border-indigo-100">
                    <div class="text-4xl mb-4">🔄</div>
                    <h3 class="font-bold text-gray-900 text-xl mb-2">Section Regeneration</h3>
                    <p class="text-gray-600 leading-relaxed">Regenerate just the headline, benefits, or CTA without redoing the entire page.</p>
                </div>
                <div class="p-8 rounded-2xl bg-gray-50 hover:bg-indigo-50 transition border border-transparent hover:border-indigo-100">
                    <div class="text-4xl mb-4">💾</div>
                    <h3 class="font-bold text-gray-900 text-xl mb-2">Save & Manage</h3>
                    <p class="text-gray-600 leading-relaxed">All your sales pages saved in the cloud. View, edit, and delete anytime from your dashboard.</p>
                </div>
                <div class="p-8 rounded-2xl bg-gray-50 hover:bg-indigo-50 transition border border-transparent hover:border-indigo-100">
                    <div class="text-4xl mb-4">📤</div>
                    <h3 class="font-bold text-gray-900 text-xl mb-2">HTML Export</h3>
                    <p class="text-gray-600 leading-relaxed">Download your sales page as a standalone HTML file ready to deploy anywhere.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-24 bg-indigo-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">How It Works</h2>
                <p class="text-xl text-gray-500">Three simple steps to your perfect sales page.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-600 text-white font-extrabold text-2xl rounded-2xl flex items-center justify-center mx-auto mb-4">1</div>
                    <h3 class="font-bold text-gray-900 text-lg mb-2">Describe Your Product</h3>
                    <p class="text-gray-600">Fill in your product name, description, features, target audience, and price.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-600 text-white font-extrabold text-2xl rounded-2xl flex items-center justify-center mx-auto mb-4">2</div>
                    <h3 class="font-bold text-gray-900 text-lg mb-2">AI Generates the Page</h3>
                    <p class="text-gray-600">Our AI crafts compelling copy for every section of your sales page.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-600 text-white font-extrabold text-2xl rounded-2xl flex items-center justify-center mx-auto mb-4">3</div>
                    <h3 class="font-bold text-gray-900 text-lg mb-2">Preview & Export</h3>
                    <p class="text-gray-600">Review the live preview, tweak any section, and export or share your page.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-24 bg-gradient-to-br from-indigo-600 to-purple-700">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-4xl font-bold text-white mb-4">Ready to Build Your Sales Page?</h2>
            <p class="text-indigo-200 text-xl mb-10">Create your first AI-powered sales page for free.</p>
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-10 py-5 bg-white text-indigo-700 font-bold text-xl rounded-xl hover:bg-indigo-50 transition shadow-2xl">
                Get Started — It's Free
            </a>
        </div>
    </div>

    <footer class="bg-gray-900 py-10 text-center">
        <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} SalesCraft AI. Built with Laravel 11, Breeze, Tailwind CSS &amp; OpenAI.</p>
    </footer>

</body>
</html>
