package com.example.api_gestionvaccination;

import java.util.Date;

public class carnetvaccination {
    private int id_c, id_medecin,  id_bebe,id_vaccin;
    private Date rappel,  date_administration;
    private String statut;


    public carnetvaccination(int id_c, int id_medecin, int id_bebe, int id_vaccin, Date rappel, Date date_administration, String statut) {
        this.id_c = id_c;
        this.id_medecin = id_medecin;
        this.id_bebe = id_bebe;
        this.id_vaccin = id_vaccin;
        this.rappel = rappel;
        this.date_administration = date_administration;
        this.statut = statut;
    }

    public carnetvaccination( int id_medecin, int id_bebe, int id_vaccin, Date rappel, Date date_administration, String statut) {
        this.id_c = 0;
        this.id_medecin = id_medecin;
        this.id_bebe = id_bebe;
        this.id_vaccin = id_vaccin;
        this.rappel = rappel;
        this.date_administration = date_administration;
        this.statut = statut;
    }

    public int getId_c() {
        return id_c;
    }

    public void setId_c(int id_c) {
        this.id_c = id_c;
    }

    public int getId_medecin() {
        return id_medecin;
    }

    public void setId_medecin(int id_medecin) {
        this.id_medecin = id_medecin;
    }

    public int getId_bebe() {
        return id_bebe;
    }

    public void setId_bebe(int id_bebe) {
        this.id_bebe = id_bebe;
    }

    public int getId_vaccin() {
        return id_vaccin;
    }

    public void setId_vaccin(int id_vaccin) {
        this.id_vaccin = id_vaccin;
    }

    public Date getRappel() {
        return rappel;
    }

    public void setRappel(Date rappel) {
        this.rappel = rappel;
    }

    public Date getDate_administration() {
        return date_administration;
    }

    public void setDate_administration(Date date_administration) {
        this.date_administration = date_administration;
    }

    public String getStatut() {
        return statut;
    }

    public void setStatut(String statut) {
        this.statut = statut;
    }
}
