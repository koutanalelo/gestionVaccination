package com.example.api_gestionvaccination;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

public class Menu extends AppCompatActivity implements View.OnClickListener {

    private Button btAjout, btDeconnexion, btListe, btProfil, btCn,btAddB,btr,btm,btRetour,profi;
    private int id_user;
    @SuppressLint("MissingInflatedId")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu);

        this.id_user=Integer.parseInt(getIntent().getStringExtra("id_user"));
        profi=findViewById(R.id.idProfilBebe);
        btAddB = findViewById(R.id.idAddBebe);
         btr=findViewById(R.id.btnBebe);
         btm=findViewById(R.id.buttonModifierProfil);
         btRetour=findViewById(R.id.buttonRetourMenu);
        btAjout = findViewById(R.id.idAdd);
        btListe = findViewById(R.id.idC);
        btCn = findViewById(R.id.idCn);
        btDeconnexion = findViewById(R.id.idDeconnexion);
        btProfil = findViewById(R.id.idProfil);

        btAddB.setOnClickListener(this);

        btAddB.setOnClickListener(this);
        profi.setOnClickListener(this);
        btAjout.setOnClickListener(this);
        btListe.setOnClickListener(this);
        btCn.setOnClickListener(this);
        btDeconnexion.setOnClickListener(this);
        btProfil.setOnClickListener(this);
        btAddB.setOnClickListener(this);

    }

    @Override
    public void onClick(View v) {
        Intent unIntent = null;

        if (v.getId() == R.id.idAdd) {
            unIntent = new Intent(this,  ListeBebesActivity.class);
        }
        //liste des vaccins
        else if (v.getId() == R.id.idC) {
            unIntent = new Intent(this, ListeVaccinsActivity.class);
        } else if (v.getId() == R.id.idProfil) {
            unIntent = new Intent(this, VaccinCompletActivity.class);
        } else if (v.getId() == R.id.idDeconnexion) {
            Toast.makeText(this, "Vous etes deconnecter maintenant,Merci d'avoir utilisé cette application", Toast.LENGTH_LONG).show();
            unIntent = new Intent(this, MainActivity.class);
        }
        else if (v.getId() == R.id.idCn) {
            unIntent = new Intent(this, AfficherCarnetsActivity.class);

        }
        //PAGE AJOUT DU BEBE

        else if (v.getId() == R.id.idAddBebe) {
            unIntent = new Intent(this, Ajout.class);

        }
        //PAGE DE PROFIL
        else if (v.getId() == R.id.idProfilBebe) {
            unIntent = new Intent(this,ProfilBebeActivity.class);
            unIntent.putExtra("id_user", this.id_user+"");
        }
      //dans profil bebe le bouton d'ajout

        else if (v.getId() == R.id.btnBebe) {
            unIntent = new Intent(this,Ajout.class);

        }
        //dans profil bebe le bouton MODIFIER

       else if (v.getId() == R.id. buttonModifierProfil) {
            unIntent = new Intent(this,ModifierProfilBebeActivity.class);

        }

       //BOUTON DE RETOUR AU MENU

        else if (v.getId() == R.id.buttonRetourMenu) {
            unIntent = new Intent(this,Menu.class);

        }


        // Vérifier si unIntent n'est pas null avant de démarrer l'activité
        if (unIntent != null) {
            startActivity(unIntent);
        }
    }





}
