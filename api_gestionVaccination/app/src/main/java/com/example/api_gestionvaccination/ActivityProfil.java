package com.example.api_gestionvaccination;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import androidx.appcompat.app.AppCompatActivity;

public class ActivityProfil extends AppCompatActivity {

    private TextView tvNomBebe, tvPrenomBebe, tvDateNaissanceBebe, tvPoidBebe, tvTailleBebe;
    private Button buttonModifierProfil;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profil);  // Assure-toi que tu as bien ce layout pour le profil

        // Récupérer les éléments de la page de profil
        tvNomBebe = findViewById(R.id.tvNomBebe);
        tvPrenomBebe = findViewById(R.id.tvPrenomBebe);
        tvDateNaissanceBebe = findViewById(R.id.tvDateNaissanceBebe);
        tvPoidBebe = findViewById(R.id.tvPoidBebe);
        tvTailleBebe = findViewById(R.id.tvTailleBebe);

        buttonModifierProfil = findViewById(R.id.buttonModifierProfil);

        // Supposons que tu récupères les données du bébé depuis l'API ou la base de données, et que tu les affiches ici
        // Exemple avec un ID fictif de bébé
        int idBebe = getIntent().getIntExtra("id_bebe", -1);
        chargerProfilBebe(idBebe);

        // Écouter le bouton "Modifier Profil"
        buttonModifierProfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Ouvrir la page de modification du profil du bébé
                Intent intent = new Intent(ActivityProfil.this, com.example.api_gestionvaccination.ModifierProfilBebeActivity.class);
                intent.putExtra("id_bebe", idBebe);  // Envoyer l'ID du bébé à la page de modification
                startActivity(intent);
            }
        });
    }

    // Cette méthode charge le profil du bébé (ici, un exemple simple)
    private void chargerProfilBebe(int idBebe) {
        // Code pour charger les données à partir de l'API ou de la base de données
        // Utilisation fictive des données pour l'exemple
        tvNomBebe.setText("Nom: Jean");
        tvPrenomBebe.setText("Prénom: Dupont");
        tvDateNaissanceBebe.setText("Date de Naissance: 2022-01-01");
        tvPoidBebe.setText("Poids: 3.5 kg");
        tvTailleBebe.setText("Taille: 50 cm");
    }
}
