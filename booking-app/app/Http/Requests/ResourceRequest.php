<?php

namespace App\Http\Requests;

use App\Models\Content\PressArticle;
use App\Models\Content\PressArticleType;
use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => 'required|string',
            'type'          => 'required|string',
            'description'   => 'nullable|string',
        ];
    }

}
