<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesPage extends Model
{
    protected $fillable = [
        'user_id',
        'product_name',
        'description',
        'key_features',
        'target_audience',
        'price',
        'unique_selling_points',
        'template',
        'headline',
        'sub_headline',
        'generated_description',
        'benefits',
        'features_breakdown',
        'social_proof',
        'call_to_action',
        'is_generated',
    ];

    protected $casts = [
        'benefits' => 'array',
        'features_breakdown' => 'array',
        'is_generated' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getKeyFeaturesArrayAttribute(): array
    {
        return array_filter(array_map('trim', explode(',', $this->key_features)));
    }
}
