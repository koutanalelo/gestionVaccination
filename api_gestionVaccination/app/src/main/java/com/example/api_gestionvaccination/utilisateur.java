package com.example.api_gestionvaccination;


public class utilisateur {

    private int id_user;
    private String nom,prenom,email,role,mdp;


    public utilisateur(int id_user, String nom, String prenom, String email, String role, String mdp) {
        this.id_user = id_user;
        this.nom = nom;
        this.prenom = prenom;
        this.email = email;
        this.role = role;
        this.mdp = mdp;
    }



    public utilisateur( String nom, String prenom, String email, String role, String mdp) {
        this.id_user = 0;
        this.nom = nom;
        this.prenom = prenom;
        this.email = email;
        this.role = role;
        this.mdp = mdp;
    }

    public int getId_user() {
        return id_user;
    }

    public void setId_user(int id_user) {
        this.id_user = id_user;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getPrenom() {
        return prenom;
    }

    public void setPrenom(String prenom) {
        this.prenom = prenom;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getRole() {
        return role;
    }

    public void setRole(String role) {
        this.role = role;
    }

    public String getMdp() {
        return mdp;
    }

    public void setMdp(String mdp) {
        this.mdp = mdp;
    }
}
