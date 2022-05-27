<?php

namespace App\Repositories;
use App\Models\Image;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\Storage;

class ImageRepository
{
    public function store($request)
    {
        // Save image
        $path = Storage::disk('public')->put('', $request->file('image'));
        // Save thumb
        $image = InterventionImage::make($request->file('image'))->widen(500);
        Storage::disk('local')->put($path, $image->encode());
        // Save in base
        $image = new Image;
        $image->description = $request->description;
        $image->category_id = $request->category_id;
        $image->name = $path;
        $image->user_id = auth()->id();
        $image->save();
    }

    public function getImagesForCategory($slug)
    {
        return Image::latestWithUser()->whereHas('category', function ($query) use ($slug) {
            $query->whereSlug($slug);
        })->paginate(9);
    }

    public function getImagesForUser($idUser)
    {
        return Image::latestWithUser()->whereHas('user', function ($q) use ($idUser){
            $q->whereId($idUser);
        })->paginate(9);
    }

    public function getOrphans()
    {
        $files = collect(Storage::disk('public')->files());
        $images = Image::select('name')->get()->pluck('name');
        return $files->diff($images);
    }

    public function destroyOrphans()
    {
        $orphans = $this->getOrphans ();
        foreach($orphans as $orphan) {
            Storage::disk('public')->delete($orphan);
            Storage::disk('local')->delete($orphan);
        }
    }
}