<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'id'         => '',
            'name'       => '',
            'nickname'   => '',
            'email'      => '',
            'password'   => '',
            'created_at' => '',
            'updated_at' => '',
        ];
    }
}
