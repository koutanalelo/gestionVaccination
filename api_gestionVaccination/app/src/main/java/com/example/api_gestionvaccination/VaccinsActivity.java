package com.example.api_gestionvaccination;

import android.os.AsyncTask;
import android.os.Bundle;
import android.widget.ListView;
import android.widget.Toast;

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

public class VaccinsActivity extends AppCompatActivity {

    private ListView listViewvaccinsBebe, listViewTousvaccins, listViewvaccinsAVenir;
    private VaccinsCompletAdapter vaccinAdapterBebe, vaccinAdapterTous, vaccinAdapterAVenir;
    private ArrayList<vaccin> vaccinsBebe, vaccinsDisponibles, vaccinsAVenir;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_vaccin_complet);

        // Initialisation des ListViews
        listViewvaccinsBebe = findViewById(R.id.listViewvaccinsBebe);
        listViewTousvaccins = findViewById(R.id.listViewTousvaccins);
        listViewvaccinsAVenir = findViewById(R.id.listViewvaccinsAVenir);

        // Initialiser les ArrayLists
        vaccinsBebe = new ArrayList<>();
        vaccinsDisponibles = new ArrayList<>();
        vaccinsAVenir = new ArrayList<>();

        // Initialisation des adaptateurs
        vaccinAdapterBebe = new VaccinsCompletAdapter(this, vaccinsBebe);
        listViewvaccinsBebe.setAdapter(vaccinAdapterBebe);

        vaccinAdapterTous = new VaccinsCompletAdapter(this, vaccinsDisponibles);
        listViewTousvaccins.setAdapter(vaccinAdapterTous);

        vaccinAdapterAVenir = new VaccinsCompletAdapter(this, vaccinsAVenir);
        listViewvaccinsAVenir.setAdapter(vaccinAdapterAVenir);

        // URL des API PHP
        String urlBebe = "http://192.168.189.1/gestionvaccin/vaccin.php";
        String urlDisponibles = "http://192.168.189.1/gestionvaccin/vaccins_present.php";
        String urlAVenir = "http://192.168.189.1/gestionvaccin/vaccins_futur.php";

        // Appels HTTP pour récupérer les vaccins
        fetchVaccins(urlBebe, vaccinsBebe, vaccinAdapterBebe);
        fetchVaccins(urlDisponibles, vaccinsDisponibles, vaccinAdapterTous);
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
                    return "Erreur de connexion"; // Retourner une erreur de connexion si elle survient
                }
                return result.toString();
            }

            @Override
            protected void onPostExecute(String result) {
                if (result.equals("Erreur de connexion")) {
                    // Afficher un message Toast en cas d'erreur de connexion
                    Toast.makeText(VaccinsActivity.this, "Erreur de connexion au serveur", Toast.LENGTH_SHORT).show();
                    return;
                }

                try {
                    // Parsing des données JSON
                    JSONArray jsonArray = new JSONArray(result);
                    vaccinsListe.clear();

                    // Parcours du tableau JSON
                    for (int i = 0; i < jsonArray.length(); i++) {
                        JSONObject jsonObject = jsonArray.getJSONObject(i);

                        // Récupérer les données nécessaires
                        String nom = jsonObject.getString("nom");
                        String description = jsonObject.optString("description", "Aucune description disponible");
                        int ageRecommande = jsonObject.getInt("age_recommande");

                        // Récupérer la date de renouvellement sous forme de String
                        String dateRenouvellementString = jsonObject.getString("date_renouvellement");

                        // Convertir la chaîne en un objet Date
                        Date dateRenouvellement = null;
                        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                        try {
                            dateRenouvellement = dateFormat.parse(dateRenouvellementString);
                        } catch (Exception e) {
                            e.printStackTrace();
                        }

                        // Récupérer d'autres champs (id_bebe, email, role, mdp)
                        int idBebe = jsonObject.optInt("id_bebe", 0);  // Valeur par défaut = 0 si le champ n'existe pas
                        String email = jsonObject.getString("email");
                        String role = jsonObject.getString("role");
                        String mdp = jsonObject.getString("mdp");

                        // Créer l'objet vaccin avec le constructeur approprié
                        vaccin vaccinObj = new vaccin(ageRecommande, idBebe, nom, description,
                                email, role, mdp, dateRenouvellement);

                        // Ajouter le vaccin à la liste
                        vaccinsListe.add(vaccinObj);
                    }

                    // Rafraîchir l'adaptateur pour afficher les données
                    adapter.notifyDataSetChanged();

                } catch (JSONException e) {
                    e.printStackTrace();
                    // Afficher une erreur si le JSON est mal formaté
                    Toast.makeText(VaccinsActivity.this, "Erreur lors du parsing des données", Toast.LENGTH_SHORT).show();
                }
            }
        }.execute(url);
    }
}
