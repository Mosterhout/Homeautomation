#!/usr/bin/env python3
import os
import time
import pigpio


# this connects to the pigpio daemon which must be started first
pi = pigpio.pi()

#Main hallway sensor files
main_cur_temp_f = '/var/www/html/sensor/main_cur_temp_f.txt'
set_cool = '/var/www/html/set_input/set_cool.txt'
set_heat = '/var/www/html/set_input/set_heat.txt'
systemstate = '/var/www/html/state/systemstate.txt'

file_array = [main_cur_temp_f, set_cool, set_heat, systemstate]

for file in file_array:
	if(os.path.exists(file)):
		print(file,"exists")
	else:
		print(file,"does not exist")
		file = open (file, "x")

while True:
	#Read variables in from files
    systemstate_file = open(systemstate, "r")
    state = systemstate_file.read(2)
        
    
    #system state 0=off, 1=Auto, 2=Heat, 3=Cool
    if state == "0":
        print("0=off")
        cur_temp_file = open(main_cur_temp_f, "r")
        cur_temp = cur_temp_file.read(2)
    elif state == "1":
        print("1=Auto")
        cur_temp_file = open(main_cur_temp_f, "r")
        cur_temp = cur_temp_file.read(2)
    elif state == "2":
        print("2=Heat")
        cur_temp_file = open(main_cur_temp_f, "r")
        cur_temp = cur_temp_file.read(2)
    elif state == "3":
        print("3=Cool")
        cur_temp_file = open(main_cur_temp_f, "r")
        cur_temp = cur_temp_file.read(2)
    

    
    print(cur_temp)
    time.sleep(5) # Necessary on faster Raspberry Pi's or it casues strage loop issues