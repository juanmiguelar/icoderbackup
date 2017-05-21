<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rama extends Model
{
    protected $fillable = ['id_rama', 'nombre'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
    
    public static function showRama($id_rama) {
         
       $rama =  Rama::where('id_rama', $id_rama)->first();
    
       return $rama;
    }
    
    public static function showRamas() {
         
       $ramas = Rama::where('active_flag', 1)->orderBy('id_rama', 'desc')->paginate(10);
		
       return $ramas;
      }
     
}
