<?php

namespace sisKardex\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Ingreso
            'idcliente' =>'required',
            'tipo_comprobante' =>'required|max:20',
            'num_comprobante'=>'required|max:10',
            //Detalle_Ingreso
            'idarticulo'=>'required',
            'cantidad' =>'required',
            'totalp' => 'required'
        ];
    }
}
