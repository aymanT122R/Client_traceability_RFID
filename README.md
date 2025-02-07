# RFID-Based Client Traceability System

This project integrates RFID technology with C++ and PHP to enhance client traceability, ensuring efficient tracking and seamless data management for optimal client service. The system uses an MFRC522 RFID reader, ESP32 microcontroller, and a web-based frontend built with PHP. The backend is powered by C++, and the data is managed using MySQL via phpMyAdmin.

<img src="https://github.com/aymanT122R/Client_traceability_RFID/blob/main/image/architecture.png" width="100%">


## Table of Contents
- [Project Overview](#project-overview)
- [Technologies Used](#technologies-used)
- [Hardware Requirements](#hardware-requirements)
- [Software Requirements](#software-requirements)
- [Setup Instructions](#setup-instructions)
  - [Backend (C++)](#backend-c)
  - [Frontend (PHP)](#frontend-php)
  - [Database (MySQL)](#database-mysql)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Project Overview
The system is designed to track clients using RFID tags. When an RFID tag is scanned by the MFRC522 reader connected to the ESP32, the unique ID of the tag is sent to the backend (C++). The backend processes the data and stores it in a MySQL database. The PHP frontend retrieves and displays the data, providing a user-friendly interface for managing and tracking clients.

## Technologies Used
- **Hardware**:
  - MFRC522 RFID Reader
  - ESP32 Microcontroller
  - RFID Tags
- **Backend**:
  - C++ (for ESP32 programming)
- **Frontend**:
  - PHP
  - HTML/CSS
  - JavaScript (optional for enhanced UI)
- **Database**:
  - MySQL (managed via phpMyAdmin)
- **Web Server**:
  - Apache

## Hardware Requirements
- ESP32 Development Board
- MFRC522 RFID Reader Module
- RFID Tags/Cards
- Jumper Wires
- Power Supply for ESP32

## Software Requirements
- Arduino IDE (for ESP32 programming)
- XAMPP/WAMP/LAMP (for local server setup)
- phpMyAdmin (for MySQL database management)
- Web Browser (for accessing the PHP frontend)

## Setup Instructions

### Backend (C++)
1. **Install Arduino IDE**:
   - Download and install the Arduino IDE from [Arduino's official website](https://www.arduino.cc/en/software).
   - Add ESP32 support to the Arduino IDE by following [this guide](https://docs.espressif.com/projects/arduino-esp32/en/latest/installing.html).

2. **Install MFRC522 Library**:
   - Open Arduino IDE, go to `Sketch` -> `Include Library` -> `Manage Libraries`.
   - Search for `MFRC522` and install the library by Miguel Balboa.

3. **Upload Code to ESP32**:
   - Open the C++ code from the `C++_backend` folder in the Arduino IDE.
   - Connect your ESP32 to your computer via USB.
   - Select the correct board and port in the Arduino IDE (`Tools` -> `Board` -> `ESP32 Dev Module` and `Tools` -> `Port`).
   - Upload the code to the ESP32.

4. **Test the RFID Reader**:
   - Open the Serial Monitor in the Arduino IDE (`Tools` -> `Serial Monitor`).
   - Scan an RFID tag to ensure the ESP32 is reading and sending the tag ID correctly.

### Frontend (PHP)
1. **Set Up Local Server**:
   - Install XAMPP/WAMP/LAMP to set up a local server environment.
   - Start Apache and MySQL services.

2. **Import Database**:
   - Open phpMyAdmin (`http://localhost/phpmyadmin`).
   - Create a new database (e.g., `rfid_tracking`).
   - Import the SQL file from the `Php_frontend/database` folder into the newly created database.

3. **Deploy PHP Files**:
   - Copy the contents of the `Php_frontend` folder to the `htdocs` directory of your local server (e.g., `C:\xampp\htdocs\` for XAMPP).
   - Ensure the PHP files are correctly configured to connect to the MySQL database (update database credentials in `config.php` if necessary).

4. **Access the Frontend**:
   - Open a web browser and navigate to `http://localhost/Php_frontend` to access the PHP frontend.

### Database (MySQL)
- The database schema includes tables for storing RFID tag IDs, client information, and timestamps of scans.
- Ensure the database is properly configured to receive data from the ESP32 backend.

## Usage
1. **Scan RFID Tags**:
   - Use the MFRC522 RFID reader to scan client RFID tags.
   - The ESP32 will send the tag ID to the backend, which will store it in the MySQL database.

2. **View and Manage Data**:
   - Access the PHP frontend to view client data, track scan history, and manage client information.

## Contributing
Contributions are welcome! If you'd like to contribute, please follow these steps:
1. Fork the repository.
2. Create a new branch for your feature or bugfix.
3. Commit your changes.
4. Submit a pull request.

## License
This project is licensed under the MIT License. 

---

For any questions or issues, feel free to open an issue on GitHub or contact the project maintainer.
