<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "token" => $this['token'],
            "user" => [
                "id" => $this['user']->id,
                "name" => $this['user']->name,
                "username" => $this['user']->username,
                "employee_id" => $this['user']->employee_id,
                "mobile_access" => $this['user']->data['mobile'] ?? [],
            ]
        ];
    }
}
