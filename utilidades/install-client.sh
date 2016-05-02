#! /usr/bin/env bash
echo "Comprobando archivos necesarios"
if [ -f logo-square.png ];
then
	sleep 3
	echo " Listo"
	echo "Copiando archivos necesarios"
	cp logo-square.png /usr/share/icons/colmena-square.png
	sleep 3
	echo " Listo"
	echo "Generando accesos directos"
	echo "[Desktop Entry]
	Comment=no comment
	Terminal=false
	Name=Colmena -SGTH
	Exec=google-chrome-stable http://colmena.uptaeb.edu.ve
	Type=Application
	Icon=/usr/share/icons/colmena-square.png
	Categories=Office;gtk;Qt;Gtk;
	Name[es_VE]=Colmena -SGTH
	" >> "/usr/share/applications/Colmena -SGTH.desktop"
	sleep 5
	echo " Listo"
	echo "El cliente Colmena -SGTH se ha instalado"
else
	sleep 3
	echo "Faltan los siguientes archivos necesarios para la instalación"
	echo "    logo-square.png"
fi

