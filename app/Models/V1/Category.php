<?php

namespace App\Models\V1;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\V1\Category
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $is_active
 * @property int|null $parent_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereIsActive($value)
 * @method static Builder|Category whereParentId($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereTitle($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'parent_id'
    ];

    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id','id')
            ->with('children');
    }
}
