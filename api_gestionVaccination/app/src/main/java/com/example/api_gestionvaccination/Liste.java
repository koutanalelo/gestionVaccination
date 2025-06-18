package com.example.api_gestionvaccination;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;

import com.example.api_gestionvaccination.medecin;

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
import java.util.ArrayList;

public class Liste extends AppCompatActivity implements View.OnClickListener {
    private ListView sp ;
    private Button btRetour ;

    private static ArrayList<medecin> lesmedecins=null;

    public static ArrayList<medecin> getLesmedecins() {
        return lesmedecins;
    }

    public static void setLesmedecins(ArrayList<medecin> lesmedecins) {
        Liste.lesmedecins = lesmedecins;
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_liste);

        this.btRetour= (Button) findViewById(R.id.btRetour);
        this.sp = (ListView) findViewById(R.id.idSp);

        sp uneTache = new sp();
        uneTache.execute();
        if (lesmedecins != null) {
            ArrayList<String> lesmedecinsChaine = new ArrayList<>();
            //lesmedecinsChaine.add("medecin ajouter");
            for (medecin unmedecin : lesmedecins) {
                lesmedecinsChaine.add(unmedecin.getId_user() + "  " + unmedecin.getNum_ref());
            }
            ArrayAdapter unAdapter = new ArrayAdapter(this,
                    android.R.layout.activity_list_item, lesmedecinsChaine);
            this.sp.setAdapter(unAdapter);
        }
        this.btRetour.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        if (v.getId() == R.id.btRetour){
            Intent unIntent = new Intent(this, Menu.class);
            this.startActivity(unIntent);
        }
    }
}


class sp extends AsyncTask<Void, Void, ArrayList<medecin>  > {
    @Override
    protected ArrayList<medecin> doInBackground(Void... voids) {

        String url = "http://192.168.189.1/gestionvaccin/afficher_medecin.php";
        ArrayList<medecin> lesmedecins = new ArrayList<>();
        String resultatJSON = "";
        try{
            //ouverture d'une connexion HTTP
            URL uneURL = new URL(url);
            HttpURLConnection uneConnexion = (HttpURLConnection) uneURL.openConnection();
            //on fixe les parametres de la connexion avant ouverture
            uneConnexion.setRequestMethod("GET");
            uneConnexion.setDoInput(true);
            uneConnexion.setDoOutput(true);
            uneConnexion.setConnectTimeout(10000); //fermeture de la connexion
            uneConnexion.connect();
            //lecture des données à partir de la page VerifConnexion
            InputStream in = uneConnexion.getInputStream();
            //On utlise un buffer : zone texte
            BufferedReader br = new BufferedReader(new InputStreamReader(in, "UTF-8"));
            //lecture du JSON
            StringBuilder sb = new StringBuilder();
            String ligne = "";
            while ((ligne = br.readLine())!=null){
                //boucle de lecture des lignes JSON
                sb.append(ligne); //ajouter dans le tableau des chaines
            }
            resultatJSON = sb.toString();
            Log.e("JSON LU : ", resultatJSON);
        }
        catch (IOException exp ){
            Log.e("Erreur N1 : ", "Erreur de connexion a : " +url );
            exp.printStackTrace();
        }
        //parsing JSON du resultat
        try{
            JSONArray tabJson = new JSONArray(resultatJSON);
            for (int i = 0; i<tabJson.length(); i++) {
                JSONObject unObjet = tabJson.getJSONObject(i); //un seul objet à récupérer
                //instanciation d'une medecin récupérée
                medecin unmedecin = new medecin(
                        unObjet.getInt("id_user"),

                        unObjet.getInt("num_ref")
                );
                lesmedecins.add(unmedecin);
            }
        }
        catch(JSONException exp){
            Log.e("Erreur 2 : ", "Impossible de parser JSON"+resultatJSON);
            exp.printStackTrace();
        }
        return lesmedecins; //récupération des medecins
    }

    @Override
    protected void onPostExecute(ArrayList<medecin> lesmedecins) {
        super.onPostExecute(lesmedecins);
        Liste.setLesmedecins(lesmedecins); //on renseigne les medecins
    }


}
