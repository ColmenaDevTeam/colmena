#! /usr/bin/env python
"""
@author: Elias David Peraza[tes1oner]
@licence: GPLv3 http://opensource.org/licenses/gpl-3.0.html
"""
import sys
#from utils import *
import commands
def get_str_fileconf(domain, folder):
    str_conf_file="""<VirtualHost *:80>
	# The ServerName directive sets the request scheme, hostname and port that
	# the server uses to identify itself. This is used when creating
	# redirection URLs. In the context of virtual hosts, the ServerName
	# specifies what hostname must appear in the request's Host: header to
	# match this virtual host. For the default virtual host (this file) this
	# value is not decisive as it is used as a last resort host regardless.
	# However, you must set it for any further virtual host explicitly.


	ServerAdmin webmaster@"""+domain+"""
	ServerName """+domain+"""
	ServerAlias www."""+domain+"""
	DocumentRoot \""""+folder+"""\"

	# Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
	# error, crit, alert, emerg.
	# It is also possible to configure the loglevel for particular
	# modules, e.g.
	#LogLevel info ssl:warn

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined

	# For most configuration files from conf-available/, which are
	# enabled or disabled at a global level, it is possible to
	# include a line for only one particular virtual host. For example the
	# following line enables the CGI configuration for this host only
	# after it has been globally disabled with "a2disconf".
	#Include conf-available/serve-cgi-bin.conf
</VirtualHost>

# vim: syntax=apache ts=4 sw=4 sts=4 sr noet"""
    return str_conf_file
def get_filelines_in_array(filedir):
    try:
        file = open(filedir, "r")
        line = "init"
        array = []
        while(line != ""):
            line = file.readline()
            array.append(line)
        file.close()
    except:
        print("Error inesperado:", sys.exc_info()[0])
    return array


def set_forzing_host(domain, ip="127.0.0.1"):
    try:
        exists = False
        file = open("/etc/hosts", "r")
        line = "init"
        while(line != ""):
            line = file.readline()
            if(domain in line and line[0] != "#"):
                print domain+" existe en: "+line
                exists = True
                break
        file.close()
        if(exists == True):
            return False
        else:
            lines = get_filelines_in_array("/etc/hosts")
            try:
                file = open("/etc/hosts", "w")
                content = ""
                for line in lines:
                    content = content +line#+"\n"
                content = content + ip+" "+domain+"\n"
                file.writelines(content)
                #file.writeline(domain+" "+ip)
                file.close()
            except:
                print("Error al escribir datos:", sys.exc_info()[0])
                return False
        return True
    except:
        print("Error inesperado:", sys.exc_info()[0])
        return False

def create_virtualhost(domain, folder):
    try:
        file = open("/etc/apache2/sites-available/"+domain+".conf", "w")
        file.write(get_str_fileconf(domain, folder))
        file.close()
        if(set_forzing_host(domain)):
            return True
        else:
            print "El host fue creado pero el forzamiento de HOST tuvo error"
            return False
    except:
        print("Error inesperado:", sys.exc_info()[0])
        raise
        return False
def main():
    if(sys.argv[1] == None or sys.argv[1] == "-h" or sys.argv[1] == "-help" or sys.argv[1] == "help"):
        show_help()
        return 0
    #if(create_new):
    domain = sys.argv[1]
    folder = sys.argv[2]
    add_virtual_host(domain, folder)
def show_help():
    string_help = "Esta aplicacion se encuentra en fase alpha, por lo que por ahora solo permite agregar "
    string_help +="VirtualHost. Tipee el siguiente comando:\n\"avh.py sudominio.ext /ruta/a/su/proyecto\"\npara crear un nuevo VirtualHost de su "
    string_help +=" proyecto.\nLimitaciones:\n* Requiere trabajar con Apache 2"
    string_help += "\n* Solo permita acceso al equipo actual(No a otros en red)\n* No permite borrar VirtualHosts, para ello debe hacerlo manualmente"
    print string_help
def add_virtual_host(domain, folder):
    create_virtualhost(domain, folder)
    print("Creando los cambios en apache")

    print "Agregando sitio a apache"
    result_apache = commands.getoutput("a2ensite "+domain+".conf")
    print result_apache

    print "Recargando apache"
    result_apache = commands.getoutput("service apache2 reload")
    print result_apache

    #print "Reiniciando apache"
    #result_apache = commands.getoutput("service apache2 restart")
    #print result_apache
if __name__ == "__main__":
    main()
