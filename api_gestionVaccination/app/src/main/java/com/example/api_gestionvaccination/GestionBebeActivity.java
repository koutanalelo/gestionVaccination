package com.example.api_gestionvaccination;


import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

public class GestionBebeActivity extends AppCompatActivity {

    private Button btnAjouterBebe;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add);

        btnAjouterBebe = findViewById(R.id.idValider);

        // Ajouter la logique pour l'ajout d'un bébé
        btnAjouterBebe.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Ouvrir l'écran pour ajouter un bébé
                Intent intent = new Intent(GestionBebeActivity.this, Ajout.class);
                startActivity(intent);
            }
        });
    }
}
