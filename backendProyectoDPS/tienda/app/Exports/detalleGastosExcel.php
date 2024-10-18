<?php

namespace App\Exports;

use App\Models\detalleGasto;
use App\Models\gasto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class detalleGastosExcel implements FromView
{
    protected $fecha;
    public function __construct($fecha) {
        $this->fecha = $fecha;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $diarios = [];



        $diasDelMes = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($this->fecha)), date('Y', strtotime($this->fecha)));

        $gastos = gasto::all();
        foreach ($gastos as $gasto) {

            for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                // Sumatoria de registrosI para el día


                // Sumatoria de registrosG para el día
                $total = detalleGasto::where('id_tipo', $gasto->id)->where('fecha', $this->fecha . '-' . $dia)->sum('total');

                // Calcular la diferencia


                // Almacenar los resultados en el array diario
                $diarios[$gasto->id][$dia] = [
                    'fecha' => $this->fecha . '-' . str_pad($dia, 2, '0', STR_PAD_LEFT),

                    'total' => $total,

                ];
            }
        }




        return view('reportes-excel.detalle-gastos', ['gastos' => $gastos, 'diarios' => $diarios, 'fecha' => $this->fecha]);
    }
}
