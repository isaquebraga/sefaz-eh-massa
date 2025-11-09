<?php

namespace App\Http\Controllers;

use App\Models\Imposto;
use Illuminate\Http\Request;

class ImpostoController extends Controller
{
    public function index()
    {
        return response()->json(Imposto::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sigla' => 'required|string|max:10',
            'nome_completo' => 'required|string|max:255',
            'icone' => 'required|string|max:50',
            'descricao' => 'required|string',
            'finalidade' => 'required|string',
            'curiosidades' => 'nullable|string',
        ]);

        $imposto = Imposto::create([
            'sigla' => $validated['sigla'],
            'nome_completo' => $validated['nome_completo'],
            'icone' => $validated['icone'],
            'descricao' => $validated['descricao'],
            'finalidade' => $validated['finalidade'],
            'curiosidades' => $validated['curiosidades'],
        ]);

        return response()->json($imposto, 201);
    }

    public function show(Imposto $imposto)
    {
        return response()->json($imposto);
    }

    public function update(Request $request, $id)
    {
        $imposto = Imposto::findOrFail($id);

        $validated = $request->validate([
            'sigla' => 'required|string|max:10',
            'nome_completo' => 'required|string|max:255',
            'icone' => 'required|string|max:50',
            'descricao' => 'required|string',
            'finalidade' => 'required|string',
            'curiosidades' => 'nullable|string',
        ]);

        $imposto->update([
            'sigla' => $validated['sigla'],
            'nome_completo' => $validated['nome_completo'],
            'icone' => $validated['icone'],
            'descricao' => $validated['descricao'],
            'finalidade' => $validated['finalidade'],
            'curiosidades' => $validated['curiosidades'],
        ]);

        return response()->json($imposto);
    }

    public function destroy($id)
    {
        $imposto = Imposto::find($id);
        $imposto->delete();

        return response()->json(['message' => 'Imposto excluído com sucesso']);
    }
}
