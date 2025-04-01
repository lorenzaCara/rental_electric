<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'model' => ['sometimes', 'required', 'string', 'max:255'],
            'type' => ['sometimes', 'required', 'string', 'in:car,scooter,bike'],
            'battery_capacity' => ['sometimes', 'required', 'integer', 'min:0'],
            'status' => ['sometimes', 'required', 'string', 'in:available,rented,maintenance'],
            'hourly_rate' => ['sometimes', 'required', 'numeric', 'min:0'],
            'image' => ['sometimes', 'required', 'image', 'max:2048'], // max 2MB
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'image.max' => "L'immagine non può superare i 2MB",
            'image.image' => "Il file deve essere un'immagine (jpeg, png, bmp, gif, svg, or webp)",
        ];
    }
}
