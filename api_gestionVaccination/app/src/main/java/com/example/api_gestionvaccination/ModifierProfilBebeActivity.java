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

import java.util.HashMap;
import java.util.Map;

public class ModifierProfilBebeActivity extends AppCompatActivity {

    private EditText etNomBebe, etPrenomBebe, etDateNaissanceBebe, etPoidBebe, etTailleBebe; // Déclaration des variables
    private Button buttonEnregistrerModifications, buttonRetourModifier;
    private int idBebe;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_modifier_profil_bebe);

        // Initialisation des vues
        etNomBebe = findViewById(R.id.etNomBebe);  // EditText pour le nom
        etPrenomBebe = findViewById(R.id.etPrenomBebe);  // EditText pour le prénom
        etDateNaissanceBebe = findViewById(R.id.etDateNaissanceBebe); // EditText pour la date de naissance
        etPoidBebe = findViewById(R.id.etPoidBebe);  // EditText pour le poids
        etTailleBebe = findViewById(R.id.etTailleBebe);  // EditText pour la taille
        buttonEnregistrerModifications = findViewById(R.id.buttonEnregistrerModifications);
        buttonRetourModifier = findViewById(R.id.buttonRetourModifier);

        // Récupérer l'id du bébé
        idBebe = getIntent().getIntExtra("id_bebe", -1);  // Nous avons envoyé l'id_bebe depuis l'activité précédente

        // Charger les données existantes du bébé
        chargerProfilBebe(idBebe);

        // Bouton retour
        buttonRetourModifier.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Retourner à l'activité précédente
                finish();
            }
        });

        // Bouton enregistrer modifications
        buttonEnregistrerModifications.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Récupérer les nouvelles informations
                String nom = etNomBebe.getText().toString().trim();
                String prenom = etPrenomBebe.getText().toString().trim();
                String dateNaissance = etDateNaissanceBebe.getText().toString().trim();
                String poid = etPoidBebe.getText().toString().trim();
                String taille = etTailleBebe.getText().toString().trim();

                if (nom.isEmpty() || prenom.isEmpty() || dateNaissance.isEmpty() || poid.isEmpty() || taille.isEmpty()) {
                    Toast.makeText(ModifierProfilBebeActivity.this, "Tous les champs doivent être remplis", Toast.LENGTH_SHORT).show();
                    return;
                }

                // Appeler la méthode pour mettre à jour les données du bébé sur le serveur
                modifierProfilBebe(nom, prenom, dateNaissance, poid, taille, idBebe);
            }
        });
    }

    private void chargerProfilBebe(int idBebe) {
        String url = "http://192.168.189.1/gestionvaccination/obtenirProfilBebe.php";

        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonResponse = new JSONObject(response);
                            etNomBebe.setText(jsonResponse.getString("nom"));
                            etPrenomBebe.setText(jsonResponse.getString("prenom"));
                            etDateNaissanceBebe.setText(jsonResponse.getString("date_naissance"));
                            etPoidBebe.setText(jsonResponse.getString("poid"));
                            etTailleBebe.setText(jsonResponse.getString("taille"));
                        } catch (Exception e) {
                            e.printStackTrace();
                            Toast.makeText(ModifierProfilBebeActivity.this, "Erreur lors du chargement du profil", Toast.LENGTH_SHORT).show();
                        }
                    }
                }, error -> Toast.makeText(ModifierProfilBebeActivity.this, "Erreur réseau", Toast.LENGTH_SHORT).show());

        Volley.newRequestQueue(this).add(stringRequest);
    }

    private void modifierProfilBebe(String nom, String prenom, String dateNaissance, String poid, String taille, int idBebe) {
        String url = "http://192.168.189.1/gestionvaccination/modifierProfilBebe.php";

        StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Toast.makeText(ModifierProfilBebeActivity.this, "Profil modifié avec succès", Toast.LENGTH_SHORT).show();
                        // Retourner à la page de profil
                        finish();
                    }
                }, error -> Toast.makeText(ModifierProfilBebeActivity.this, "Erreur lors de la modification", Toast.LENGTH_SHORT).show()) {

            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("id_bebe", String.valueOf(idBebe));
                params.put("nom", nom);
                params.put("prenom", prenom);
                params.put("date_naissance", dateNaissance);
                params.put("poid", poid);
                params.put("taille", taille);
                return params;
            }
        };

        Volley.newRequestQueue(this).add(stringRequest);
    }
}
