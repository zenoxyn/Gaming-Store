<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'id_seller',
        'id_category',
        'name_product',
        'slug',
        'type_product',
        'description',
        'price',
        'discount_price',
        'stock',
        'images',
        'product_details',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'discount_price' => 'integer',
            'stock' => 'integer',
            'images' => 'array',
            'product_details' => 'array',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $slug = Str::slug($product->name_product);
                $count = 1;
                $originalSlug = $slug;

                while (static::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }

                $product->slug = $slug;
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name_product') && empty($product->slug)) {
                $slug = Str::slug($product->name_product);
                $count = 1;
                $originalSlug = $slug;

                while (static::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }

                $product->slug = $slug;
            }
        });
    }

    // Relationships
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'id_seller');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_product');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_product');
    }

    public function negotiations()
    {
        return $this->hasMany(Negotiation::class, 'id_product');
    }

    // Helper methods
    public function isAvailable()
    {
        return $this->status === 'available' && $this->stock > 0;
    }

    public function getCurrentPrice()
    {
        return $this->discount_price ?? $this->price;
    }

    public function getDiscountPercentage()
    {
        if (!$this->discount_price) return 0;
        return round((($this->price - $this->discount_price) / $this->price) * 100);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function decrementStock($quantity = 1)
    {
        $this->decrement('stock', $quantity);
        if ($this->stock <= 0) {
            $this->update(['status' => 'out_of_stock']);
        }
    }

    public function getFormattedSpecs()
    {
        if (!$this->product_details) return [];

        $details = is_array($this->product_details) ? $this->product_details : json_decode($this->product_details, true);

        // Get spec template from category
        $template = $this->category->spec_template ?? [];

        $formatted = [];
        foreach ($details as $key => $value) {
            // Find label from category template first, fallback to default labels
            $label = null;

            foreach ($template as $field) {
                if ($field['key'] === $key) {
                    $label = $field['label'];
                    break;
                }
            }

            // Fallback to generic labels if not in template
            if (!$label) {
                $defaultLabels = [
                    'server' => 'Server',
                    'gender' => 'Gender',
                    'adventure_rank' => 'Adventure Rank',
                    'primogems' => 'Primogems',
                    'email_access' => 'Email Status',
                    'characters' => 'Characters',
                    'weapons' => 'Weapons',
                    'currency_amount' => 'Amount',
                    'bonus' => 'Bonus',
                    'delivery_time' => 'Delivery Time',
                    'uid_required' => 'UID Required',
                    'server_supported' => 'Supported Servers',
                    'item_type' => 'Item Type',
                    'rarity' => 'Rarity',
                    'quantity' => 'Quantity',
                    'refinement' => 'Refinement',
                    'tradeable' => 'Tradeable',
                    'region' => 'Region',
                    'platform' => 'Platform',
                    'level' => 'Level',
                    'rank' => 'Rank',
                    'tier' => 'Tier',
                ];
                $label = $defaultLabels[$key] ?? ucwords(str_replace('_', ' ', $key));
            }

            // Format value
            if (is_array($value)) {
                $value = implode(', ', $value);
            } elseif (is_bool($value)) {
                $value = $value ? 'Yes' : 'No';
            }

            $formatted[] = [
                'label' => $label,
                'value' => $value
            ];
        }

        return $formatted;
    }
}
