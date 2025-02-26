<?php

namespace App\Http\Controllers;
use App\Models\DemandeAmitie;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return view('navigation-menu'); // Afficher la page sans résultats
        }

        $users = User::whereRaw("LOWER(name) LIKE LOWER(?)", ["%$query%"])
            ->orWhereRaw("LOWER(email) LIKE LOWER(?)", ["%$query%"])
            ->orWhereRaw("LOWER(prenom) LIKE LOWER(?)", ["%$query%"])
            ->orWhereRaw("LOWER(pseudo) LIKE LOWER(?)", ["%$query%"])
            ->get(['id', 'name', 'email']);

        return view('navigation-menu', compact('users'));
    }



    public function envoyerDemandeAmitie($utilisateur_recepteur_id)
    {
        $utilisateur_demandeur = auth()->user();
        if (DemandeAmitie::where('utilisateur_demandeur_id', $utilisateur_demandeur->id)
            ->where('utilisateur_recepteur_id', $utilisateur_recepteur_id)
            ->exists()) {
            return view('dashboard', [
                'message' =>  'Demande déjà envoyée.'
            ]);
        }
        $demande = new DemandeAmitie();
        $demande->utilisateur_demandeur_id = $utilisateur_demandeur->id;
        $demande->utilisateur_recepteur_id = $utilisateur_recepteur_id;
        $demande->envoyer();
        return view('dashboard', [
            'message' =>  'Demande envoyée avec succès.'
        ]);
    }






}
