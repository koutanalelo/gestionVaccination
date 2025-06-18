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

// Liste de vaccins du bébé
public class VaccinsAdapter extends BaseAdapter {

    private Context context;
    private JSONArray vaccins;

    public VaccinsAdapter(Context context, JSONArray vaccins) {
        this.context = context;
        this.vaccins = vaccins;
    }

    @Override
    public int getCount() {
        return vaccins.length();
    }

    @Override
    public Object getItem(int position) {
        try {
            return vaccins.getJSONObject(position);
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
        if (convertView == null) {
            convertView = LayoutInflater.from(context).inflate(R.layout.item_vaccin, parent, false);
        }

        try {
            JSONObject vaccin = vaccins.getJSONObject(position);

            // Initialiser les TextViews du layout personnalisé
            TextView nomVaccin = convertView.findViewById(R.id.nomVaccin);
            TextView descriptionVaccin = convertView.findViewById(R.id.descriptionVaccin);
            TextView ageRecommandeVaccin = convertView.findViewById(R.id.ageRecommandeVaccin);
            TextView idBebeVaccin = convertView.findViewById(R.id.idBebeVaccin);
            TextView emailVaccin = convertView.findViewById(R.id.emailVaccin);
            TextView roleVaccin = convertView.findViewById(R.id.roleVaccin);
            TextView mdpVaccin = convertView.findViewById(R.id.mdpVaccin);
            TextView dateRenouvellementVaccin = convertView.findViewById(R.id.dateRenouvellementVaccin);

            // Remplir les TextViews avec les données JSON
            nomVaccin.setText("Nom : " + vaccin.getString("nom"));
            descriptionVaccin.setText("Description : " + vaccin.getString("description"));
            ageRecommandeVaccin.setText("Âge recommandé : " + vaccin.getInt("age_recommande") + " ans");

            // Masquer les champs sensibles (email, rôle, mot de passe et ID bébé)
            idBebeVaccin.setVisibility(View.GONE);  // Masquer l'ID bébé
            emailVaccin.setVisibility(View.GONE);   // Masquer l'email
            roleVaccin.setVisibility(View.GONE);    // Masquer le rôle
            mdpVaccin.setVisibility(View.GONE);     // Masquer le mot de passe

            // Afficher ou masquer la date de renouvellement en fonction de son existence
            if (vaccin.has("date_renouvellement")) {
                dateRenouvellementVaccin.setVisibility(View.VISIBLE); // Assurer que la date de renouvellement est visible
                dateRenouvellementVaccin.setText("Date de renouvellement : " + vaccin.getString("date_renouvellement"));
            } else {
                dateRenouvellementVaccin.setVisibility(View.VISIBLE); // Assurer que la date est visible même si elle est absente
                dateRenouvellementVaccin.setText("Date de renouvellement : Non spécifiée");
            }

        } catch (JSONException e) {
            e.printStackTrace();
        }

        return convertView;
    }
}
