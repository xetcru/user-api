<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use Illuminate\Http\Request;

class PartnershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    // Получить список всех компаний (клиентов)
    public function index()
    {
        $partnerships = Partnership::all();
        return response()->json($partnerships, 200);
    }

    // Получить данные конкретной компании (клиента)
    public function show($id)
    {
        $partnership = Partnership::find($id);
        
        if (!$partnership) {
            return response()->json(['error' => 'Partnership not found'], 404);
        }

        return response()->json($partnership, 200);
    }

    // Создать новую компанию (клиента)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $partnership = Partnership::create([
            'name' => $request->name,
        ]);

        return response()->json($partnership, 201);
    }

    // Обновить данные компании (клиента)
    public function update(Request $request, $id)
    {
        $partnership = Partnership::find($id);

        if (!$partnership) {
            return response()->json(['error' => 'Partnership not found'], 404);
        }

        $partnership->update([
            'name' => $request->name,
        ]);

        return response()->json($partnership, 200);
    }

    // Удалить компанию (клиента)
    public function destroy($id)
    {
        $partnership = Partnership::find($id);

        if (!$partnership) {
            return response()->json(['error' => 'Partnership not found'], 404);
        }

        $partnership->delete();
        return response()->json(['message' => 'Partnership deleted'], 200);
    }
}
