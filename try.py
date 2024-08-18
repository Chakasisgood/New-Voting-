import serial
import webbrowser
from serial import SerialException

# Replace '/dev/tty.usbserial-XXXX' with your serial port
SERIAL_PORT = '/dev/tty.usbserial-0001'
BAUD_RATE = 9600

def open_url_from_serial(SERIAL_PORT, BAUD_RATE):
    try:
        ser = serial.Serial(SERIAL_PORT, BAUD_RATE, timeout=1)
    except SerialException as e:
        print(f"Could not open serial port: {e}")
        return

    print("Listening for URL commands...")

    while True:
        try:
            line = ser.readline().decode('utf-8').strip()
            if line.startswith("URL:"):
                url = line.replace("URL:", "").strip()
                print(f"Opening URL: {url}")
                try:
                    webbrowser.open(url)
                except Exception as e:
                    print(f"Failed to open URL: {e}")
        except SerialException as e:
            print(f"Error reading from serial port: {e}")
            break
        except KeyboardInterrupt:
            print("Interrupted by user.")
            break

if __name__ == "__main__":
    open_url_from_serial(SERIAL_PORT, BAUD_RATE)
