<?php

namespace App\Exports;

use App\Models\detalleGasto;
use App\Models\detalleIngreso;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class reporteDiarioExcel implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $fechaInicio;
    protected $fechaFin;

    public function __construct($fechaInicio, $fechaFin)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }



    public function view(): View
    {
        $detalles = detalleGasto::whereBetween('fecha', [$this->fechaInicio, $this->fechaFin])->get();

        $totalI = detalleIngreso::whereBetween('fecha', [$this->fechaInicio, $this->fechaFin])->sum('total');
        $totalG = detalleGasto::whereBetween('fecha', [$this->fechaInicio, $this->fechaFin])->sum('total');
        $ingresos = detalleIngreso::whereBetween('fecha', [$this->fechaInicio, $this->fechaFin])->get();

        return view('reporte-diario.reporteExcel', ['ingresos' => $ingresos, 'detalles' => $detalles, 'fechaInicio' => $this->fechaInicio, 'fechaFin' => $this->fechaFin, 'totalG' => $totalG,  'totalI' => $totalI]);
    }
}
