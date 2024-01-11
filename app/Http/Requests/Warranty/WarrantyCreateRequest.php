<?php

namespace App\Http\Requests\Warranty;

use Illuminate\Foundation\Http\FormRequest;

class WarrantyCreateRequest extends FormRequest
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
        return [
            'uuid'                    => 'required|string|max:20',
            'status'                  => 'required|string',
            'is_hoa'                  => 'required|boolean',
            'hoa_name'                => 'sometimes|nullable|string',
            'tile_profile'            => 'sometimes|nullable|string',
            'tile_color'              => 'sometimes|nullable|string',
            'owner_id'                => 'required|integer|exists:owners,id',
            'install_type'            => 'required|string',
            'addresses'               => 'required|json',
            'addresses.*.street'      => 'required|string',
            'addresses.*.city'        => 'required|string',
            'addresses.*.state'       => 'required|string',
            'addresses.*.zip'         => 'required|string',
            'installer_info'          => 'required|json',
            'installer_info.*.type'   => 'required|string',
            'installer_info.*.name'   => 'required|string',
            'installer_info.*.email'  => 'required|email',
            'installer_info.*.street' => 'required|string',
            'installer_info.*.city'   => 'required|string',
            'installer_info.*.state'  => 'required|string',
            'installer_info.*.zip'    => 'required|string',
            'installed_at'            => 'required|date',
        ];
    }
}
