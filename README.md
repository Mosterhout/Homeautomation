This is a project built using a Raspberry Pi 3b, 3 5v relays and DHT22 Arduino sensors

The goal is to replace my basic programmable thermostat with one I can control from my 
phone and expand on more home automation as I go. After the thermostat i will add in the
watering system


Distributor ID: Raspbian
Description:    Raspbian GNU/Linux 11 (bullseye)
Release:        11
Codename:       bullseye
HOME_URL="http://www.raspbian.org/"
SUPPORT_URL="http://www.raspbian.org/RaspbianForums"
BUG_REPORT_URL="http://www.raspbian.org/RaspbianBugs"

Web server: Apache2  2.4.38-3+deb10u4 with PHP

Scripts built using 
Python
Java
PHP

##Allowing PI user access to control GPIO pins, "RuntimeError: No access to /dev/mem.  Try running as root!"
You will need to make sure you are a member of the gpio group:
sudo adduser pi gpio

Check that /dev/gpiomem has the correct permissions:
chown root:gpio /dev/gpiomem
sudo chmod 660 /dev/gpiomem