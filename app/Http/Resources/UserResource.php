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

        $userdata = [
            'id' => $this->id,
            'login' => $this->login,
            'name' => $this->name,
            'surname' => $this->surname,
            'birthdate' => $this->birthdate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'events' => $this->events,
            'user_events' => $this->user_events
        ];

        if ($this->token) {
            $userdata['token'] = $this->token;
        }

        return $userdata;
    }
}
