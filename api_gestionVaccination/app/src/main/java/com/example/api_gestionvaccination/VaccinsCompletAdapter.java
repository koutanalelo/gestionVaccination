package com.example.api_gestionvaccination;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;
import android.util.Log;

import java.text.SimpleDateFormat;
import java.util.ArrayList;

public class VaccinsCompletAdapter extends BaseAdapter {

    private Context context;
    private ArrayList<vaccin> vaccins;

    // Constructeur qui prend une liste de vaccins
    public VaccinsCompletAdapter(Context context, ArrayList<vaccin> vaccins) {
        this.context = context;
        this.vaccins = vaccins;
    }

    @Override
    public int getCount() {
        return vaccins.size();
    }

    @Override
    public Object getItem(int position) {
        return vaccins.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = LayoutInflater.from(context).inflate(R.layout.item_complet_vaccin, parent, false);
        }

        // Récupérer l'objet vaccin à afficher
        vaccin vaccin = vaccins.get(position);

        // Initialisation des TextViews
        TextView nomVaccin = convertView.findViewById(R.id.textViewNom);
        TextView descriptionVaccin = convertView.findViewById(R.id.textViewDescription);
        TextView ageRecommandeVaccin = convertView.findViewById(R.id.textViewAgeRecommande);
        TextView idBebeVaccin = convertView.findViewById(R.id.textViewIdBebe);
        TextView emailVaccin = convertView.findViewById(R.id.textViewEmail);
        TextView roleVaccin = convertView.findViewById(R.id.textViewRole);
        TextView mdpVaccin = convertView.findViewById(R.id.textViewMdp);
        TextView dateRenouvellementVaccin = convertView.findViewById(R.id.textViewDateRenouvellement);

        // Remplir les TextViews avec les données du vaccin
        nomVaccin.setText("Nom : " + vaccin.getNom());
        descriptionVaccin.setText("Description : " + vaccin.getDescription());
        ageRecommandeVaccin.setText("Âge recommandé : " + vaccin.getAge_recommande() + " ans");
        idBebeVaccin.setText("ID Bébé : " + vaccin.getId_bebe());
        emailVaccin.setText("Email : " + vaccin.getEmail());
        roleVaccin.setText("Rôle : " + vaccin.getRole());
        mdpVaccin.setText("Mot de passe : " + vaccin.getMdp());

        // Gestion de la date de renouvellement
        if (vaccin.getDate_renouvellement() != null) {
            // Formater la date de renouvellement
            SimpleDateFormat sdf = new SimpleDateFormat("dd/MM/yyyy");
            String formattedDate = sdf.format(vaccin.getDate_renouvellement());
            dateRenouvellementVaccin.setText("Date de renouvellement : " + formattedDate);
        } else {
            dateRenouvellementVaccin.setText("Date de renouvellement : Non spécifiée");
        }

        return convertView;
    }
}
