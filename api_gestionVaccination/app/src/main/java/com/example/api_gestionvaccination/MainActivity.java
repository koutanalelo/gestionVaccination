package com.example.api_gestionvaccination;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Spinner;
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
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    private EditText txtEmail, txtMdp;
    private Button btValider;
    private Spinner spinnerRole;
    private static utilisateur utilisateurConnecte = null;
    private static final String TAG = "MainActivity";
    private ListView listViewVaccinsBebe, listViewTousVaccins, listViewVaccinsAVenir;
    private VaccinsCompletAdapter vaccinAdapterBebe, vaccinAdapterTous,vaccinAdapterAVenir;
    private Button btnAfficherCarnets,btP;
    private bebe monBebe;  // Instance de la classe bebe




    @SuppressLint("MissingInflatedId")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Initialisation des composants de la vue
        this.txtEmail = findViewById(R.id.idEmail);
        this.txtMdp = findViewById(R.id.idMdp);
        this.btValider = findViewById(R.id.idValider2);
        this.spinnerRole = findViewById(R.id.idRole2);
        // Initialisation des ListView
        listViewVaccinsBebe = findViewById(R.id.listViewVaccinsBebe);
        listViewTousVaccins = findViewById(R.id.listViewTousVaccins);
        listViewVaccinsAVenir = findViewById(R.id.listViewVaccinsAVenir);
        btnAfficherCarnets = findViewById(R.id.idCn);
        btP = findViewById(R.id.idProfilBebe);

        // Ajouter des données au Spinner
        String[] roles = {"Parent", "Medecin", "Admin"};
        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_item, roles);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinnerRole.setAdapter(adapter);
       //les carnets de vaccination





        // Ajout de l'écouteur pour le bouton de validation
        this.btValider.setOnClickListener(this);





    }

    @Override
    public void onClick(View v) {
        if (v.getId() == R.id.idValider2) {
            String email = this.txtEmail.getText().toString().trim();
            String mdp = this.txtMdp.getText().toString().trim();
            String roleChoisi = spinnerRole.getSelectedItem().toString();

            if (email.isEmpty() || mdp.isEmpty()) {
                Toast.makeText(this, "Veuillez remplir tous les champs.", Toast.LENGTH_SHORT).show();
                return;
            }

            if (!android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
                Toast.makeText(this, "Veuillez entrer un email valide.", Toast.LENGTH_SHORT).show();
                return;
            }

            utilisateur unUtilisateur = new utilisateur(0, "", "", email, roleChoisi, mdp);

            VerifConnexionUtilisateur uneTache = new VerifConnexionUtilisateur();
            uneTache.execute(unUtilisateur);
        }
    }

    // Classe AsyncTask pour gérer la vérification des identifiants
    class VerifConnexionUtilisateur extends AsyncTask<utilisateur, Void, utilisateur> {

        @Override
        protected utilisateur doInBackground(utilisateur... utilisateurs) {
            String url = "http://192.168.189.1/gestionvaccin/verifConnexionUtilisateur.php";

            String email = utilisateurs[0].getEmail();
            String mdp = utilisateurs[0].getMdp();

            utilisateur utilisateurBDD = null;
            String resultatJSON = "";
            try {
                // Encodage des paramètres pour éviter les erreurs
                url += "?email=" + URLEncoder.encode(email, "UTF-8");
                url += "&mdp=" + URLEncoder.encode(mdp, "UTF-8");

                // Ouverture de la connexion à l'URL
                URL uneURL = new URL(url);
                HttpURLConnection uneConnexion = (HttpURLConnection) uneURL.openConnection();
                uneConnexion.setRequestMethod("GET");
                uneConnexion.setDoInput(true);
                uneConnexion.setConnectTimeout(10000);
                uneConnexion.setReadTimeout(10000);  // Ajouter un timeout pour la lecture
                uneConnexion.connect();

                // Vérification de la réponse du serveur
                int responseCode = uneConnexion.getResponseCode();
                if (responseCode != HttpURLConnection.HTTP_OK) {
                    Log.e(TAG, "Erreur du serveur : Code " + responseCode);
                    return null;
                }

                // Lecture de la réponse JSON
                InputStream in = uneConnexion.getInputStream();
                BufferedReader br = new BufferedReader(new InputStreamReader(in, "UTF-8"));
                StringBuilder sb = new StringBuilder();
                String ligne;
                while ((ligne = br.readLine()) != null) {
                    sb.append(ligne);
                }
                resultatJSON = sb.toString();

                // Vérifiez si la réponse est vide avant de la traiter
                if (resultatJSON.isEmpty()) {
                    Log.e(TAG, "La réponse du serveur est vide !");
                    return null;
                }
                Log.d(TAG, "Réponse JSON reçue : " + resultatJSON);
            } catch (IOException exp) {
                Log.e(TAG, "Erreur de connexion réseau : " + exp.getMessage(), exp);
                return null;
            }

            // Parsing du JSON
            try {
                JSONArray tabJson = new JSONArray(resultatJSON);  // Si la réponse est un tableau JSON
                if (tabJson.length() > 0) {
                    JSONObject unObjet = tabJson.getJSONObject(0);
                    utilisateurBDD = new utilisateur(
                            unObjet.getInt("id_user"),
                            unObjet.getString("nom"),
                            unObjet.getString("prenom"),
                            unObjet.getString("email"),
                            unObjet.getString("role"),
                            unObjet.getString("mdp")
                    );
                } else {
                    Log.e(TAG, "Aucun utilisateur trouvé dans la réponse JSON.");
                    return null;
                }
            } catch (JSONException exp) {
                Log.e(TAG, "Erreur de parsing JSON : " + exp.getMessage(), exp);
                return null;
            }
            return utilisateurBDD;
        }

        @Override
        protected void onPostExecute(utilisateur utilisateur) {
            super.onPostExecute(utilisateur);

            if (utilisateur != null) {
                Log.d(TAG, "Utilisateur connecté : " + utilisateur.getNom() + ", Rôle : " + utilisateur.getRole());
                MainActivity.setUtilisateurConnecte(utilisateur);

                // Navigation en fonction du rôle de l'utilisateur
                switch (utilisateur.getRole().toLowerCase()) {
                    case "parent":
                        //startActivity(new Intent(MainActivity.this, GestionBebeActivity.class));
                        Intent unIntent = new Intent(MainActivity.this, Menu.class);
                        unIntent.putExtra("id_user", utilisateur.getId_user()+"");
                        startActivity(unIntent);
                        break;
                    case "medecin":
                        startActivity(new Intent(MainActivity.this, MenuMedecinActivity.class));
                        break;
                    case "admin":
                        startActivity(new Intent(MainActivity.this, AdminDashboardActivity.class));
                        break;
                    default:
                        Toast.makeText(MainActivity.this, "Rôle inconnu.", Toast.LENGTH_SHORT).show();
                }
            } else {
                Toast.makeText(MainActivity.this, "Identifiants incorrects.", Toast.LENGTH_SHORT).show();
            }
        }
    }

    public static utilisateur getUtilisateurConnecte() {
        return utilisateurConnecte;
    }

    public static void setUtilisateurConnecte(utilisateur utilisateur) {
        MainActivity.utilisateurConnecte = utilisateur;
    }




    private class GetVaccinsTask extends AsyncTask<String, Void, ArrayList<vaccin>> {

        // Exécution en arrière-plan
        @Override
        protected ArrayList<vaccin> doInBackground(String... params) {
            ArrayList<vaccin> vaccins = new ArrayList<>();
            try {
                // Connexion HTTP pour récupérer les données JSON
                URL url = new URL(params[0]);  // URL de l'API
                HttpURLConnection connection = (HttpURLConnection) url.openConnection();
                connection.setRequestMethod("GET");

                // Lecture de la réponse de l'API
                BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
                StringBuilder response = new StringBuilder();
                String line;
                while ((line = reader.readLine()) != null) {
                    response.append(line);
                }

                // Parse la réponse JSON
                JSONArray jsonArray = new JSONArray(response.toString());
                for (int i = 0; i < jsonArray.length(); i++) {
                    JSONObject vaccinJson = jsonArray.getJSONObject(i);

                    // Récupération des données du vaccin
                    // Extraction des données du JSON
                    String nom = vaccinJson.getString("nom");
                    String description = vaccinJson.getString("description");
                    int ageRecommande = vaccinJson.getInt("age_recommande");
                    int idBebe = vaccinJson.getInt("id_bebe");
                    String email = vaccinJson.getString("email");
                    String role = vaccinJson.getString("role");
                    String mdp = vaccinJson.getString("mdp");
                    String dateRenouvellementString = vaccinJson.getString("date_renouvellement");

                    // Conversion de la date en objet Date
                    Date dateRenouvellement = null;
                    try {
                        SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd"); // Format de la date
                        dateRenouvellement = sdf.parse(dateRenouvellementString);
                    } catch (ParseException e) {
                        e.printStackTrace();
                    }

                    // Création de l'objet vaccin et ajout à la liste
                        vaccin vacc = new vaccin(ageRecommande, idBebe, nom, description, email, role, mdp,dateRenouvellement);

                    vaccins.add(vacc);
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
            return vaccins;
        }

        // Après l'exécution de la tâche en arrière-plan, cette méthode est appelée
        @Override
        protected void onPostExecute(ArrayList<vaccin> vaccins) {
            super.onPostExecute(vaccins);
            if (vaccins != null) {
                // Traite les résultats ici
                // Par exemple, mettre à jour l'UI avec les vaccins récupérés
                // Adapter pour afficher dans une ListView ou autre
                // Exemple : adapter.notifyDataSetChanged();
            } else {
                // Gérer les erreurs (afficher un message, etc.)
            }
        }
    }
















}

