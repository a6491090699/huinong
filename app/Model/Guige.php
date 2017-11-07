<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Kind;

class Guige extends Model
{
    //
    public $topid;
    protected $fillable = [
        // 'id' ,
        // 'kinds_id' ,
        // 'name' ,
        // 'is_reqired' ,
        // 'name' ,
        // 'name' ,
        // 'name' ,
        // 'name' ,

    ];
    public $timestamps =false;
    public $table ='guige';

    public function getGuige($kid)
    {
        return Guige::where('kinds_id',$kid)->get();
    }

    public function getParentGuige($kid)
    {
        $this->getPid($kid);
        $topid = $this->topid;

        $guige = Guige::where('kinds_id' , $topid)->get();
        return $guige;
    }

    protected function getPid($id)
    {

        $obj = Kind::where('id',$id)->first();
        if($obj->pid != 0){
            $newid = $obj->pid;
            $this->getPid($newid);

        }else{
            $this->topid = $obj->id;

        }

    }


}
