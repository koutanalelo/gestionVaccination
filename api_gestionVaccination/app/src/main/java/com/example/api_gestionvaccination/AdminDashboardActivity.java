package com.example.api_gestionvaccination;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

public class AdminDashboardActivity extends AppCompatActivity {

    private Button btnGestionUtilisateurs;
    private Button btnGestionVaccins;
    private Button btnStatistiques;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_admin_dashboard);

        // Initialisation des composants de la vue
        btnGestionUtilisateurs = findViewById(R.id.btnGestionUtilisateurs);
        btnGestionVaccins = findViewById(R.id.btnGestionVaccins);
        btnStatistiques = findViewById(R.id.btnStatistiques);

        // Ajout d'écouteurs pour les boutons
        btnGestionUtilisateurs.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Redirection vers l'activité de gestion des utilisateurs
                Intent intent = new Intent(AdminDashboardActivity.this, ListeBebesActivity.class);
                startActivity(intent);
            }
        });

        btnGestionVaccins.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Redirection vers l'activité de gestion des vaccins
                Intent intent = new Intent(AdminDashboardActivity.this,GererVaccinationActivity .class);
                startActivity(intent);
            }
        });

        btnStatistiques.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Redirection vers l'activité affichant les statistiques
                Intent intent = new Intent(AdminDashboardActivity.this, ListeBebesActivity.class);
                startActivity(intent);
            }
        });
    }
}
