#!/usr/bin/env python3
import os
import time
from meteocalc import Temp, dew_point, heat_index, wind_chill, feels_like
import pigpio
import DHT22

# this connects to the pigpio daemon which must be started first
pi = pigpio.pi()
# Pigpio DHT22 module should be in same folder as your program or a imported directory
main_dht = DHT22.sensor(pi, 27)
od_dht = DHT22.sensor(pi, 22)

#Main hallway sensor files
main_cur_temp_f = '/var/www/html/sensor/main_cur_temp_f.txt'
main_cur_temp_c = '/var/www/html/sensor/main_cur_temp_c.txt'
main_cur_hum = '/var/www/html/sensor/main_cur_humidity.txt'
main_cur_feels = '/var/www/html/sensor/main_cur_feels_f.txt'
main_temp_cal = '/var/www/html/settings/main_temp_calabration_f.txt'
main_hum_cal = '/var/www/html/settings/main_hum_calabration_f.txt'

#Outdoor sensor files
od_cur_temp_f = '/var/www/html/sensor/od_cur_temp_f.txt'
od_cur_temp_c = '/var/www/html/sensor/od_cur_temp_c.txt'
od_cur_hum = '/var/www/html/sensor/od_cur_humidity.txt'
od_cur_feels = '/var/www/html/sensor/od_cur_feels_f.txt'
od_temp_cal = '/var/www/html/settings/od_temp_calabration_f.txt'
od_hum_cal = '/var/www/html/settings/od_hum_calabration_f.txt'

file_array = [main_cur_temp_f, main_cur_temp_c, main_cur_hum, main_cur_feels, main_temp_cal, main_hum_cal, od_cur_temp_f, od_cur_temp_c, od_cur_hum, od_cur_feels, od_temp_cal, od_hum_cal]



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
    main_hum_offset_file = open(main_hum_cal, "r")
    main_hum_offset = main_hum_offset_file.read()

    od_f_offset_file = open(od_temp_cal, "r")
    od_f_offset = od_f_offset_file.read()
    od_hum_offset_file = open(od_hum_cal, "r")
    od_hum_offset = od_hum_offset_file.read()

    main_dht.trigger()
    od_dht.trigger()
    time.sleep(.04)
    main_humidity, main_c_temp = (main_dht.humidity(), main_dht.temperature())
    main_f_temp = (((main_c_temp * 9) / 5) + 32)
    main_f_temp += float(main_f_offset)
    #main_humidity += 1.8 #adjustment for the sensor bell curve
    main_humidity += float(main_hum_offset)
    main_hi = heat_index(temperature=main_f_temp, humidity=main_humidity)
    
    od_humidity, od_c_temp = (od_dht.humidity(), od_dht.temperature())
    od_f_temp = (((od_c_temp * 9) / 5) + 32)
    od_f_temp += float(od_f_offset)
    #od_humidity -= 1.8 #adjustment for the sensor bell curve
    od_humidity += float(od_hum_offset)
    
    od_hi = heat_index(temperature=od_f_temp, humidity=od_humidity)

    #Write main to files
    print(main_f_temp)
    print(main_c_temp)
    print(main_hi)
    f = open(main_cur_temp_f, 'w')
    f.write(str(main_f_temp)[:5])
    f.close()

    f = open(main_cur_temp_c, 'w')
    f.write(str(main_c_temp)[:5])
    f.close()

    f = open(main_cur_hum, 'w')
    f.write(str(main_humidity)[:5])
    f.close()

    f = open(main_cur_feels, 'w')
    f.write(str(main_hi)[:5])
    f.close()

    #Write od to files
    print(od_f_temp)
    print(od_c_temp)
    print(od_hi)
    f = open(od_cur_temp_f, 'w')
    f.write(str(od_f_temp)[:5])
    f.close()

    f = open(od_cur_hum, 'w')
    f.write(str(od_humidity)[:5])
    f.close()

    f = open(od_cur_temp_c, 'w')
    f.write(str(od_c_temp)[:5])
    f.close()

    f = open(od_cur_feels, 'w')
    f.write(str(od_hi)[:5])
    f.close()

    print("Inside reading")
    print("Temp={0:0.1f}C  Humidity={1:0.1f}%".format(main_c_temp, main_humidity))
    print("Temp:{0:0.1f}F Humidity:{1:0.1f}%".format(main_f_temp, main_humidity))
    print("Feelslike: {0:0.1f}F".format(main_hi.f))

    print("Outside reading")
    print("Temp={0:0.1f}C  Humidity={1:0.1f}%".format(od_c_temp, od_humidity))
    print("Temp:{0:0.1f}F Humidity:{1:0.1f}%".format(od_f_temp, od_humidity))
    print("Feelslike: {0:0.1f}F".format(od_hi.f))
    print("##############")
    print("##############")
    time.sleep(5) # Necessary on faster Raspberry Pi's or it casues strage loop issues
