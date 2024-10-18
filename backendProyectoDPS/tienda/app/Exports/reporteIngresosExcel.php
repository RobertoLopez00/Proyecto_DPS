<?php

namespace App\Exports;

use App\Models\detalleIngreso;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class reporteIngresosExcel implements FromView
{
    protected $fechaInicio;
    protected $fechaFin;

    public function __construct($fechaInicio, $fechaFin)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }
    

    public function view(): View
    {
        setlocale(LC_ALL, 'es_ES');
       

        $detalles = detalleIngreso::whereBetween('fecha', [$this->fechaInicio, $this->fechaFin])->get();

        return view('reportes-excel.ingresos', ['detalles' => $detalles,  'fechaInicio' => $this->fechaInicio, 'fechaFin' => $this->fechaFin]);
       
    }
}
