//export LD_LIBRARY_PATH=`pwd`/SerialPortStream/dll/serialunix/bin/usr/local/lib:$LD_LIBRARY_PATH
//export LD_LIBRARY_PATH =`pwd`/SerialPortStream/dll/serialunix/bin/usr/local/lib:$LD_LIBRARY_PATH
using System;
using System.IO;
using RJCP.IO.Ports;
using MySql.Data.MySqlClient;
using System.Data.Common;

namespace Diplo
{
    class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Select port name from available port list:");
            foreach (string c in SerialPortStream.GetPortNames())
            {
                Console.WriteLine(c);
            }
            Console.WriteLine("///////////////////");
            string portName = Console.ReadLine();
            SerialPortStream myPort = null;
            string db_cfg = "";
            myPort = new SerialPortStream(portName, 9600, 8, Parity.None, StopBits.One);
            myPort.WriteTimeout = 100;
            myPort.ReadTimeout = 100;
            myPort.Open();
            Console.WriteLine("///////////////////");
            if (!myPort.IsOpen)
            {
                Console.WriteLine("Error opening serial port");
                return;
            }
            Console.WriteLine("Port open");
            if(!File.Exists("db.cfg"))
            {
            	Console.WriteLine("Config file not found");
            	File.WriteAllText("db.cfg","Server=localhost;Database=Diplom;User Id=root;password=4326");
        	}else
        	{
        		db_cfg = File.ReadAllText("db.cfg");
        		Console.WriteLine("Настройки подключения загружены");
        	}
            while (!Console.KeyAvailable)
            {
            	string buff ="";
                try
                {
                    buff = myPort.ReadLine();
                }catch { System.Threading.Thread.Sleep(30); };
                    if (buff!= "")
                    {
                        if (buff.Length > 3 && buff.Contains("req: "))
                        {

                            buff = buff.Replace(" ","");
                            if(buff.Length > 40)
                            continue;
                            buff = buff.Substring(4, buff.Length - 4 - 1);
                            string[] arg = buff.Split(';');
                            Console.WriteLine("request FROM: "+arg[0] + ", Identificator: " + arg[1]);
				            MySqlConnection connection = new MySqlConnection(db_cfg);
				            connection.Open();
                            string sql = "SELECT get_access('"+arg[1]+"','"+arg[0]+"') AS ACCESS;";
				            Console.WriteLine(sql);
				            MySqlCommand cmd = new MySqlCommand();
				            cmd.Connection = connection;
				            cmd.CommandText = sql;
				            string ans="";
				            DbDataReader reader = cmd.ExecuteReader();
				            if (reader.HasRows)
				            {

				                while(reader.Read())
				                {
									ans = reader.GetString(reader.GetOrdinal("ACCESS"));
								}
				                
				            }
				            connection.Close();
                            try
                			{
                				while(!myPort.CanWrite){}
                				string a = "Denied";
                				if(ans == "1") a = "Allowed"; 
                				Console.WriteLine("ACCESS: "+ a);
                				Console.WriteLine("ans:" + arg[0] + ";" + a + "\r\n");
                				myPort.Write("ans:" + arg[0] + ";" + a + "\r\n");
                				System.Threading.Thread.Sleep(10);
                				myPort.Flush();
                            }catch{Console.WriteLine(buff.Substring(0, buff.Length - 2) + " args[0]: " + arg[0] + " args[1]: " + arg[1]);};
                            buff = string.Empty;
                        }
                        else { buff = string.Empty; }
                    }
                
                
            }
            myPort.Close();
            
        }

    }
}