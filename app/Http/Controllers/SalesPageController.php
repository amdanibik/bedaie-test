<?php

namespace App\Http\Controllers;

use App\Models\SalesPage;
use App\Services\AiSalesPageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class SalesPageController extends Controller
{
    public function __construct(private AiSalesPageService $aiService) {}

    public function index()
    {
        $pages = Auth::user()->salesPages()->latest()->paginate(12);
        return view('sales-pages.index', compact('pages'));
    }

    public function create()
    {
        return view('sales-pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name'         => 'required|string|max:255',
            'description'          => 'required|string|max:2000',
            'key_features'         => 'required|string|max:1000',
            'target_audience'      => 'required|string|max:255',
            'price'                => 'required|string|max:100',
            'unique_selling_points'=> 'nullable|string|max:1000',
            'template'             => 'nullable|string|in:modern,bold,minimal,elegant',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['template'] = $validated['template'] ?? 'modern';

        $salesPage = SalesPage::create($validated);

        $generated = $this->aiService->generate([
            'product_name'          => $salesPage->product_name,
            'description'           => $salesPage->description,
            'key_features'          => $salesPage->key_features,
            'target_audience'       => $salesPage->target_audience,
            'price'                 => $salesPage->price,
            'unique_selling_points' => $salesPage->unique_selling_points ?? '',
        ]);

        $salesPage->update([
            'headline'              => $generated['headline'] ?? '',
            'sub_headline'          => $generated['sub_headline'] ?? '',
            'generated_description' => $generated['generated_description'] ?? '',
            'benefits'              => $generated['benefits'] ?? [],
            'features_breakdown'    => $generated['features_breakdown'] ?? [],
            'social_proof'          => $generated['social_proof'] ?? '',
            'call_to_action'        => $generated['call_to_action'] ?? 'Get Started Now',
            'is_generated'          => true,
        ]);

        return redirect()->route('sales-pages.show', $salesPage)
            ->with('success', 'Your sales page has been generated!');
    }

    public function show(SalesPage $salesPage)
    {
        $this->authorize('view', $salesPage);
        return view('sales-pages.show', compact('salesPage'));
    }

    public function edit(SalesPage $salesPage)
    {
        $this->authorize('update', $salesPage);
        return view('sales-pages.edit', compact('salesPage'));
    }

    public function update(Request $request, SalesPage $salesPage)
    {
        $this->authorize('update', $salesPage);

        $validated = $request->validate([
            'product_name'         => 'required|string|max:255',
            'description'          => 'required|string|max:2000',
            'key_features'         => 'required|string|max:1000',
            'target_audience'      => 'required|string|max:255',
            'price'                => 'required|string|max:100',
            'unique_selling_points'=> 'nullable|string|max:1000',
            'template'             => 'nullable|string|in:modern,bold,minimal,elegant',
        ]);

        $salesPage->update($validated);

        $generated = $this->aiService->generate([
            'product_name'          => $salesPage->product_name,
            'description'           => $salesPage->description,
            'key_features'          => $salesPage->key_features,
            'target_audience'       => $salesPage->target_audience,
            'price'                 => $salesPage->price,
            'unique_selling_points' => $salesPage->unique_selling_points ?? '',
        ]);

        $salesPage->update([
            'headline'              => $generated['headline'] ?? $salesPage->headline,
            'sub_headline'          => $generated['sub_headline'] ?? $salesPage->sub_headline,
            'generated_description' => $generated['generated_description'] ?? $salesPage->generated_description,
            'benefits'              => $generated['benefits'] ?? $salesPage->benefits,
            'features_breakdown'    => $generated['features_breakdown'] ?? $salesPage->features_breakdown,
            'social_proof'          => $generated['social_proof'] ?? $salesPage->social_proof,
            'call_to_action'        => $generated['call_to_action'] ?? $salesPage->call_to_action,
            'is_generated'          => true,
        ]);

        return redirect()->route('sales-pages.show', $salesPage)
            ->with('success', 'Sales page regenerated successfully!');
    }

    public function destroy(SalesPage $salesPage)
    {
        $this->authorize('delete', $salesPage);
        $salesPage->delete();
        return redirect()->route('sales-pages.index')
            ->with('success', 'Sales page deleted.');
    }

    public function regenerateSection(Request $request, SalesPage $salesPage)
    {
        $this->authorize('update', $salesPage);

        $request->validate([
            'section' => 'required|string|in:headline,sub_headline,benefits,call_to_action,social_proof',
        ]);

        $section = $request->input('section');

        $generated = $this->aiService->regenerateSection([
            'product_name'          => $salesPage->product_name,
            'description'           => $salesPage->description,
            'key_features'          => $salesPage->key_features,
            'target_audience'       => $salesPage->target_audience,
            'price'                 => $salesPage->price,
            'unique_selling_points' => $salesPage->unique_selling_points ?? '',
        ], $section);

        if (!empty($generated)) {
            $salesPage->update($generated);
        }

        return redirect()->route('sales-pages.show', $salesPage)
            ->with('success', ucfirst(str_replace('_', ' ', $section)) . ' regenerated!');
    }

    public function exportHtml(SalesPage $salesPage)
    {
        $this->authorize('view', $salesPage);

        $html = view('sales-pages.export', compact('salesPage'))->render();

        return Response::make($html, 200, [
            'Content-Type'        => 'text/html',
            'Content-Disposition' => 'attachment; filename="' . str($salesPage->product_name)->slug() . '-sales-page.html"',
        ]);
    }
}
