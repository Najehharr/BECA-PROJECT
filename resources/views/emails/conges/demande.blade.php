@component('mail::message')
# Nouvelle demande de congé

**Inspecteur :** {{ $nom_inspecteur }}  
**Durée :** {{ $duree_conge }} jour(s)  
**Date de début :** {{ \Carbon\Carbon::parse($date_debut)->format('d/m/Y') }}  


Merci,  

@endcomponent
