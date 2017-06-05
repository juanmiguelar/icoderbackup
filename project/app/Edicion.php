<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Edicion extends Model

{
	protected $fillable = ['lugar', 'fecha_inicio', 'fecha_fin', 'fecha_inscripcion', 'fecha_fin_inscripcion'];
	
	public

	function Author()
	{
		return $this->belongsTo('App\User', 'author_id');
	}

	public static

	function insertarEdicion($edicion, $userid)
	{
		\DB::table('edicions')->insert(['lugar' => $edicion->lugar, 'fecha_inicio' => date('Y-m-d', strtotime($edicion->fecha_inicio)) , 'fecha_fin' => date('Y-m-d', strtotime($edicion->fecha_fin)) , 'fecha_inscripcion' => date('Y-m-d', strtotime($edicion->fecha_inscripcion)) , 'fecha_fin_inscripcion' => date('Y-m-d', strtotime($edicion->fecha_fin_inscripcion)) , 'anno' => $edicion->anno, 'active_flag' => 1, 'author_id' => $userid, 'created_at' => date('Y-m-d H:i:s') , 'updated_at' => date('Y-m-d H:i:s') ]);
	}

	public static

	function comprobarAnno($anno)
	{
		$edicion = Edicion::where('anno', $anno)->count();
		return $edicion;
	}
	
	public static  function comprobarAnnoActivo($anno){
		$edicion = Edicion::where('anno', $anno)->where('active_flag',0)->count();
		return $edicion == 1;
	}
	
	public static function desactivar($anno)
	{
		\DB::table('edicions')
            ->where('anno', $anno)
            ->update(['active_flag' => '0' ]);
	}

	public static function editarEdicion($edicion, $userid)
	{
		\DB::table('edicions')
		    ->where('anno', $edicion->anno)
		    ->update(['lugar' => $edicion->lugar, 'active_flag'=> 1 ,'fecha_inicio' => date('Y-m-d', strtotime($edicion->fecha_inicio)) , 'fecha_fin' => date('Y-m-d', strtotime($edicion->fecha_fin)) , 'fecha_inscripcion' => date('Y-m-d', strtotime($edicion->fecha_inscripcion)) , 'fecha_fin_inscripcion' => date('Y-m-d', strtotime($edicion->fecha_fin_inscripcion)) , 'author_id' => $userid, 'updated_at' => date('Y-m-d H:i:s') ]);
	}

	public static function showEdicion($anno)
	{
		$edicion = Edicion::where('anno', $anno)->first();
		$edicion->fecha_inicio = date('m/d/Y', strtotime($edicion->fecha_inicio));
		$edicion->fecha_fin = date('m/d/Y', strtotime($edicion->fecha_fin));
		$edicion->fecha_inscripcion = date('m/d/Y', strtotime($edicion->fecha_inscripcion));
		$edicion->fecha_fin_inscripcion = date('m/d/Y', strtotime($edicion->fecha_fin_inscripcion));
		return $edicion;
	}
}