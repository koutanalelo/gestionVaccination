package com.example.api_gestionvaccination;

import android.os.Bundle;
import android.util.Log;
import android.widget.ListView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;

public class ListeVaccinsActivity extends AppCompatActivity {

    private ListView listViewVaccins;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_liste_vaccins);

        listViewVaccins = findViewById(R.id.listViewVaccins);

        // Appel de la méthode pour charger tous les vaccins
        chargerVaccins();
    }

    // Méthode pour charger tous les vaccins sans l'ID du bébé
    private void chargerVaccins() {
        String url = "http://192.168.189.1/gestionvaccin/vaccin.php";  // URL sans l'ID de bébé

        // Requête pour récupérer tous les vaccins
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(
                Request.Method.GET,
                url,
                null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        Log.d("API_RESPONSE", "Vaccins reçus: " + response.toString());

                        // Si la réponse est vide
                        if (response.length() == 0) {
                            Toast.makeText(ListeVaccinsActivity.this, "Aucun vaccin trouvé.", Toast.LENGTH_SHORT).show();
                        }

                        // Remplir la ListView
                        VaccinsAdapter adapter = new VaccinsAdapter(ListeVaccinsActivity.this, response);
                        listViewVaccins.setAdapter(adapter);
                    }
                },
                error -> {
                    // Affichage du détail de l'erreur
                    Toast.makeText(ListeVaccinsActivity.this, "Erreur réseau: " + error.getMessage(), Toast.LENGTH_SHORT).show();
                    Log.e("API_ERROR", "Erreur réseau: " + error.getMessage());
                }
        );

        // Ajouter la requête à la queue de Volley
        Volley.newRequestQueue(this).add(jsonArrayRequest);
    }
}
