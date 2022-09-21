<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $var=Str::random(10);
        // return parent::toArray($request);
        return [
            'full name '=>$this->name,
            'created_at'=>$this->created_at->format('Y-m-d'),
            'created_at_exist'=>$this->when (true,function(){
                return 'it exist in teacher';
            }),
            
            'created_at_false'=>$this->when (false,function(){
                return 'it exist in teacher';
            }),

            //merge
            'random_var'=>$var,
            // 'randonm_var_2'=>$this->getVar()
            'pass_data'=>$this->pass_data?? 'no pass data'
            
        ];
        
    }
}
