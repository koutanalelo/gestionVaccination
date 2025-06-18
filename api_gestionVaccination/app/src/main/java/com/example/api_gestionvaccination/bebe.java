package com.example.api_gestionvaccination;


import java.util.Date;

public class bebe {
    private int id_bebe,id_user;
    private String nom,prenom,email,role,mdp;
    private Date date_naissance;
    private Double poid,taille;

    public bebe(int id_bebe, int id_user, String nom, String prenom, String email, String role, String mdp, Date date_naissance, Double poid, Double taille) {
        this.id_bebe = id_bebe;
        this.id_user = id_user;
        this.nom = nom;
        this.prenom = prenom;
        this.email = email;
        this.role = role;
        this.mdp = mdp;
        this.date_naissance = date_naissance;
        this.poid = poid;
        this.taille = taille;
    }
    public bebe( int id_user, String nom, String prenom, String email, String role, String mdp, Date date_naissance, Double poid, Double taille) {
        this.id_bebe = 0;
        this.id_user = id_user;
        this.nom = nom;
        this.prenom = prenom;
        this.email = email;
        this.role = role;
        this.mdp = mdp;
        this.date_naissance = date_naissance;
        this.poid = poid;
        this.taille = taille;
    }

    public int getId_bebe() {
        return id_bebe;
    }

    public void setId_bebe(int id_bebe) {
        this.id_bebe = id_bebe;
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

    public Date getDate_naissance() {
        return date_naissance;
    }

    public void setDate_naissance(Date date_naissance) {
        this.date_naissance = date_naissance;
    }

    public Double getPoid() {
        return poid;
    }

    public void setPoid(Double poid) {
        this.poid = poid;
    }

    public Double getTaille() {
        return taille;
    }

    public void setTaille(Double taille) {
        this.taille = taille;
    }
}
