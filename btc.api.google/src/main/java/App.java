
import Session.HibernateUtil;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileReader;
import java.io.InputStream;
import java.util.Properties;
import java.util.Timer;

/**
 * Created by mohammed on 19/03/17.
 */
public class App {
    public static void main(String[] args){
       try {
//           System.out.println(App.class.getResource("").getPath()+"resources/");

           File file = new File("file.properties");
           System.out.println(file.getAbsoluteFile());
           InputStream reader = new FileInputStream(file);
           Properties p = new Properties();
           p.load(reader);
           System.out.println(p.getProperty("test"));
           Quickstart quickstart = new Quickstart();
           quickstart.getRecord(p.getProperty("spreadsheetId"));
       }catch (Exception e){
           e.printStackTrace();
       }
    }
}
