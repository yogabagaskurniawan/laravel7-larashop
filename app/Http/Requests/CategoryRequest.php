<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Pakaian Wanita
        //     Jeans
        //     Gamis
        // Pakaian Pria
        //     Kemeja 
        //     Jeans

        // mengambil parent id dan id dari form
        $parentId = (int) $this->input('parent_id');
        $id = (int) $this->input('id');

        // jika user edit
        if ($this->method() == 'PUT') {
            if ($parentId > 0) {
                $name = 'required|unique:categories,name,' . $id . ',id,parent_id,' . $parentId;
            } else {
                $name = 'required|unique:categories,name,' . $id;
            }

            $slug = 'unique:categories,slug,' . $id;
        } else {
            $name = 'required|unique:categories,name,NULL,id,parent_id,' . $parentId;
            $slug = 'unique:categories,slug';
        }

        return [
            'name' => $name,
            'slug' => $slug,
        ];
    }
}
