import serial
import webbrowser

# Adjust 'COM3' to your serial port (e.g., '/dev/ttyUSB0' on Linux or '/dev/tty.usbserial' on macOS)
ser = serial.Serial('/dev/tty.usbserial-0001', 9600)

while True:
    if ser.in_waiting > 0:
        url = ser.readline().decode('utf-8').strip()
        webbrowser.open(url)
