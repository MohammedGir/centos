package Session;

import entity.Client;
import org.hibernate.SessionFactory;
import org.hibernate.boot.registry.StandardServiceRegistryBuilder;
import org.hibernate.cfg.Configuration;
import org.hibernate.service.ServiceRegistry;

import java.io.FileReader;
import java.util.Properties;

/**
 * Created by mohammed on 20/03/17.
 */
public class HibernateUtil {
    private static SessionFactory sessionFactory;
    private  static FileReader reader;
    private static Properties p;
    public  static void getProperty(){
        try {
            reader = new FileReader("file.properties");
            p = new Properties();
            p.load(reader);
            System.out.println(p.getProperty("test"));
        }catch (Exception e){
            e.printStackTrace();
        }

    }

    public static SessionFactory getSessionFactory() {
        if (sessionFactory == null) {
            HibernateUtil.getProperty();
            // loads configuration and mappings
            Configuration configuration = new Configuration();
            configuration.addAnnotatedClass(entity.Client.class);
            configuration.addAnnotatedClass(entity.Marchandise.class);
            configuration.setProperty("hibernate.connection.driver_class",p.getProperty("connection.driver_class"))
                    .setProperty("hibernate.connection.url",p.getProperty("connection.url"))
                    .setProperty("hibernate.dialect",p.getProperty("dialect"))
                    .setProperty("hibernate.connection.username",p.getProperty("connection.username"))
                    .setProperty("hibernate.connection.password",p.getProperty("connection.password"))
                    .setProperty("hibernate.hbm2ddl.auto",p.getProperty("hbm2ddl.auto"))
                    .setProperty("hibernate.show_sql",p.getProperty("show_sql"))
                    .setProperty("hibernate.format_sql",p.getProperty("format_sql"));
//            configuration.configure();
//            ServiceRegistry serviceRegistry
//                    = new StandardServiceRegistryBuilder()
//                    .applySettings(configuration.getProperties()).build();

            // builds a session factory from the service registry (buildSessionFactory(serviceRegistry))
            sessionFactory = configuration.buildSessionFactory();
        }

        return sessionFactory;
    }
}
