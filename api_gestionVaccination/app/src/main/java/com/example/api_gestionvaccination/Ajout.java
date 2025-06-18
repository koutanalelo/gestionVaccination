package com.example.api_gestionvaccination;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONObject;

public class Ajout extends AppCompatActivity implements View.OnClickListener {

    private EditText etNom, etPrenom, etDateNaissance, etPoids, etTaille, etIdUser;
    private Button btnAjouter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add); // Assure-toi que ton layout est bien lié à cette activité

        // Initialiser les champs
        etNom = findViewById(R.id.idNom);
        etPrenom = findViewById(R.id.idPrenom);
        etDateNaissance = findViewById(R.id.idBirth);
        etPoids = findViewById(R.id.idPoid);
        etTaille = findViewById(R.id.idTaille);
        etIdUser = findViewById(R.id.editTextText6);
        btnAjouter = findViewById(R.id.idValider);

        // Configurer le bouton pour appeler la méthode onClick
        btnAjouter.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        // Récupérer les valeurs des champs
        String nom = etNom.getText().toString();
        String prenom = etPrenom.getText().toString();
        String dateNaissance = etDateNaissance.getText().toString();
        String poids = etPoids.getText().toString();
        String taille = etTaille.getText().toString();
        String idUser = etIdUser.getText().toString();

        // Vérification de la validité des données (par exemple, tous les champs doivent être remplis)
  //      if (nom.isEmpty() || prenom.isEmpty() || dateNaissance.isEmpty() || poids.isEmpty() || taille.isEmpty() || idUser.isEmpty()) {
      //      Toast.makeText(this, "Tous les champs doivent être remplis", Toast.LENGTH_SHORT).show();
       //     return;
     //   }

        // Envoi des données via Volley
        ajouterBebe(nom, prenom, dateNaissance, poids, taille, idUser);
    }

    private void ajouterBebe(String nom, String prenom, String dateNaissance, String poids, String taille, String idUser) {
        // URL du backend PHP
        String url = "http://192.168.189.1/gestionvaccin/bebe_ajout.php"; // Remplace avec l'URL correcte

        // Créer un objet JSON avec les données
        JSONObject params = new JSONObject();
        try {
            params.put("nom", nom);
            params.put("prenom", prenom);
            params.put("date_naissance", dateNaissance);
            params.put("poid", poids);
            params.put("taille", taille);
            params.put("id_user", idUser);
        } catch (Exception e) {
            e.printStackTrace();
        }

        // Créer la requête POST avec Volley
        StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        // Gérer la réponse du serveur
                        try {
                            JSONObject jsonResponse = new JSONObject(response);
                            if (jsonResponse.has("success")) {
                                Toast.makeText(Ajout.this, jsonResponse.getString("success"), Toast.LENGTH_SHORT).show();
                            } else if (jsonResponse.has("error")) {
                                Toast.makeText(Ajout.this, jsonResponse.getString("error"), Toast.LENGTH_SHORT).show();
                            }
                        } catch (Exception e) {
                            e.printStackTrace();
                        }
                    }
                },
                error -> {
                    // Gérer les erreurs de requête
                    Toast.makeText(Ajout.this, "Erreur réseau", Toast.LENGTH_SHORT).show();
                }) {
            @Override
            public byte[] getBody() {
                return params.toString().getBytes();
            }

            @Override
            public String getBodyContentType() {
                return "application/json; charset=utf-8";
            }
        };

        // Ajouter la requête à la queue Volley
        Volley.newRequestQueue(this).add(stringRequest);
    }
}
