<?php

use Caderneta\Repositories\MovimentacoeRepositoryEloquent;
use Carbon\Carbon;

class MovimentacoesRepositoryTest extends TestCase
{
    public function __construct()
    {
//        $this->model = $this->getMockBuilder('Caderneta\Models\Movimentacoe')->getMock();
    }

    public function test_gerando_relatorio_vazio_quando_usuario_nao_existir()
    {
        $application = new \Illuminate\Container\Container();

        $movimentacoes = new MovimentacoeRepositoryEloquent($application);
        $request = new \Illuminate\Http\Request();

        $request['start'] = Carbon::createFromDate(2016, 9, 15)->format("d/m/Y");
        $request['end'] = Carbon::createFromDate(2016, 9, 20)->format("d/m/Y");
        $request['tags'] = array();
        $userId = 99;

        $resultado = $movimentacoes->getReport($request, $userId);

        $this->assertNotNull($resultado);
        $this->assertEquals([], $resultado->toArray());
    }

    public function test_gerando_filtro_do_relatorio()
    {
        $modelFake = $this->obter_movimentacao_fake();
        $application = $this->obter_instancia_de_aplication_mockada($modelFake);

        $movimentacoes = new MovimentacoeRepositoryEloquent($application);
        $request = new \Illuminate\Http\Request();

        $request['start'] = Carbon::createFromDate(2016, 9, 15)->format("d/m/Y");
        $request['end'] = Carbon::createFromDate(2016, 9, 20)->format("d/m/Y");
        $request['tags'] = array();

        $userId = 1;

        $resultado = $movimentacoes->getReport($request, $userId);

        Log::info("test_gerando_filtro_do_relatorio - Valor do RESULTADO: " . implode(" ", $resultado));

        $this->assertNotNull($resultado);
        $this->assertEquals(array($modelFake), $resultado);
    }

    private function obter_movimentacao_fake()
    {
        return factory(\Caderneta\Models\Movimentacoe::class)->create([
            'user_id' => 1,
            'descricao' => "Teste FAKE",
            'data' => '2009-09-16'
        ]);
    }

    private function obter_instancia_de_aplication_mockada($modelFake)
    {
        $application = Mockery::mock('Illuminate\Foundation\Application');

        $model = Mockery::mock('Caderneta\Models\Movimentacoe');
        $stubQuery = \Mockery::mock('Illuminate\Database\Eloquent\Builder');
        $stubQuery2 = \Mockery::mock('Illuminate\Database\Query\Builder');

        $model->shouldReceive('where')->once()->andReturn($stubQuery);
        $stubQuery->shouldReceive('whereBetween')->once()->andReturn($stubQuery2);
        $stubQuery2->shouldReceive('get')->andReturn(array($modelFake));

        $application->shouldReceive('make')->once()->with('Caderneta\Models\Movimentacoe')->andReturn($model);

        return $application;
    }
}

