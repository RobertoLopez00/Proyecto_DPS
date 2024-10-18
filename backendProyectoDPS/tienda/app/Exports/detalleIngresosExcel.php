<?php

namespace App\Exports;

use App\Models\detalleIngreso;
use App\Models\escuela;
use App\Models\ingreso;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class detalleIngresosExcel implements FromView
{
    protected $fecha;
    protected $escuela;
    public function __construct($fecha, $escuela) {
        $this->fecha = $fecha;
        $this->escuela = $escuela;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        
        $escuelaF = escuela::find($this->escuela);

        $escuelas = escuela::all();



        $diasDelMes = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($this->fecha)), date('Y', strtotime($this->fecha)));


        $ingresos = ingreso::all();
        foreach ($ingresos as $ingreso) {

            for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                // Sumatoria de registrosI para el día


                // Sumatoria de registrosG para el día

                if (isset($this->escuela) && $this->escuela != 'Todas') {
                    $total = detalleIngreso::where('id_procedencia', $this->escuela)->where('id_ingreso', $ingreso->id)->where('fecha', $this->fecha . '-' . $dia)->sum('total');
                    $cantidad = detalleingreso::where('id_procedencia', $this->escuela)->where('id_ingreso', $ingreso->id)->where('fecha', $this->fecha . '-' . $dia)->count();
                } else {
                    $total = detalleingreso::where('id_ingreso', $ingreso->id)->where('fecha', $this->fecha . '-' . $dia)->sum('total');
                    $cantidad = detalleingreso::where('id_ingreso', $ingreso->id)->where('fecha', $this->fecha . '-' . $dia)->count();
                }
                // Calcular la diferencia


                // Almacenar los resultados en el array diario
                $diarios[$ingreso->id][$dia] = [
                    'fecha' => $this->fecha . '-' . str_pad($dia, 2, '0', STR_PAD_LEFT),
                    'cantidad' => $cantidad,
                    'total' => $total,

                ];
            }
        }

        



        return view('reportes-excel.detalle-ingresos', ['ingresos' => $ingresos, 'diarios' => $diarios, 'fecha' => $this->fecha, 'escuelas' => $escuelas, 'escuelaF' => $escuelaF]);
    }
}
