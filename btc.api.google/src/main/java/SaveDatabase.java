import entity.Client;
import Session.HibernateUtil;
import java.util.ArrayList;
import java.util.List;
import java.util.Objects;

import entity.Marchandise;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.Transaction;
import org.hibernate.cfg.Configuration;

/**
 * Created by mohammed on 19/03/17.
 */
public class SaveDatabase {
    public  static void save(List<List<Object>> values) throws Exception{
        SessionFactory sessionFactory = HibernateUtil.getSessionFactory();
        Session session = sessionFactory.openSession();
        Transaction tr = session.beginTransaction();
        System.out.println("!-------------- Begin Sauvegarde-------------------!");
        List<Marchandise> marchandises = new ArrayList<>();

        for (List row: values) {
            // Recuper Client Record
            Client client = new Client((String)row.get(1),(String) row.get(2),(String) row.get(0),(String) row.get(4),
                 (String) row.get(3),(String) row.get(56),(String) row.get(55));
             // Recupere Marchandise Record
            Marchandise marchandise =new Marchandise((String) row.get(5),(String) row.get(6),(String) row.get(7),
                    (String) row.get(8),(String) row.get(9), (String) row.get(10),(String) row.get(11)+""+(String) row.get(12),
                    (String) row.get(13));
            client.addMarchadise(marchandise);

               for(int i=1;i<5;i++){
                    int index = i*10;
                   String check = ((String) row.get(index+4)).toUpperCase();
                   System.out.println("----------------"+check+"---------------");
                   if(check.contains("OUI")){
                             Marchandise marchandise1 = new Marchandise((String) row.get(index+5),(String) row.get(index+6),(String) row.get(index+7),
                            (String) row.get(index+8),(String) row.get(index+9), (String) row.get(index+10),(String) row.get(index+11)+" "+(String) row.get(index+12),
                            (String) row.get(index+13));
                    client.addMarchadise(marchandise1);
                   }
                }
            session.save(client);

        }
        tr.commit();
        System.out.println("!--------------------Successfully inserted-----------------!");
        sessionFactory.close();
        System.out.println("!--------------------SessionFactory Closed ---------------- !");

    }
}
