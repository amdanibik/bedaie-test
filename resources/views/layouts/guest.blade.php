<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SalesCraft AI') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            {{-- Left Panel --}}
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-indigo-600 via-indigo-700 to-purple-800 flex-col justify-between p-12">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-white font-bold text-xl">SalesCraft AI</span>
                </div>

                <div>
                    <h2 class="text-4xl font-extrabold text-white leading-tight mb-6">
                        Turn your product info into a killer sales page — in seconds.
                    </h2>
                    <div class="space-y-4">
                        @foreach([['🤖','AI-generated headlines, benefits & CTAs'],['🎨','4 beautiful design templates'],['💾','Save, edit & export as HTML'],['⚡','Section-by-section regeneration']] as [$icon,$text])
                        <div class="flex items-center gap-3 text-indigo-100">
                            <span class="text-2xl">{{ $icon }}</span>
                            <span class="text-base">{{ $text }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <p class="text-indigo-300 text-sm">&copy; {{ date('Y') }} SalesCraft AI. Built with Laravel &amp; OpenAI.</p>
            </div>

            {{-- Right Panel --}}
            <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 bg-gray-50">
                <div class="w-full max-w-md">
                    <div class="lg:hidden flex items-center gap-2 justify-center mb-8">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900">SalesCraft AI</span>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
