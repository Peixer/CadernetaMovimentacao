<?php

use Caderneta\Repositories\MovimentacoeRepositoryEloquent;
use Carbon\Carbon;
use Symfony\Component\Console\Output\ConsoleOutput;

class MovimentacoesRepositoryTest extends TestCase
{
    public function __construct()
    {
//        $this->model = $this->getMockBuilder('Caderneta\Models\Movimentacoe')->getMock();
    }

    public function test_gerando_filtro_do_relatorio()
    {
        $application = new \Illuminate\Container\Container();

        $movimentacoes = new MovimentacoeRepositoryEloquent($application);
        $request = new \Illuminate\Http\Request();

        $request['end'] = Carbon::createFromDate(2016, 9, 20)->format("d/m/Y");
        $request['start'] = Carbon::createFromDate(2016, 9, 15)->format("d/m/Y");


        Log::info("Valor do END: " . $request['end']);
        Log::info("Valor do START: " . $request['start']);

        $resultado = $movimentacoes->getReport($request, 1);

        Log::info("Valor do RESULTADO: " . implode(" ",$resultado));

        $this->assertNotNull($resultado);
        $this->assertEquals([], $resultado, "Quando filtrar por usuario que não existe deve retornar vazio");
    }
}

