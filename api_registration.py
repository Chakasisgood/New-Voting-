# MAC INI
# from flask import Flask
# import webbrowser

# app = Flask(__name__)

# @app.route('/open')
# def open_browser():
#     print("Attempting to open browser...")
#     webbrowser.open("http://192.168.1.9/votesystem/signup.php")
#     return "Browser opened"

# if __name__ == '__main__':
#     app.run(host='0.0.0.0', port=5002)


# Galaxy Ini

from flask import Flask
import webbrowser

app = Flask(__name__)

@app.route('/open')
def open_browser():
    print("Attempting to open browser...")
    webbrowser.open("http://192.168.43.160/votesystem/")
    return "Browser opened"

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5002)