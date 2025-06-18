package com.example.api_gestionvaccination;

import android.os.AsyncTask;
import android.os.Bundle;
import android.widget.ListView;
import android.widget.Toast;
import android.util.Log;

import androidx.appcompat.app.AppCompatActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

public class VaccinCompletActivity extends AppCompatActivity {

    private ListView listViewvaccinsBebe, listViewvaccinsDisponibles, listViewvaccinsAVenir;
    private VaccinsCompletAdapter vaccinAdapterBebe, vaccinAdapterDisponibles, vaccinAdapterAVenir;
    private ArrayList<vaccin> vaccinsBebe, vaccinsDisponibles, vaccinsAVenir;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_vaccin_complet);

        // Initialisation des ListViews
        listViewvaccinsBebe = findViewById(R.id.listViewvaccinsBebe);
        listViewvaccinsDisponibles = findViewById(R.id.listViewTousvaccins);
        listViewvaccinsAVenir = findViewById(R.id.listViewvaccinsAVenir);

        // Initialiser les ArrayLists
        vaccinsBebe = new ArrayList<>();
        vaccinsDisponibles = new ArrayList<>();
        vaccinsAVenir = new ArrayList<>();

        // Initialisation des adaptateurs
        vaccinAdapterBebe = new VaccinsCompletAdapter(this, vaccinsBebe);
        listViewvaccinsBebe.setAdapter(vaccinAdapterBebe);

        vaccinAdapterDisponibles = new VaccinsCompletAdapter(this, vaccinsDisponibles);
        listViewvaccinsDisponibles.setAdapter(vaccinAdapterDisponibles);

        vaccinAdapterAVenir = new VaccinsCompletAdapter(this, vaccinsAVenir);
        listViewvaccinsAVenir.setAdapter(vaccinAdapterAVenir);

        // URL des API PHP
        String urlBebe = "http://192.168.189.1/gestionvaccin/vaccin.php";  // Vaccins pour le bébé
        String urlDisponibles = "http://192.168.189.1/gestionvaccin/vaccins_present.php";  // Vaccins disponibles
        String urlAVenir = "http://192.168.189.1/gestionvaccin/vaccins_futur.php";  // Vaccins à venir

        // Appels HTTP pour récupérer les vaccins
        fetchVaccins(urlBebe, vaccinsBebe, vaccinAdapterBebe);
        fetchVaccins(urlDisponibles, vaccinsDisponibles, vaccinAdapterDisponibles);
        fetchVaccins(urlAVenir, vaccinsAVenir, vaccinAdapterAVenir);
    }

    // Méthode pour effectuer l'appel HTTP et récupérer les données
    private void fetchVaccins(String url, final ArrayList<vaccin> vaccinsListe, final VaccinsCompletAdapter adapter) {
        new AsyncTask<String, Void, String>() {

            @Override
            protected String doInBackground(String... params) {
                String urlString = params[0];
                StringBuilder result = new StringBuilder();
                try {
                    // Ouvrir la connexion HTTP
                    URL url = new URL(urlString);
                    HttpURLConnection connection = (HttpURLConnection) url.openConnection();
                    connection.setRequestMethod("GET");
                    BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
                    String line;
                    while ((line = reader.readLine()) != null) {
                        result.append(line);
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                    // Retourner une erreur si la connexion échoue
                    return "Erreur de connexion";
                }
                return result.toString();
            }

            @Override
            protected void onPostExecute(String result) {
                // Vérifier si la réponse est vide ou null
                if (result == null || result.isEmpty()) {
                    Toast.makeText(VaccinCompletActivity.this, "Aucune donnée reçue du serveur", Toast.LENGTH_SHORT).show();
                    return;
                }

                // Log de la réponse pour le debug
                Log.d("VaccinCompletActivity", "Réponse du serveur: " + result);

                try {
                    // Vérification si la réponse est un tableau JSON valide
                    JSONArray jsonArray = new JSONArray(result);

                    // Si le tableau JSON est null ou vide, traiter ce cas
                    if (jsonArray == null || jsonArray.length() == 0) {
                        Toast.makeText(VaccinCompletActivity.this, "Aucun vaccin trouvé", Toast.LENGTH_SHORT).show();
                        return;
                    }

                    // Vider la liste des vaccins avant de la remplir
                    vaccinsListe.clear();

                    // Parcours du tableau JSON
                    for (int i = 0; i < jsonArray.length(); i++) {
                        JSONObject jsonObject = jsonArray.getJSONObject(i);

                        // Récupérer les données nécessaires avec des vérifications
                        String nom = jsonObject.optString("nom", "Inconnu");
                        String description = jsonObject.optString("description", "Pas de description");
                        int ageRecommande = jsonObject.optInt("age_recommande", 0);

                        // Conversion de la chaîne en objet Date (format "yyyy-MM-dd")
                        String dateRenouvellementString = jsonObject.optString("date_renouvellement", "");
                        Date dateRenouvellement = null;
                        if (!dateRenouvellementString.isEmpty()) {
                            SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                            try {
                                dateRenouvellement = dateFormat.parse(dateRenouvellementString);
                            } catch (Exception e) {
                                e.printStackTrace();
                                // Si la date est mal formatée, l'assigner à null
                                dateRenouvellement = null;
                            }
                        }

                        int idBebe = jsonObject.optInt("id_bebe", 0);  // Si l'id_bebe n'existe pas, mettre 0
                        String email = jsonObject.optString("email", "Inconnu");
                        String role = jsonObject.optString("role", "Inconnu");
                        String mdp = jsonObject.optString("mdp", "Inconnu");

                        // Créer un objet vaccin et l'ajouter à la liste
                        vaccin vaccinObj = new vaccin(ageRecommande, idBebe, nom, description,
                                email, role, mdp, dateRenouvellement);
                        vaccinsListe.add(vaccinObj);
                    }

                    // Rafraîchir l'adaptateur pour afficher les données
                    adapter.notifyDataSetChanged();

                } catch (JSONException e) {
                    e.printStackTrace();
                    // Afficher une erreur si le JSON est mal formaté
                    Toast.makeText(VaccinCompletActivity.this, "Erreur lors du parsing des données", Toast.LENGTH_SHORT).show();
                    Log.e("VaccinCompletActivity", "Erreur lors du parsing des données", e);
                }
            }
        }.execute(url);
    }
}
