<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Conversions\ConversionCollection;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Spatie\MediaLibrary\HasMedia;

class Product extends Model implements HasMedia
{

    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

    public $image_url = null;
    protected $fillable = [
        'title',
        'category_id',
        'price',
        'description',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $appends = ['resource_url'];

    /*     * *********************** ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/products/' . $this->getKey());
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_images')
                ->accepts('image/*')
                ->maxNumberOfFiles(20);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('site_image')
                ->width(250)
                ->height(145)
                ->performOnCollections('product_images');
        $this->addMediaConversion('thumb')
                ->width(50)
                ->height(29)
                ->performOnCollections('product_images');
    }

    public function getThumbsForAdmin(string $mediaCollectionName)
    {
        $mediaCollection = $this->getMediaCollection($mediaCollectionName);
        return $this->getMedia($mediaCollectionName)->filter(static function ($medium) use ($mediaCollectionName, $mediaCollection) {
                    //We also want all files (PDF, Word, Excell etc.)
                    if (!$mediaCollection->isImage()) {
                        return true;
                    }

                    return ConversionCollection::createForMedia($medium)->filter(static function ($conversion) use ($mediaCollectionName) {
                        return $conversion->shouldBePerformedOn($mediaCollectionName);
                    })->filter(static function ($conversion) {
                        return $conversion->getName() === 'thumb';
                    })->count() > 0;
                })->map(static function ($medium) use ($mediaCollection) {
                    return [
                'id' => $medium->id,
                'url' => $medium->getUrl(),
                'thumb_url' => $mediaCollection->isImage() ? $medium->getUrl('thumb') : $medium->getUrl(),
                'type' => $medium->mime_type,
                'mediaCollection' => $mediaCollection->getName(),
                'name' => $medium->hasCustomProperty('name') ? $medium->getCustomProperty('name') : $medium->file_name,
                'size' => $medium->size,
                    ];
                });
    }

    public function getThumbsForSite(string $mediaCollectionName)
    {
        $mediaCollection = $this->getMediaCollection($mediaCollectionName);
        return $this->getMedia($mediaCollectionName)->filter(static function ($medium) use ($mediaCollectionName, $mediaCollection) {
                    //We also want all files (PDF, Word, Excell etc.)
                    if (!$mediaCollection->isImage()) {
                        return true;
                    }

                    return ConversionCollection::createForMedia($medium)->filter(static function ($conversion) use ($mediaCollectionName) {
                        return $conversion->shouldBePerformedOn($mediaCollectionName);
                    })->filter(static function ($conversion) {
                        return $conversion->getName() === 'site_image';
                    })->count() > 0;
                })->map(static function ($medium) use ($mediaCollection) {
                    return [
                'id' => $medium->id,
                'url' => $medium->getUrl(),
                'thumb_url' => $mediaCollection->isImage() ? $medium->getUrl('site_image') : $medium->getUrl(),
                'type' => $medium->mime_type,
                'mediaCollection' => $mediaCollection->getName(),
                'name' => $medium->hasCustomProperty('name') ? $medium->getCustomProperty('name') : $medium->file_name,
                'size' => $medium->size,
                    ];
                });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
