package com.example.api_gestionvaccination;


import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;

public class GererVaccinationActivity extends AppCompatActivity {

    private EditText editTextVaccin, editTextDescription, editTextAgeRecommande, editTextDateVaccin;
    private Spinner spinnerBebe;
    private Button btnAjouterVaccin;
    private int id_medecin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_gerer_vaccination);

        // Récupérer l'id du médecin depuis l'intention
        id_medecin = getIntent().getIntExtra("id_medecin", -1);

        // Liaison des éléments de l'interface
        editTextVaccin = findViewById(R.id.editTextVaccin);
        editTextDescription = findViewById(R.id.editTextDescription);
        editTextAgeRecommande = findViewById(R.id.editTextAgeRecommande);
        editTextDateVaccin = findViewById(R.id.editTextDateVaccin);
        spinnerBebe = findViewById(R.id.spinnerBebe);
        btnAjouterVaccin = findViewById(R.id.btnAjouterVaccin);

        // Lorsque le bouton Ajouter est cliqué
        btnAjouterVaccin.setOnClickListener(v -> {
            String vaccin = editTextVaccin.getText().toString().trim();
            String description = editTextDescription.getText().toString().trim();
            String ageRecommandeStr = editTextAgeRecommande.getText().toString().trim();
            String dateVaccin = editTextDateVaccin.getText().toString().trim();
            int bebeId = (int) spinnerBebe.getSelectedItemId();

            if (!vaccin.isEmpty() && !description.isEmpty() && !ageRecommandeStr.isEmpty() && !dateVaccin.isEmpty()) {
                try {
                    int ageRecommande = Integer.parseInt(ageRecommandeStr);

                    // Lancer une tâche asynchrone pour ajouter un vaccin
                    new AjouterVaccinTask().execute(id_medecin, bebeId, vaccin, description, ageRecommande, dateVaccin);
                } catch (NumberFormatException e) {
                    Toast.makeText(GererVaccinationActivity.this, "Age recommandé invalide", Toast.LENGTH_SHORT).show();
                }
            } else {
                Toast.makeText(GererVaccinationActivity.this, "Veuillez remplir tous les champs", Toast.LENGTH_SHORT).show();
            }
        });

        // Charger les bébés associés au médecin dans le Spinner
        new GetBebesTask().execute(id_medecin);
    }

    // Classe AsyncTask pour ajouter un vaccin
    private class AjouterVaccinTask extends AsyncTask<Object, Void, Boolean> {
        @Override
        protected Boolean doInBackground(Object... params) {
            int id_medecin = (int) params[0];
            int id_bebe = (int) params[1];
            String vaccin = (String) params[2];
            String description = (String) params[3];
            int ageRecommande = (int) params[4];
            String dateVaccin = (String) params[5];

            String urlStr = "http://192.168.189.1/gestionvaccin/vue/vaccin/vue_ajouter_vaccin.php";

            try {
                URL url = new URL(urlStr);
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                conn.setRequestMethod("POST");
                conn.setDoOutput(true);
                conn.setConnectTimeout(10000);
                conn.connect();

                // Envoyer les paramètres en POST
                OutputStreamWriter writer = new OutputStreamWriter(conn.getOutputStream());
                writer.write("id_medecin=" + id_medecin +
                        "&id_bebe=" + id_bebe +
                        "&nom=" + vaccin +
                        "&description=" + description +
                        "&age_recommande=" + ageRecommande +
                        "&date_renouvellement=" + dateVaccin);
                writer.flush();
                writer.close();

                // Lire la réponse
                BufferedReader reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
                StringBuilder result = new StringBuilder();
                String line;
                while ((line = reader.readLine()) != null) {
                    result.append(line);
                }
                reader.close();

                // Vérifie si la réponse contient "success"
                return result.toString().contains("success");
            } catch (Exception e) {
                e.printStackTrace();
                return false;
            }
        }

        @Override
        protected void onPostExecute(Boolean success) {
            if (success) {
                Toast.makeText(GererVaccinationActivity.this, "Vaccin ajouté avec succès", Toast.LENGTH_SHORT).show();
            } else {
                Toast.makeText(GererVaccinationActivity.this, "Erreur lors de l'ajout du vaccin", Toast.LENGTH_SHORT).show();
            }
        }
    }

    // Classe AsyncTask pour récupérer les bébés
    private class GetBebesTask extends AsyncTask<Integer, Void, JSONArray> {
        @Override
        protected JSONArray doInBackground(Integer... params) {
            int id_medecin = params[0];
            String urlStr = "http://192.168.189.1/gestionvaccin/vue/child/add.php?id_medecin=" + id_medecin;

            try {
                URL url = new URL(urlStr);
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                conn.setRequestMethod("GET");
                conn.setConnectTimeout(10000);
                conn.connect();

                // Lire la réponse
                BufferedReader reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
                StringBuilder result = new StringBuilder();
                String line;
                while ((line = reader.readLine()) != null) {
                    result.append(line);
                }
                reader.close();

                return new JSONArray(result.toString());
            } catch (Exception e) {
                e.printStackTrace();
                return null;
            }
        }

        @Override
        protected void onPostExecute(JSONArray jsonArray) {
            if (jsonArray != null) {
                // Créer un Adapter pour charger les bébés dans le spinner
                BebesAdapter spinnerAdapter = new BebesAdapter(GererVaccinationActivity.this, jsonArray);
                spinnerBebe.setAdapter(spinnerAdapter);
            } else {
                Toast.makeText(GererVaccinationActivity.this, "Erreur de récupération des bébés", Toast.LENGTH_SHORT).show();
            }
        }
    }
}
