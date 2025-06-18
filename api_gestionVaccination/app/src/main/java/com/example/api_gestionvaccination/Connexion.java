

package com.example.api_gestionvaccination;


import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class Connexion extends AppCompatActivity {

    private EditText txtEmail, txtMdp;
    private Button btValider;
    private static final String TAG = "Connexion";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Initialiser les champs et le bouton
        txtEmail = findViewById(R.id.idEmail);
        txtMdp = findViewById(R.id.idMdp);
        btValider = findViewById(R.id.idValider2);

        // Ajouter l'écouteur au bouton
        btValider.setOnClickListener(v -> {
            String email = txtEmail.getText().toString().trim();
            String mdp = txtMdp.getText().toString().trim();

            if (email.isEmpty() || mdp.isEmpty()) {
                Toast.makeText(Connexion.this, "Veuillez remplir tous les champs", Toast.LENGTH_SHORT).show();
            } else {
                // Appeler la tâche AsyncTask pour vérifier les identifiants
                new VerifConnexionUtilisateur().execute(email, mdp);
            }
        });
    }

    // Classe AsyncTask pour gérer la vérification des identifiants
    private class VerifConnexionUtilisateur extends AsyncTask<String, Void, String> {

        @Override
        protected String doInBackground(String... params) {
            String email = params[0];
            String mdp = params[1];
            String resultat = "";

            try {
                // Construire l'URL avec des paramètres
                String urlString = "http://192.168.189.1/gestionvaccin/verifConnexionUtilisateur.php";
                urlString += "?email=" + URLEncoder.encode(email, "UTF-8");
                urlString += "&mdp=" + URLEncoder.encode(mdp, "UTF-8");

                // Créer la connexion HTTP
                URL url = new URL(urlString);
                HttpURLConnection connection = (HttpURLConnection) url.openConnection();
                connection.setRequestMethod("GET");
                connection.setConnectTimeout(10000); // Timeout de 10 secondes

                // Vérifier la réponse du serveur
                int responseCode = connection.getResponseCode();
                if (responseCode == HttpURLConnection.HTTP_OK) {
                    // Lire la réponse
                    InputStream inputStream = connection.getInputStream();
                    BufferedReader reader = new BufferedReader(new InputStreamReader(inputStream, "UTF-8"));
                    StringBuilder response = new StringBuilder();
                    String line;
                    while ((line = reader.readLine()) != null) {
                        response.append(line);
                    }

                    resultat = response.toString();
                } else {
                    Log.e(TAG, "Erreur du serveur : " + responseCode);
                }
            } catch (IOException e) {
                Log.e(TAG, "Erreur de connexion : " + e.getMessage(), e);
            }

            return resultat;
        }

        @Override
        protected void onPostExecute(String resultat) {
            super.onPostExecute(resultat);

            if (resultat.isEmpty()) {
                Toast.makeText(Connexion.this, "Erreur de connexion au serveur.", Toast.LENGTH_SHORT).show();
                return;
            }

            try {
                // Analyser le JSON
                JSONArray jsonArray = new JSONArray(resultat);
                Log.e("json", resultat);
                if (jsonArray.length() > 0) {
                    JSONObject user = jsonArray.getJSONObject(0);
                    String role = user.getString("role");
                    int id_user =user.getInt("id_user");
                    Log.e("iduser", id_user+"");
                    // Navigation basée sur le rôle
                    Intent intent;
                    switch (role.toLowerCase()) {
                        case "parent":
                            // intent = new Intent(Connexion.this, GestionBebeActivity.class);
                            intent = new Intent(Connexion.this, Menu.class);
                            break;
                        case "medecin":
                            intent = new Intent(Connexion.this, MenuMedecinActivity.class);
                            break;
                        case "admin":
                            intent = new Intent(Connexion.this,Menu .class);
                            break;
                        default:
                            Toast.makeText(Connexion.this, "Rôle inconnu.", Toast.LENGTH_SHORT).show();
                            return;
                    }
                    intent.putExtra("id_user", id_user+"");
                    startActivity(intent);
                } else {
                    Toast.makeText(Connexion.this, "Identifiants incorrects", Toast.LENGTH_SHORT).show();
                }
            } catch (JSONException e) {
                Log.e(TAG, "Erreur d'analyse JSON : " + e.getMessage(), e);
                Toast.makeText(Connexion.this, "Erreur de traitement des données.", Toast.LENGTH_SHORT).show();
            }
        }
    }
}
