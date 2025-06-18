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

public class BebesAdapter extends BaseAdapter {

    private Context context;
    private JSONArray bebess;

    public BebesAdapter(Context context, JSONArray bebess) {
        this.context = context;
        this.bebess = bebess;
    }

    @Override
    public int getCount() {
        return bebess.length();
    }

    @Override
    public Object getItem(int position) {
        try {
            return bebess.getJSONObject(position);
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
            convertView = LayoutInflater.from(context).inflate(android.R.layout.simple_list_item_2, parent, false);
        }

        try {
            JSONObject bebe = bebess.getJSONObject(position);
            TextView text1 = convertView.findViewById(android.R.id.text1);
            TextView text2 = convertView.findViewById(android.R.id.text2);

            // Afficher le nom et prénom du bébé
            text1.setText(bebe.getString("nom") + " " + bebe.getString("prenom"));
            // Afficher la date de naissance
            text2.setText("Date de naissance: " + bebe.getString("date_naissance"));
        } catch (JSONException e) {
            e.printStackTrace();
        }

        return convertView;
    }
}
