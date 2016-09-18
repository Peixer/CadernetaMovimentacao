<?php

use Caderneta\Repositories\MovimentacoeRepositoryEloquent;

class MovimentacoesRepositoryTest extends TestCase
{
    public function test_gerando_relatorio_vazio_quando_usuario_nao_existir()
    {
        $application = App::make('Illuminate\Foundation\Application');
        $movimentacoes = new MovimentacoeRepositoryEloquent($application);

        $request = $this->obter_request('15/09/2016', '20/09/2016');
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

        $request = $this->obter_request('15/09/2016', '20/09/2016');
        $userId = 1;

        $resultado = $movimentacoes->getReport($request, $userId);

        $this->assertNotNull($resultado);
        $this->assertEquals(array($modelFake), $resultado);
    }

    private function obter_request($dataInicio, $dataFim, $tags = array())
    {
        $request = new \Illuminate\Http\Request();

        $request['start'] = $dataInicio;
        $request['end'] = $dataFim;
        $request['tags'] = $tags;

        return $request;
    }

    private function obter_movimentacao_fake()
    {
        return factory(\Caderneta\Models\Movimentacoe::class)->create([
            'user_id' => 1,
            'descricao' => "Teste FAKE",
            'data' => '2009-09-16'
        ]);
    }

    private function obter_instancia_de_aplication_mockada($modelEsperado)
    {
        $application = Mockery::mock('Illuminate\Foundation\Application');

        $model = Mockery::mock('Caderneta\Models\Movimentacoe');
        $modelPresenter = Mockery::mock('Caderneta\Presenters\MovimentacaoPresenter');
        $stubQuery = \Mockery::mock('Illuminate\Database\Eloquent\Builder');
        $stubQuery2 = \Mockery::mock('Illuminate\Database\Query\Builder');

        $model->shouldReceive('where')->once()->andReturn($stubQuery);
        $stubQuery->shouldReceive('whereBetween')->once()->andReturn($stubQuery2);
        $stubQuery2->shouldReceive('get')->andReturn(array($modelEsperado));

        $application->shouldReceive('make')->once()->with('Caderneta\Models\Movimentacoe')->andReturn($model);
        $application->shouldReceive('make')->once()->with('Caderneta\Presenters\MovimentacaoPresenter')->andReturn($modelPresenter);

        return $application;
    }
}

