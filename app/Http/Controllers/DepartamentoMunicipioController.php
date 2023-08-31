<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoMunicipioController extends ApiController
{
    /**
     * Display a listing related municipios
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Departamento $departamento)
    {
        $name_municipio = $request->query('name_municipio');
        
        if(!is_null($name_municipio)){

            $departamentos = $departamento->municipios()->whereRaw("lower(unaccent(name)) ilike '%$name_municipio%'")
                                            ->orderBy('name')
                                            ->limit(10)
                                            ->get();

            return $this->showAll($departamentos);
        }

        $departamentos = $departamento->municipios()
                          ->get()
                          ->sortBy('name')
                          ->values();
                         /*  ->pluck('buyer')
                           ->sortBy('name')
                          ->unique('id')
                          ->values(); */

        return $this->showAll($departamentos);
    }
}
