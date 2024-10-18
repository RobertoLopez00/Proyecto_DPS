<?php

namespace App\Exports;

use App\Models\detalleGasto;
use App\Models\detalleIngreso;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class flujoEfectivoExcel implements FromView
{
    protected $fecha;

    public function __construct($fecha)
    {
        $this->fecha = $fecha;
       
    }
    
    public function view(): View
    {
        $saldoInicial = detalleIngreso::whereMonth('fecha', date('m', strtotime('-1 month', strtotime($this->fecha))))
        ->whereYear('fecha', date('Y', strtotime('-1 month', strtotime('-1 month', strtotime($this->fecha)))))
        ->sum('total') - detalleGasto::whereMonth('fecha', date('m', strtotime('-1 month', strtotime($this->fecha))))
        ->whereYear('fecha', date('Y', strtotime('-1 month', strtotime($this->fecha))))->sum('total');

        $totalI =  detalleIngreso::whereMonth('fecha', date('m', strtotime($this->fecha)))
            ->whereYear('fecha', date('Y', strtotime($this->fecha)))
            ->sum('total');
        $totalG = detalleGasto::whereMonth('fecha', date('m', strtotime($this->fecha)))
            ->whereYear('fecha', date('Y', strtotime($this->fecha)))->sum('total');

            //return $registrosI;
            $diarios = []; // Array para almacenar los resultados

            // Obtener el número de días del mes
            $diasDelMes = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($this->fecha)), date('Y', strtotime($this->fecha)));
            
            $acumulado = 0;
            // Iterar sobre cada día del mes
            for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                // Sumatoria de registrosI para el día

                $sumaI =  detalleIngreso::where('fecha', $this->fecha.'-'.$dia)->sum('total');
                // Sumatoria de registrosG para el día
                $sumaG = detalleGasto::where('fecha', $this->fecha.'-'.$dia)->sum('total');
                
                // Calcular la diferencia
                $diferencia = $sumaI - $sumaG;
                $acumulado = $acumulado + $diferencia;
                // Almacenar los resultados en el array diario
                $diarios[$dia] = [
                    'fecha' => $this->fecha.'-'.str_pad($dia, 2, '0', STR_PAD_LEFT),
                    'sumaI' => $sumaI,
                    'sumaG' => $sumaG,
                    'acumulado' => $acumulado
                ];
            }
            
        


        return view('reportes-excel.flujo-efectivo', ['diarios' => $diarios, 'fecha' => $this->fecha, 'totalI' => $totalI, 'totalG' => $totalG, 'saldoInicial' => $saldoInicial]);
    }
}
