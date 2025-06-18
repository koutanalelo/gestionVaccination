package com.example.api_gestionvaccination;


public class medecin {
    private int id_medecin,id_user,num_ref;

    public medecin(int id_medecin, int id_user, int num_ref) {
        this.id_medecin = id_medecin;
        this.id_user = id_user;
        this.num_ref = num_ref;
    }
    public medecin( int id_user, int num_ref) {
        this.id_medecin = 0;
        this.id_user = id_user;
        this.num_ref = num_ref;
    }

    public int getId_medecin() {
        return id_medecin;
    }

    public void setId_medecin(int id_medecin) {
        this.id_medecin = id_medecin;
    }

    public int getId_user() {
        return id_user;
    }

    public void setId_user(int id_user) {
        this.id_user = id_user;
    }

    public int getNum_ref() {
        return num_ref;
    }

    public void setNum_ref(int num_ref) {
        this.num_ref = num_ref;
    }
}
