<?php

namespace App\Exports;

use App\Models\examen;
use App\Models\examenConfiguracion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class reporteResultadosExcel implements FromView
{
    protected $fechaInicio;
    protected $fechaFin;
    protected $estatus;

    public function __construct($fechaInicio, $fechaFin, $estatus)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->estatus = $estatus;
    }

    public function view() : View
    {
        $configuracion = examenConfiguracion::all()->first();
        if($this->estatus == 'Aprobados'){
            $clientes = examen::where('calificacion', '>=', $configuracion->nota_aprobada)->whereBetween('fecha_examen', [$this->fechaInicio, $this->fechaFin])->get();
        }
        else{
            $clientes = examen::where('calificacion', '<', $configuracion->nota_aprobada)->whereBetween('fecha_examen', [$this->fechaInicio, $this->fechaFin])->get();
        }
        
        return view('reportes-excel.resultados', ['clientes' => $clientes, 'estatus' => $this->estatus, 'fechaInicio' => $this->fechaInicio, 'fechaFin' => $this->fechaFin]);


        
    }


}
