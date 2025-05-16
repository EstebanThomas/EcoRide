<h2>Bonjour {{ $utilisateur->pseudo }},</h2>

<p>Nous vous informons que le covoiturage prévu de <strong>{{ $voyage->lieu_depart }}</strong> à <strong>{{ $voyage->lieu_arrivee }}</strong> le <strong>{{ \Carbon\Carbon::parse($voyage->date_depart)->format('d/m/Y') }}</strong> a été annulé.</p>

<p>Vous avez été remboursé de {{ $voyage->prix_personne }} crédits.</p>

<p>Merci de votre compréhension,
EcoRide.</p>