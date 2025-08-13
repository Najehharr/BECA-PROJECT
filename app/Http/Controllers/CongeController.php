<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CongeController extends Controller
{


    public function index()
    {
        $conges = Conge::paginate(10);
        return view('directeur.conges', compact('conges'));
    }

    public function create()
{
    $inspecteur = Auth::guard('inspecteur')->user(); // get logged-in inspecteur
    return view('conge', compact('inspecteur'));
}


    public function showTables()
    {

        $conges = Conge::paginate(10);
        return view('tables', compact('conges'));
    }
   public function updateStatus(Request $request, $id)
{
    $allowedStatuses = ['En attente', 'Approuvé', 'Refusé'];
    if (!in_array($request->statut, $allowedStatuses)) {
        return $request->ajax()
            ? response()->json(['success' => false, 'message' => 'Valeur de statut invalide.'], 400)
            : back()->withErrors(['statut' => 'Valeur de statut invalide.']);
    }

    $conge = Conge::findOrFail($id);
    $conge->statut = $request->statut;
    $conge->save();

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => "Statut du congé mis à jour en '{$request->statut}'."
        ]);
    }

    return back()->with('success', "");
}




    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_inspecteur' => 'required|string|max:100',
            'matricule' => 'required|string|max:50',
            'duree_conge' => 'required|integer|min:1',
            'date_debut' => 'required|date',
        ]);

        DB::table('congé')->insert([
            'nom_inspecteur' => $validated['nom_inspecteur'],
            'matricule' => $validated['matricule'],
            'duree_conge' => $validated['duree_conge'],
            'date_debut' => $validated['date_debut'],
            'statut' => 'En attente',
        ]);

        return redirect()->back()->with('success', 'La demande a été envoyée.');
    }
}
