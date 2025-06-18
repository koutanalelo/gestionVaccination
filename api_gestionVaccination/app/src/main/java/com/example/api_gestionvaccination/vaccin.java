package com.example.api_gestionvaccination;


import java.util.Date;

public class vaccin {
    private int id_vaccin,age_recommande,  id_bebe;
    private String nom,description,email,role,mdp;
    private Date date_renouvellement;

    public vaccin(int id_vaccin, int age_recommande, int id_bebe, String nom, String description, String email, String role, String mdp, Date date_renouvellement) {
        this.id_vaccin = id_vaccin;
        this.age_recommande = age_recommande;
        this.id_bebe = id_bebe;
        this.nom = nom;
        this.description = description;
        this.email = email;
        this.role = role;
        this.mdp = mdp;
        this.date_renouvellement = date_renouvellement;
    }

    public vaccin( int age_recommande, int id_bebe, String nom, String description, String email, String role, String mdp, Date date_renouvellement) {
        this.id_vaccin = 0;
        this.age_recommande = age_recommande;
        this.id_bebe = id_bebe;
        this.nom = nom;
        this.description = description;
        this.email = email;
        this.role = role;
        this.mdp = mdp;
        this.date_renouvellement = date_renouvellement;
    }

    public int getId_vaccin() {
        return id_vaccin;
    }

    public void setId_vaccin(int id_vaccin) {
        this.id_vaccin = id_vaccin;
    }

    public int getAge_recommande() {
        return age_recommande;
    }

    public void setAge_recommande(int age_recommande) {
        this.age_recommande = age_recommande;
    }

    public int getId_bebe() {
        return id_bebe;
    }

    public void setId_bebe(int id_bebe) {
        this.id_bebe = id_bebe;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
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

    public Date getDate_renouvellement() {
        return date_renouvellement;
    }

    public void setDate_renouvellement(Date date_renouvellement) {
        this.date_renouvellement = date_renouvellement;
    }
}
