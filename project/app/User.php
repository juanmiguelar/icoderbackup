<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','tipo', 'id_canton'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
     protected $table = 'users';
    
    
     public static function showUser($id) {
         
       $user =  User::where('id', $id)->first();
    
       return $user;
      }
    
    public static function showUsers() {
         
       $users = User::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);
       return $users;
    }
    
     public static function editarPrivilegio($usuario) {
        \DB::table('users')
            ->where('id', $usuario->id)
            ->update(['tipo' => $usuario->tipo,'active_flag'=> 1,'updated_at' => date('Y-m-d H:i:s')]);
    }
    
    public static function editarUsuario($usuario, $userid) {
        \DB::table('users')
            ->where('id', $usuario->id)
            ->update(['usu_id' => $userid,'tipo' => $usuario->tipo,'name'=> $usuario->name, 'email' => $usuario->email, 'id_canton' => $usuario->id_canton,'updated_at' => date('Y-m-d H:i:s')]);
    }
      
    public function validarEmail($email){
      $cantidad = User::where('email', $email)->count();
      return $cantidad == 0;
    }
    
        public function validarEmailUpdate($email, $id){
      $cantidad = User::where('email', $email) ->where('id', '!=',  $id )->count();
      return $cantidad == 0;
    }
}
