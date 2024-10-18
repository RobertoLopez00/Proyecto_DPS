<?php

namespace App\Exports;

use App\Models\detalleGasto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class reporteGastosExcel implements FromView
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
        

        $detalles = detalleGasto::whereBetween('fecha', [$this->fechaInicio, $this->fechaFin])->get();


        return view('reportes-excel.gastos', ['detalles' => $detalles, 'fechaInicio' => $this->fechaInicio, 'fechaFin' => $this->fechaFin]);
    }
}
