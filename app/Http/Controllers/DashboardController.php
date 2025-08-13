<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Avancement;
use App\Models\Inspecteur;
use App\Models\MissionEnCours;
use App\Models\rapports;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class DashboardController extends Controller

{








    public function dashboardInspecteur()
{
    $inspecteur = Auth::guard('inspecteur')->user();
    $missions = MissionEnCours::where('utilisateurs', $inspecteur->email)->get();
    return view('dashboardinspecteurnouvelle', compact('missions'));
}



    public function dashboard()
    {
        $notifications = Notification::latest()->take(5)->get();

        return view('dashboard', compact('notifications'));
    }


    public function search(Request $request)
    {
        $date = $request->input('date');

        $rapports = Rapports::whereDate('date', $date)->get();

        return view('laravel-examples.user-management', compact('rapports'));
    }


    public function incrementJours($id)
    {
        $mission = MissionEnCours::findOrFail($id);
        if ($mission->jours < $mission->duree) {
            $mission->jours += 1;
            $mission->save();
        }

        return back()->with('success', 'Jour de mission ajouté avec succès.');
    }



    public function directeurDashboard()
    {
        // 1. Fetch Absence Data
        // Get all records from the 'absence' table.
        $absenceData = Absence::all();
        // Extract 'pourcentage' values into an array for the chart series.
        $absencePourcentages = $absenceData->pluck('pourcentage')->toArray();
        // Extract 'jours' values into an array for the chart labels.
        $absenceJours = $absenceData->pluck('jours')->toArray();

        // 2. Fetch Avancement Data
        // Get all records from the 'avancement' table.
        $avancementData = Avancement::all();
        // Extract 'pourcentage' values into an array for the chart series.
        $avancementPourcentages = $avancementData->pluck('pourcentage')->toArray();
        // Extract 'jours' values into an array for the chart labels.
        $avancementJours = $avancementData->pluck('jours')->toArray();

        // 3. Fetch Missions Data

        $missionsData = MissionEnCours::all();

        $missionsCountByDate = $missionsData->groupBy(function ($item) {

            return Carbon::parse($item->date)->format('Y-m-d');
        })->map->count();

        // Extract the formatted dates for the chart's X-axis labels.
        $missionDates = $missionsCountByDate->keys()->map(function ($date) {
            return Carbon::parse($date)->format('d M Y'); // Format for display on chart
        })->toArray();
        // Extract the counts of missions for the chart's Y-axis series.
        $missionCounts = $missionsCountByDate->values()->toArray();

        // Pass all prepared data to the Blade view.
        // Using 'dashboarddirecteur' to match your file path: resources/views/dashboarddirecteur.blade.php
        return view('dashboarddirecteur', compact(
            'absencePourcentages',
            'absenceJours',
            'avancementPourcentages',
            'avancementJours',
            'missionsData', // Pass the raw missions data for the list display
            'missionDates',
            'missionCounts'
        ));
    }

    public function userManagement()
    {
        $missions = \App\Models\MissionEnCours::all();
        return view('laravel-examples.user-profile', compact('missions'));
    }
    public function rapports()
    {
        $rapports = \App\Models\rapports::all();
        return view('laravel-examples.user-management', compact('rapports'));
    }


    public function index()
    {
        $missions = MissionEnCours::all();
         return view('laravel-examples.user-profile', compact('missions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'missions' => 'required|string',
            'client' => 'required|string',
            'lieu' => 'required|string',
            'utilisateurs' => 'required|string',
            'status' => 'required|string',
            'datedebut' => 'required|date',
            'datefin' => 'nullable|date',
            'duree' => 'nullable|string',
        ]);

        MissionEnCours::create($request->all());

        return redirect()->back()->with('success', 'Mission ajoutée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'missions' => 'required|string',
            'client' => 'required|string',
            'lieu' => 'required|string',
            'utilisateurs' => 'required|string',
            'status' => 'required|string',
            'datedebut' => 'required|date',
            'datefin' => 'nullable|date',
            'duree' => 'nullable|string',
        ]);

        $mission = MissionEnCours::findOrFail($id);
        $mission->update($request->all());

        return redirect()->back()->with('success', 'Mission mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $mission = MissionEnCours::findOrFail($id);
        $mission->delete();

        return redirect()->back()->with('success', 'Mission supprimée avec succès.');
    }




    public function coordinateurDashboard()
    {
        $missions = MissionEnCours::all();
        return view('dashboardcoordinateur', compact('missions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function storeinspecteur(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'mission' => 'required|string',
            'mail' => 'required|email',
            'motpasse' => 'required|string|min:6',
        ]);

        DB::table('inspecteur')->insert([
            'nom' => $validated['nom'],
            'mission' => $validated['mission'],
            'mail' => $validated['mail'],
            'motpasse' => bcrypt($validated['motpasse']),
        ]);

        return redirect()->back()->with('success', 'Inspecteur ajouté');
    }

    public function updateinspecteur(Request $request, $id)
    {
        $data = $request->only(['nom', 'mission', 'mail']);
        if ($request->filled('motpasse')) {
            $data['motpasse'] = bcrypt($request->motpasse);
        }

        DB::table('inspecteur')->where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Inspecteur modifié');
    }

    public function destroyinspecteur($id)
    {
        DB::table('inspecteur')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Inspecteur supprimé');
    }


    public function showInspecteurs()
    {
        $inspecteurs = Inspecteur::all();
        return view('inspecteurs', compact('inspecteurs'));
    }



    public function inspecteurAvancement()
{
    $inspecteur = Auth::guard('inspecteur')->user();
    $missions = MissionEnCours::where('utilisateurs', $inspecteur->email)->get();
    return view('dashboardinspecteuravancement', compact('missions'));
}



    public function downloadRapport($id)
{
    $mission = MissionEnCours::findOrFail($id);

    $pdf = Pdf::loadView('rapport.mission', compact('mission'));

    return $pdf->download('rapport_mission_'.$mission->id.'.pdf');
}

    public function showMissionDetails($id)
    {
        $mission = MissionEnCours::findOrFail($id);
        return view('missions.details', compact('mission'));
    }





    public function refuser($id)
    {
        $mission = MissionEnCours::findOrFail($id);
        $mission->accepte = 'refuse';
        $mission->status = 'libre';
        $mission->save();

        return redirect()->back()->with('success', 'Mission refusée.');
    }
    public function accepter($id)
    {
        $mission = MissionEnCours::findOrFail($id);
        $mission->accepte = 'accepte';
        $mission->status = 'en mission';
        $mission->save();

        return redirect()->back()->with('success', 'Mission acceptée avec succès.');
    }
}
