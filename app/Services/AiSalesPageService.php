<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiSalesPageService
{
    private string $apiKey;
    private string $apiUrl;
    private string $model;

    public function __construct()
    {
        $this->apiKey = config('services.openai.key', '');
        $this->apiUrl = 'https://api.openai.com/v1/chat/completions';
        $this->model = config('services.openai.model', 'gpt-3.5-turbo');
    }

    public function generate(array $productData): array
    {
        $prompt = $this->buildPrompt($productData);

        if (empty($this->apiKey)) {
            return $this->generateFallback($productData);
        }

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(60)
                ->post($this->apiUrl, [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You are an expert copywriter and marketing strategist. Generate structured sales page content in valid JSON format only. No markdown, no explanation — raw JSON only.',
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt,
                        ],
                    ],
                    'temperature' => 0.8,
                    'max_tokens' => 2000,
                ]);

            if ($response->failed()) {
                Log::error('OpenAI API error', ['status' => $response->status(), 'body' => $response->body()]);
                return $this->generateFallback($productData);
            }

            $content = $response->json('choices.0.message.content', '');
            $parsed = json_decode($content, true);

            if (!$parsed || !isset($parsed['headline'])) {
                Log::warning('Invalid AI response structure', ['content' => $content]);
                return $this->generateFallback($productData);
            }

            return $parsed;
        } catch (\Throwable $e) {
            Log::error('AI generation exception', ['message' => $e->getMessage()]);
            return $this->generateFallback($productData);
        }
    }

    public function regenerateSection(array $productData, string $section): array
    {
        if (empty($this->apiKey)) {
            return $this->generateFallbackSection($productData, $section);
        }

        $sectionPrompts = [
            'headline' => 'Generate only a compelling headline (max 10 words) for this product. Return JSON: {"headline": "..."}',
            'sub_headline' => 'Generate only a sub-headline (1-2 sentences) for this product. Return JSON: {"sub_headline": "..."}',
            'benefits' => 'Generate only a benefits array (5 items, each with "icon" emoji and "text") for this product. Return JSON: {"benefits": [...]}',
            'call_to_action' => 'Generate only a strong call-to-action button text and urgency line. Return JSON: {"call_to_action": "...", "cta_urgency": "..."}',
            'social_proof' => 'Generate realistic-sounding social proof testimonials (2-3 quotes). Return JSON: {"social_proof": "..."}',
        ];

        $basePrompt = "Product: {$productData['product_name']}\nDescription: {$productData['description']}\nTarget Audience: {$productData['target_audience']}\nPrice: {$productData['price']}\n\n";
        $sectionPrompt = $sectionPrompts[$section] ?? $sectionPrompts['headline'];

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(30)
                ->post($this->apiUrl, [
                    'model' => $this->model,
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are an expert copywriter. Return raw JSON only.'],
                        ['role' => 'user', 'content' => $basePrompt . $sectionPrompt],
                    ],
                    'temperature' => 0.9,
                    'max_tokens' => 500,
                ]);

            $content = $response->json('choices.0.message.content', '');
            return json_decode($content, true) ?? $this->generateFallbackSection($productData, $section);
        } catch (\Throwable $e) {
            return $this->generateFallbackSection($productData, $section);
        }
    }

    private function buildPrompt(array $data): string
    {
        $features = is_array($data['key_features']) ? implode(', ', $data['key_features']) : $data['key_features'];

        return <<<PROMPT
Create a complete sales page for the following product. Return ONLY valid JSON with this exact structure:

{
  "headline": "compelling headline (max 10 words)",
  "sub_headline": "engaging sub-headline (1-2 sentences)",
  "generated_description": "persuasive product description (2-3 paragraphs)",
  "benefits": [
    {"icon": "✅", "text": "benefit description"},
    {"icon": "🚀", "text": "benefit description"},
    {"icon": "💡", "text": "benefit description"},
    {"icon": "🎯", "text": "benefit description"},
    {"icon": "⭐", "text": "benefit description"}
  ],
  "features_breakdown": [
    {"title": "Feature Name", "description": "feature detail"},
    {"title": "Feature Name", "description": "feature detail"},
    {"title": "Feature Name", "description": "feature detail"}
  ],
  "social_proof": "2-3 realistic customer testimonials as a single string",
  "call_to_action": "powerful CTA button text"
}

Product Name: {$data['product_name']}
Description: {$data['description']}
Key Features: {$features}
Target Audience: {$data['target_audience']}
Price: {$data['price']}
Unique Selling Points: {$data['unique_selling_points']}
PROMPT;
    }

    private function generateFallback(array $data): array
    {
        $name = $data['product_name'];
        $audience = $data['target_audience'];
        $price = $data['price'];
        $features = is_array($data['key_features'])
            ? $data['key_features']
            : array_filter(array_map('trim', explode(',', $data['key_features'])));

        $benefitsList = [];
        $icons = ['✅', '🚀', '💡', '🎯', '⭐'];
        $benefitTexts = [
            "Save time and boost your productivity significantly",
            "Achieve better results with less effort and stress",
            "Trusted by thousands of satisfied {$audience}",
            "Easy to get started — no technical skills required",
            "Industry-leading quality at an unbeatable price",
        ];
        foreach ($benefitTexts as $i => $text) {
            $benefitsList[] = ['icon' => $icons[$i], 'text' => $text];
        }

        $featuresBreakdown = [];
        foreach (array_slice($features, 0, 4) as $feature) {
            $featuresBreakdown[] = [
                'title' => ucfirst(trim($feature)),
                'description' => "Experience the power of " . trim($feature) . " designed specifically for {$audience}.",
            ];
        }
        if (empty($featuresBreakdown)) {
            $featuresBreakdown = [
                ['title' => 'Premium Quality', 'description' => "Built with the highest standards for {$audience}."],
                ['title' => 'Easy to Use', 'description' => "Intuitive design that anyone can master quickly."],
                ['title' => 'Proven Results', 'description' => "Thousands of satisfied customers can't be wrong."],
            ];
        }

        return [
            'headline' => "Transform Your Life with {$name}",
            'sub_headline' => "The ultimate solution for {$audience} who want real results. Join thousands of happy customers today.",
            'generated_description' => "Introducing {$name} — the revolutionary product designed exclusively for {$audience}. Whether you're looking to save time, increase efficiency, or simply get more done, {$name} delivers the results you deserve.\n\nOur cutting-edge approach combines {$data['description']} into one seamless experience. No complicated setup, no steep learning curve — just immediate, tangible results from day one.\n\nDon't let another day pass without the competitive advantage that {$name} provides. With our unbeatable offer at {$price}, there has never been a better time to invest in yourself.",
            'benefits' => $benefitsList,
            'features_breakdown' => $featuresBreakdown,
            'social_proof' => "\"This product completely changed how I work. I can't imagine going back!\" — Sarah M., Verified Customer\n\n\"Worth every penny. The results speak for themselves.\" — James T., Business Owner\n\n\"I was skeptical at first, but {$name} exceeded all my expectations.\" — Emily R., {$audience}",
            'call_to_action' => "Get {$name} for {$price} — Start Today!",
        ];
    }

    private function generateFallbackSection(array $data, string $section): array
    {
        $fallback = $this->generateFallback($data);
        return array_intersect_key($fallback, array_flip([$section]));
    }
}
