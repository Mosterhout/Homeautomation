#!/usr/bin/env python3
import os
import time
from meteocalc import Temp, dew_point, heat_index, wind_chill, feels_like
import /opt/thermostate/pigpio
import /opt/thermostate/DHT22

# this connects to the pigpio daemon which must be started first
pi = pigpio.pi()

#Main hallway sensor files
main_cur_temp_f = '/var/www/html/sensor/main_cur_temp_f.txt'
main_cur_temp_c = '/var/www/html/sensor/main_cur_temp_c.txt'
main_temp_cal = '/var/www/html/settings/main_temp_calabration_f.txt'

#Outdoor sensor files
od_cur_temp_f = '/var/www/html/sensor/od_cur_temp_f.txt'
od_cur_temp_c = '/var/www/html/sensor/od_cur_temp_c.txt'
od_temp_cal = '/var/www/html/settings/od_temp_calabration_f.txt'

file_array = [main_cur_temp_f, main_cur_temp_c, main_temp_cal, od_cur_temp_f, od_cur_temp_c, od_temp_cal]

for file in file_array:
	if(os.path.exists(file)):
		print(file,"exists")
	else:
		print(file,"does not exist")
		file = open (file, "x")
while True: #This loop will always be true and loop every 5 seconds
	#Read variables in from files
    main_f_offset_file = open(main_temp_cal, "r")
    main_f_offset = main_f_offset_file.read()
	
    time.sleep(5) # Necessary on faster Raspberry Pi's or it casues strage loop issues