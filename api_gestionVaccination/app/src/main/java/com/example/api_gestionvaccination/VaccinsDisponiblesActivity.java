package com.example.api_gestionvaccination;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class VaccinsDisponiblesActivity extends BaseAdapter {

    private Context context;
    private JSONArray vaccinsDisponibles; // Vaccins disponibles (présents)
    private JSONArray vaccinsAVenir; // Vaccins à venir

    // Constructeur de l'adaptateur
    // Constructeur
    public void VaccinsCompletAdapter(Context context, JSONArray vaccinsDisponibles, JSONArray vaccinsAVenir) {
        this.context = context;
        this.vaccinsDisponibles = vaccinsDisponibles;
        this.vaccinsAVenir = vaccinsAVenir;
    }


    @Override
    public int getCount() {
        // Calculer le nombre total de vaccins (disponibles + à venir)
        return vaccinsDisponibles.length() + vaccinsAVenir.length();
    }

    @Override
    public Object getItem(int position) {
        try {
            // Retourner le vaccin approprié (disponible ou à venir)
            if (position < vaccinsDisponibles.length()) {
                return vaccinsDisponibles.getJSONObject(position);
            } else {
                return vaccinsAVenir.getJSONObject(position - vaccinsDisponibles.length());
            }
        } catch (JSONException e) {
            e.printStackTrace();
            return null;
        }
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        // Si la vue est nulle, on l'inflate à partir du layout
        if (convertView == null) {
            convertView = LayoutInflater.from(context).inflate(R.layout.item_complet_vaccin, parent, false);
        }

        try {
            JSONObject vaccin;

            // Calculer la catégorie du vaccin (disponible ou à venir)
            if (position < vaccinsDisponibles.length()) {
                vaccin = vaccinsDisponibles.getJSONObject(position);
            } else {
                vaccin = vaccinsAVenir.getJSONObject(position - vaccinsDisponibles.length());
            }

            // Initialiser les TextViews du layout personnalisé
            TextView nomVaccin = convertView.findViewById(R.id.textViewNom);
            TextView descriptionVaccin = convertView.findViewById(R.id.textViewDescription);
            TextView ageRecommandeVaccin = convertView.findViewById(R.id.textViewAgeRecommande);
            TextView idBebeVaccin = convertView.findViewById(R.id.textViewIdBebe);
            TextView emailVaccin = convertView.findViewById(R.id.textViewEmail);
            TextView roleVaccin = convertView.findViewById(R.id.textViewRole);
            TextView mdpVaccin = convertView.findViewById(R.id.textViewMdp);
            TextView dateRenouvellementVaccin = convertView.findViewById(R.id.textViewDateRenouvellement);

            // Remplir les TextViews avec les données du vaccin
            nomVaccin.setText("Nom : " + vaccin.getString("nom"));
            descriptionVaccin.setText("Description : " + vaccin.getString("description"));
            ageRecommandeVaccin.setText("Âge recommandé : " + vaccin.getInt("age_recommande") + " ans");
            idBebeVaccin.setText("ID Bébé : " + vaccin.getInt("id_bebe"));
            emailVaccin.setText("Email : " + vaccin.getString("email"));
            roleVaccin.setText("Rôle : " + vaccin.getString("role"));
            mdpVaccin.setText("Mot de passe : " + vaccin.getString("mdp"));

            // Afficher la date de renouvellement si elle existe
            if (vaccin.has("date_renouvellement")) {
                dateRenouvellementVaccin.setText("Date de renouvellement : " + vaccin.getString("date_renouvellement"));
            } else {
                dateRenouvellementVaccin.setText("Date de renouvellement : Non spécifiée");
            }

        } catch (JSONException e) {
            e.printStackTrace();
        }

        return convertView;
    }
}
