<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'topic'=>$this->name,
            'teacher_name'=>$this->teacher->name,
            'category_name'=>$this->classroomType->type,
            'date'=>$this->date,
            'time'=>$this->start_time."to".$this->end_time,
            'attachment'=>optional($this->attachment)->uri

        ];
    }
}
