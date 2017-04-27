package entity;

import javax.persistence.*;

/**
 * Created by mohammed on 19/03/17.
 */
@Entity(name = "marchandises")
public class Marchandise {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer id;
    private String marchandise_nature;
    private String type;
    private String mode;
    private String groupe;
    private String term;
    private String destination;
    private String frequence;
    private String concurent;
    @ManyToOne
    private Client client;

    public Marchandise() {
    }

    public Marchandise(String marchandise_nature, String type, String mode, String groupe, String term, String destination, String frequence, String concurent) {
        this.marchandise_nature = marchandise_nature;
        this.type = type;
        this.mode = mode;
        this.groupe = groupe;
        this.term = term;
        this.destination = destination;
        this.frequence = frequence;
        this.concurent = concurent;

    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getMarchandise_nature() {
        return marchandise_nature;
    }

    public void setMarchandise_nature(String marchandise_nature) {
        this.marchandise_nature = marchandise_nature;
    }

    public String getGroupe() {
        return groupe;
    }

    public void setGroupe(String groupe) {
        this.groupe = groupe;
    }

    public String getDestination() {
        return destination;
    }

    public void setDestination(String destination) {
        this.destination = destination;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getMode() {
        return mode;
    }

    public void setMode(String mode) {
        this.mode = mode;
    }



    public String getTerm() {
        return term;
    }

    public void setTerm(String term) {
        this.term = term;
    }


    public String getFrequence() {
        return frequence;
    }

    public void setFrequence(String frequence) {
        this.frequence = frequence;
    }

    public String getConcurent() {
        return concurent;
    }

    public void setConcurent(String concurent) {
        this.concurent = concurent;
    }

    public Client getClient() {
        return client;
    }

    public void setClient(Client client) {
        this.client = client;
    }
}
