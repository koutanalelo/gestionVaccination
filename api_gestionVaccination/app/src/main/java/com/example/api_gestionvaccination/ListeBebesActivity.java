package com.example.api_gestionvaccination;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.widget.Button;
import android.widget.ListView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONObject;

public class ListeBebesActivity extends AppCompatActivity {

    private ListView listViewBebes;
    private Button btRetour;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_liste);

        listViewBebes = findViewById(R.id.idSp);
        btRetour = findViewById(R.id.btRetour);

        // Retour au menu
        btRetour.setOnClickListener(v -> {
            Intent intent = new Intent(ListeBebesActivity.this, Menu.class);
            startActivity(intent);
            finish();
        });

        // L'URL de ton API (modifie si nécessaire)
        String url = "http://192.168.189.1/gestionvaccin/list_bebes.php";

        // Requête JSON pour récupérer les bébés
        JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, url, null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        BebesAdapter adapter = new BebesAdapter(ListeBebesActivity.this, response);
                        listViewBebes.setAdapter(adapter);
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(ListeBebesActivity.this, "Erreur de récupération: " + error.getMessage(), Toast.LENGTH_LONG).show();
                        Log.e("BebesActivity", "Erreur Volley: ", error);
                    }
                });

        // Ajout de la requête à la file
        Volley.newRequestQueue(this).add(request);
    }
}
