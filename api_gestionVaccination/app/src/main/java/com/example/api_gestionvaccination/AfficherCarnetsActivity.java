package com.example.api_gestionvaccination;

import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.widget.ArrayAdapter;
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
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

public class AfficherCarnetsActivity extends AppCompatActivity {

    private ListView listViewCarnets;
    private ArrayList<String> carnetList = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_afficher_carnets);

        // Initialiser le ListView
        listViewCarnets = findViewById(R.id.listViewCarnets);

        // Lancer la tâche asynchrone pour récupérer tous les carnets
        new GetAllCarnetsTask().execute();
    }

    // Classe AsyncTask pour récupérer tous les carnets de vaccination
    private class GetAllCarnetsTask extends AsyncTask<Void, Void, JSONArray> {

        @Override
        protected JSONArray doInBackground(Void... params) {
            String urlStr = "http://192.168.189.1/gestionvaccin/carnet.php";  // URL pour récupérer tous les carnets

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
                return null;  // Retourne null en cas d'erreur
            }
        }

        @Override
        protected void onPostExecute(JSONArray jsonArray) {
            if (jsonArray != null && jsonArray.length() > 0) {
                try {
                    carnetList.clear();
                    SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
                    SimpleDateFormat alternateDateFormat = new SimpleDateFormat("yyyy-MM-dd");  // Format alternatif

                    for (int i = 0; i < jsonArray.length(); i++) {
                        JSONObject carnetJson = jsonArray.getJSONObject(i);

                        // Récupérer les informations du carnet
                        int id_c = carnetJson.getInt("id_c");
                        String statut = carnetJson.getString("statut");
                        String dateAdminStr = carnetJson.getString("date_administration");
                        String rappelStr = carnetJson.getString("rappel");

                        // Récupérer le nom et prénom du bébé à partir de la réponse JSON
                        String nomBebe = carnetJson.getString("nom_bebe");
                        String prenomBebe = carnetJson.getString("prenom_bebe");

                        // Convertir les dates
                        Date date_administration = parseDate(dateAdminStr, dateFormat, alternateDateFormat);
                        Date rappel = parseDate(rappelStr, dateFormat, alternateDateFormat);

                        // Créer le texte à afficher pour chaque carnet
                        String carnetDetails = "Bébé : " + nomBebe + " " + prenomBebe + "\n" +
                                "ID Carnet : " + id_c + "\n" +
                                "Statut : " + statut + "\n" +
                                "Date d'admin : " + (date_administration != null ? dateFormat.format(date_administration) : "N/A") + "\n" +
                                "Rappel : " + (rappel != null ? dateFormat.format(rappel) : "N/A");

                        carnetList.add(carnetDetails);
                    }

                    // Mettre à jour l'adapter
                    ArrayAdapter<String> adapter = new ArrayAdapter<>(AfficherCarnetsActivity.this,
                            android.R.layout.simple_list_item_1, carnetList);
                    listViewCarnets.setAdapter(adapter);

                } catch (JSONException e) {
                    e.printStackTrace();
                    Toast.makeText(AfficherCarnetsActivity.this, "Erreur lors de la récupération des carnets", Toast.LENGTH_SHORT).show();
                }
            } else {
                Toast.makeText(AfficherCarnetsActivity.this, "Aucun carnet de vaccination trouvé", Toast.LENGTH_SHORT).show();
            }
        }

        // Méthode pour essayer de parser la date avec plusieurs formats
        private Date parseDate(String dateStr, SimpleDateFormat... formats) {
            for (SimpleDateFormat format : formats) {
                try {
                    if (!dateStr.isEmpty()) {
                        return format.parse(dateStr);
                    }
                } catch (ParseException e) {
                    // Si le format échoue, on passe au suivant
                    Log.e("Date Parse Error", "Erreur de format pour la date: " + dateStr);
                }
            }
            return null;  // Retourne null si aucune date valide n'a été trouvée
        }
    }
}
