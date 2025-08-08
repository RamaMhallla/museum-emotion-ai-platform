<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ArtworkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = Auth::user()?->lang ?? 'en';

        return [
            'id' => $this->id,
            'title' => $lang == 'it' ? $this->title_it : $this->title,
            'description' =>  $lang == 'it' ? $this->description_it : $this->description,
            'image_url' => $this->image_url,
            'category_name' => $lang == 'it' ? $this->category?->name_it : $this->category?->name,
        ];
    }
}
