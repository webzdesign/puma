<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'season',
        'dumy_code',
        'final_code',
        'style',
        'source',
        'style_desc',
        'color_desc',
        'page_RBU',
        'display_BU',
        'age_group',
        'key',
        'sort_key',
        'product_type',
        'final_MRP',
        'final_gender',
        'global_ki',
        'marketing_tier',
        'channel-w22',
        'line',
        'customer(online)',
        'story',
        'colab',
        'upper',
        'mid_sole',
        'out_sole',
        'description',
        'size_run',
        'technology',
        'marketing',
        'additional',
        'key_highlight',
        'fk_retail',
        'fk_discount',
        'myntra_retail',
        'myntra_discount',
        'ajio_retail',
        'ajio_discount',
        'amazon_discount',
    ];
    // protected $guarded = [];
}
