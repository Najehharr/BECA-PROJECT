<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Models\Conge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\CongeDemandeMail;
use Carbon\Carbon;
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
        'duree_conge' => 'required|integer|min:1',
        'date_debut' => 'required|date',
    ]);

    // Get the currently logged-in inspecteur
    $inspecteur = Auth::guard('inspecteur')->user();

    // Prepare the data
    $data = [
        'nom_inspecteur' => $inspecteur->nom,
        'matricule' => $inspecteur->matricule ?? 'N/A',
        'duree_conge' => $validated['duree_conge'],
        'date_debut' => $validated['date_debut'],
        'statut' => 'En attente',
        'created_at' => now(),
        'updated_at' => now(),
    ];

    // 1. Insert into database
    DB::table('conges')->insert($data);

    // 2. Send email to directeur
    Mail::to(env('DIRECTEUR_EMAIL', 'manelbenfarah01@gmail.com'))
        ->send(new CongeDemandeMail($data));

    return redirect()->back()->with('success', 'La demande a été envoyée au directeur.');
}
}