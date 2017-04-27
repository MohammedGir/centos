package entity;



import javax.persistence.*;
import java.util.ArrayList;
import java.util.Collection;


/**
 * Created by mohammed on 19/03/17.
 */
@Entity(name = "clients")
public class Client {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String call_id;
    private String agent_name;
    private String begin_date;
    private String client_nature;
    private String joignable;
    private String qualification;
    private String numbers;
    @OneToMany(mappedBy = "client", cascade = CascadeType.ALL, orphanRemoval = true)
    private Collection<Marchandise> marchandises = new ArrayList<>();
    public Client() {
    }

    public Client(String call_id, String agent_name, String begin_date, String clien_nature, String joignable, String qualification, String number) {
        this.call_id = call_id;
        this.agent_name = agent_name;
        this.begin_date = begin_date;
        this.client_nature = clien_nature;
        this.joignable = joignable;
        this.qualification = qualification;
        this.numbers = number;
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getCall_id() {
        return call_id;
    }

    public void setCall_id(String call_id) {
        this.call_id = call_id;
    }

    public String getAgent_name() {
        return agent_name;
    }

    public void setAgent_name(String agent_name) {
        this.agent_name = agent_name;
    }

    public String getBegin_date() {
        return begin_date;
    }

    public void setBegin_date(String begin_date) {
        this.begin_date = begin_date;
    }

    public String getClient_nature() {
        return client_nature;
    }

    public void setClient_nature(String clien_nature) {
        this.client_nature = clien_nature;
    }

    public String getNumbers() {
        return numbers;
    }

    public void setNumbers(String number) {
        this.numbers = number;
    }

    public String getJoignable() {
        return joignable;
    }

    public void setJoignable(String joignable) {
        this.joignable = joignable;
    }

    public String getQualification() {
        return qualification;
    }

    public void setQualification(String qualification) {
        this.qualification = qualification;
    }

    public Collection<Marchandise> getMarchandises() {
        return marchandises;
    }

    public void setMarchandises(Collection<Marchandise> marchandises) {
        this.marchandises = marchandises;
    }
    public void addMarchadise(Marchandise marchandise){
        marchandises.add(marchandise);
        marchandise.setClient(this);
    }
}
