<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table        =   'category';
    protected $primaryKey   =   'cate_id';
    public $timestamps   =   false;
    protected $guarded  =   [];

    static public function _getTree($data)
    {
//        $data=self::orderBy('cate_order','asc')->get();
        $tree = [];
        foreach($data as $k=>$v){
            if($v->cate_pid==0){
                $tree[]=$data[$k];
                foreach($data as $key=>$value){
                    if($value->cate_pid==$v->cate_id){
                        $data[$key]['level']='&nbsp;┣━'.$data[$key]['level'];
                        $tree[]=$data[$key];
                    }
                }
            }
        }
        return $tree;
    }

    static public function _tree($data,$id=0,$level=0)
    {
        static $tree=[];
        foreach($data as $v)
        {
            if($v->cate_pid==$id)
            {
                $v['level']=$level;
                $tree=$v;
                self::_tree($data,$v->cate_id,$level+1);
            }
        }
        return $tree;
    }

    public function tree()
    {
        $categorys = $this->orderBy('cate_order','asc')->get();
        return $this->getTree($categorys,'cate_name','cate_id','cate_pid');
    }

    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0)
    {
        $arr = array();
        foreach ($data as $k=>$v){
            if($v->$field_pid==$pid){
                $data[$k]["_".$field_name] = $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach ($data as $m=>$n){
                    if($n->$field_pid == $v->$field_id){
                        $data[$m]["_".$field_name] = '├─ '.$data[$m][$field_name];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
