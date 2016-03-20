<?php

namespace Caderneta\Http\Controllers;

use Caderneta\Repositories\MovimentacoeRepository;
use Illuminate\Http\Request;

use Caderneta\Http\Requests;


class MovimentacaoController extends Controller
{
    private $repository;

    public function __construct(MovimentacoeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimentacoes = $this->repository->paginate();

        return view('client.index', compact('movimentacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opcoes = [true => 'Débito', false => 'Crédito'];

        return view('client.create', compact('opcoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->repository->create($data);

        return redirect()->route('client.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movimento = $this->repository->find($id);
        $opcoes = [true => 'Débito', false => 'Crédito'];

        return view('client.edit', compact('movimento', 'opcoes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('client.index');
    }
}
