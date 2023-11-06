#!/usr/bin/env python3
import RPi.GPIO as GPIO
import time
gpiopin=10
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
GPIO.setup(gpiopin,GPIO.OUT)
print("LED on")
GPIO.output(gpiopin,GPIO.HIGH)
time.sleep(2)
print("LED off")
GPIO.output(gpiopin,GPIO.LOW)
