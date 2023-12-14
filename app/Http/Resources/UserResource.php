<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'error' => null,
            'result' => [
                'id' => $this->id,
                'login' => $this->login,
                'name' => $this->name,
                'surname' => $this->surname,
                'birthdate' => $this->birthdate,
                'token' => $this->token
            ]
        ];
    }
}
