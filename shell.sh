#!/bin/bash

export rosa='\033[38;5;207m'
export rojo='\033[31m'
export verde='\033[32m'
export amarillo='\033[33m'
export azul='\033[34m'
export morado='\033[35m'
export blanco='\033[37m'
export cyan='\033[1;36m'
export magenta='\033[1;35m'
export negro='\033[0;30m'
export gris_oscuro='\033[1;30'

function shell {
	sleep 0.5
	clear
echo -e "${rojo}
 __        _           _       _          _ _ 
 \ \      | |         | |     | |        | | |
  \ \  ___| |__   __ _| |_ ___| |__   ___| | |
   - -/ __|  _ \ / _  | __/ __|  _ \ / _ \ | |
  / /| (__| | | | (_| | |_\__ \ | | |  __/ | |
 /_/  \___|_| |_|\__,_|\__|___/_| |_|\___|_|_|
  ______                                      
 |______| https://lpericena.blogspot.com/ "${blanco}
}
#
# CÓDIGO
#
while :
do
shell
echo -e -n "${verde}
┌═════════════════════════════════════┐
█ ${amarillo}SELECCIONA UNA OPCIÓN Y PULSA ENTER ${verde}█
└═════════════════════════════════════┘
┌═════════════════════════════════════════════════════════┐
█ [${blanco}1${verde}] ${blanco}Serveo       ${verde}┃ [${blanco}2${verde}] ${blanco}localhost.run     ${verde}┃ [${blanco}3${verde}] ${blanco}ngrok    ${verde}█
█═════════════════════════════════════════════════════════█
└═════════════════════════════════════════════════════════┘
┃
└═>>> "${blanco}
read -r Opcion_shell
[ "$Opcion_shell" == "1" ]||[ "$Opcion_shell" == "2" ]||[ "$Opcion_shell" == "3" ] && break

echo -e "${rojo}
┌═════════════════════┐
█ ${blanco}¡OPCIÓN INCORRECTA! ${rojo}█
└═════════════════════┘
"${blanco}
sleep 1.5
done

case $Opcion_shell in
	1)
		php -S localhost:8080 &>/dev/null &
		ssh -R 80:localhost:8080 serveo.net
		termux-open 
		;;
	2) 
		php -S localhost:8080 &>/dev/null &
        ngrok http 8080
		;;
	3)
	    php -S localhost:8080 &>/dev/null &
        ssh -R 80:localhost:8080 ssh.localhost.run
		termux-open 
		;;
	
esac

while :
do
echo -e -n "${verde}
┌═════════════════════════════════════┐
█ ${blanco}¿QUIERES USAR NUEVAMENTE EL SCRIPT? ${verde}█
└═════════════════════════════════════┘

┌═══════════════┐
█ [${blanco}1${verde}] ┃   ${blanco}SI    ${verde}█
█═══════════════█
█ [${blanco}2${verde}] ┃   ${blanco}NO    ${verde}█
└═══════════════┘
┃
└═>>> "${blanco}

read -r Opcion_Reiniciar

[ "$Opcion_Reiniciar" == "1" ]||[ "$Opcion_Reiniciar" == "2" ] && break
echo -e "${rojo}
┌═════════════════════┐
█ ${blanco}¡OPCIÓN INCORRECTA! ${rojo}█
└═════════════════════┘
"${blanco}
sleep 2
clear
done

case $Opcion_Reiniciar in
	1)
		source $HOME/shell/shell.sh
		;;
	2)
echo -e "${verde}
┌════════════════════════════════┐
█ ${blanco}PARA USAR NUEVAMENTE EL SCRIPT ${verde}█
█ ${blanco}EJECUTE EL COMANDO ./shell.sh ${verde}█
└════════════════════════════════┘
"${blanco}
esac
