<?php

namespace App\Http\Controllers\Api\V1;;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CarrinhoRepositoryInterface;

class CarrinhoController extends Controller
{

    protected $carrinho;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(CarrinhoRepositoryInterface $carrinho)
    {
        $this->carrinho = $carrinho;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = $this->carrinho->all();
        $data = ['data' => $res, 'total' => count($res), 'code'=>200];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = null)
    {
        $res = $this->carrinho->insert($request->all(), $id);
        $data = [];

        if ($res) {
            $data = ['code' => 200];
            $data['data'] = $res;
            return response()->json($res, 200);
        }

        $data['message'] = 'Produto já existe no carrinho';
        $data['code'] = 400;
        return response()->json($data, 400);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = $this->carrinho->get($id);
        $data = ['data' => $res, 'code' => 200];
        return response()->json($data, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $res = $this->carrinho->update($id, $request->all());

        if ($res) {
            $data = ['data' => $res, 'code' => 200];
            return response()->json($data, 200);
        }

        $data['message'] = 'Produto ou Carrinho não encontrado';
        $data['code'] = 400;
        return response()->json($data, 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $res = $this->carrinho->delete($id, $request->all());
        $data = [];
        if ($res) {
            $data = ['message' => 'Produto removido com sucesso', 'code' => 200];
        } else {
            $data = ['message' => 'Houve problema ao remover produto', 'code' => 400];
        }

        return response()->json($data, $data['code']);
    }
}
