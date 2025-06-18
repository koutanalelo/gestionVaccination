package com.example.api_gestionvaccination;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONObject;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

public class ProfilBebeActivity extends AppCompatActivity {
    private int id_user;
    private TextView tvNomBebe, tvPrenomBebe, tvDateNaissanceBebe, tvPoidBebe, tvTailleBebe,b;
    private Button buttonModifierProfil, buttonRetourMenu;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profil);

        this.id_user=Integer.parseInt(getIntent().getStringExtra("id_user"));

        // Initialisation des vues
        tvNomBebe = findViewById(R.id.tvNomBebe);
        tvPrenomBebe = findViewById(R.id.tvPrenomBebe);
        tvDateNaissanceBebe = findViewById(R.id.tvDateNaissanceBebe);
        tvPoidBebe = findViewById(R.id.tvPoidBebe);
        tvTailleBebe = findViewById(R.id.tvTailleBebe);
        buttonModifierProfil = findViewById(R.id.buttonModifierProfil);
        buttonRetourMenu = findViewById(R.id.buttonRetourMenu);
        b=findViewById(R.id.btnBebe);

        // Charger les données du profil du bébé
        chargerProfilBebe();

        // Bouton Modifier Profil
        buttonModifierProfil.setOnClickListener(v -> {
            Intent intent = new Intent(ProfilBebeActivity.this, ModifierProfilBebeActivity.class);
            startActivity(intent);
        });

        // Bouton Retour au Menu
        buttonRetourMenu.setOnClickListener(v -> {
            Intent intent = new Intent(ProfilBebeActivity.this, Menu.class);
            startActivity(intent);
        });

        b.setOnClickListener(v ->{
            Intent intent = new Intent(ProfilBebeActivity.this, Ajout.class);
            startActivity(intent);

        });



    }




    // Fonction pour charger le profil du bébé
    private void chargerProfilBebe() {
        // Récupérer l'id_user à partir des SharedPreferences
       // SharedPreferences sharedPreferences = getSharedPreferences("UserSession", MODE_PRIVATE);
        //int idUser = sharedPreferences.getInt("id_user", -1);  // -1 si l'utilisateur n'est pas connecté

        // Vérifier si l'id_user est valide
        if (this.id_user == -1) {
            Toast.makeText(this, "Utilisateur non connecté", Toast.LENGTH_SHORT).show();
            return;
        }

        // URL de l'API pour récupérer les informations du bébé
        String url = "http://192.168.189.1/gestionvaccin/profil_bebe.php";  // Changez l'IP si nécessaire

        // Créer un objet JSON pour envoyer l'id_user à l'API
        JSONObject params = new JSONObject();
        try {
            Log.e("id user :", id_user+"");
            params.put("id_user", id_user);  // Envoi de l'id_user pour lier le profil du bébé
        } catch (Exception e) {
            e.printStackTrace();
        }

        // Requête API pour obtenir les informations du bébé
        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest(
                Request.Method.POST,
                url,
                params,
                response -> {
                    try {
                        // Vérifier si la réponse contient les données du bébé
                        if (response.has("bebes")) {
                            JSONObject bebe = response.getJSONArray("bebes").getJSONObject(0);

                            String nom = bebe.getString("nom");
                            String prenom = bebe.getString("prenom");
                            String dateNaissance = bebe.getString("date_naissance");
                            String poid = bebe.getString("poid");
                            String taille = bebe.getString("taille");

                            // Mettre à jour l'interface avec les informations du bébé
                            tvNomBebe.setText("Nom : " + nom);
                            tvPrenomBebe.setText("Prénom : " + prenom);
                            tvDateNaissanceBebe.setText("Date de naissance : " + formatDate(dateNaissance));
                            tvPoidBebe.setText("Poids : " + poid);
                            tvTailleBebe.setText("Taille : " + taille);
                        } else if (response.has("error")) {
                            Toast.makeText(this, response.getString("error"), Toast.LENGTH_SHORT).show();
                        }
                    } catch (Exception e) {
                        e.printStackTrace();
                        Toast.makeText(this, "Erreur lors de l’analyse des données", Toast.LENGTH_SHORT).show();
                    }
                },
                error -> {
                    if (error.networkResponse != null) {
                        int statusCode = error.networkResponse.statusCode;
                        Toast.makeText(this, "Erreur réseau : " + statusCode, Toast.LENGTH_SHORT).show();
                    } else {
                        Toast.makeText(this, "Erreur réseau inconnue", Toast.LENGTH_SHORT).show();
                    }
                }
        );

        // Ajouter la requête à la file d'attente Volley
        Volley.newRequestQueue(this).add(jsonObjectRequest);
    }

    // Fonction pour formater la date
    private String formatDate(String dateNaissance) {
        try {
            SimpleDateFormat originalFormat = new SimpleDateFormat("yyyy-MM-dd", Locale.getDefault());
            SimpleDateFormat newFormat = new SimpleDateFormat("dd/MM/yyyy", Locale.getDefault());
            Date date = originalFormat.parse(dateNaissance);
            return newFormat.format(date);
        } catch (ParseException e) {
            e.printStackTrace();
            return dateNaissance;  // Retourne la date brute si le formatage échoue
        }
    }
}
