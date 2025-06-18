package com.example.api_gestionvaccination;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Locale;

public class CarnetVaccinationAdapter extends RecyclerView.Adapter<CarnetVaccinationAdapter.ViewHolder> {

    private List<carnetvaccination> carnetList;

    public CarnetVaccinationAdapter(List<carnetvaccination> carnetList) {
        this.carnetList = carnetList;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_carnet_vaccination, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        carnetvaccination carnet = carnetList.get(position);
        SimpleDateFormat sdf = new SimpleDateFormat("dd/MM/yyyy", Locale.getDefault());  // Format de la date
        holder.tvIdCarnet.setText("ID : " + carnet.getId_c());
        holder.tvStatut.setText("Statut : " + carnet.getStatut());
        holder.tvDateAdmin.setText("Date d'admin : " + sdf.format(carnet.getDate_administration()));
        holder.tvDateRappel.setText("Rappel : " + sdf.format(carnet.getRappel()));
    }

    @Override
    public int getItemCount() {
        return carnetList.size();
    }

    public static class ViewHolder extends RecyclerView.ViewHolder {
        TextView tvIdCarnet, tvStatut, tvDateAdmin, tvDateRappel;

        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            tvIdCarnet = itemView.findViewById(R.id.tvIdCarnet);
            tvStatut = itemView.findViewById(R.id.tvStatut);
            tvDateAdmin = itemView.findViewById(R.id.tvDateAdmin);
            tvDateRappel = itemView.findViewById(R.id.tvDateRappel);
        }
    }
}
