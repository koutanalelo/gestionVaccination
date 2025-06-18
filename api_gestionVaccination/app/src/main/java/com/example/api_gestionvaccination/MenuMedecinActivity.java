package com.example.api_gestionvaccination;


import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

public class MenuMedecinActivity extends AppCompatActivity {

    private Button btnListeBebes, btnGererVaccination, btnVoirRapports, btnDeconnexion;
    private int id_medecin, id_user;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu_medecin);

        // Récupération des données passées depuis MainActivity
        id_medecin = getIntent().getIntExtra("id_medecin", -1);
        id_user = getIntent().getIntExtra("id_user", -1);

        // Initialisation des boutons
        btnListeBebes = findViewById(R.id.btnListeBebes);
        btnGererVaccination = findViewById(R.id.btnGererVaccination);
        btnVoirRapports = findViewById(R.id.btnVoirRapports);
        btnDeconnexion = findViewById(R.id.btnDeconnexion);

        // Actions des boutons
        btnListeBebes.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Ouvrir l'activité qui liste les bébés
                Intent intent = new Intent(MenuMedecinActivity.this, ListeBebesActivity.class);
                intent.putExtra("id_medecin", id_medecin); // Passer l'id du médecin pour la gestion des bébés
                startActivity(intent);
            }
        });

        btnGererVaccination.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Ouvrir l'activité pour gérer les vaccinations
                Intent intent = new Intent(MenuMedecinActivity.this, GererVaccinationActivity.class);
                intent.putExtra("id_medecin", id_medecin); // Passer l'id du médecin pour gérer les vaccinations
                startActivity(intent);
            }
        });

        btnVoirRapports.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Afficher un message ou une nouvelle activité pour afficher les rapports
                Toast.makeText(MenuMedecinActivity.this, "Afficher les rapports", Toast.LENGTH_SHORT).show();
                // TODO: Ajouter une activité pour afficher les rapports
            }
        });

        btnDeconnexion.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Retour à l'écran de connexion
                Intent intent = new Intent(MenuMedecinActivity.this, MainActivity.class);
                startActivity(intent);
                finish(); // Fermer cette activité pour éviter que l'utilisateur puisse revenir en arrière
            }
        });
    }
}
