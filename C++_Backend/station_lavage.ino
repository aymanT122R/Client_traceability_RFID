#include <WiFi.h>
#include <HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>

// Replace with your network credentials (Wi-Fi SSID and password)
const char* ssid = "YOUR_SSID_WIFI";
const char* password = "PASSWORD";

// Replace with your server's IP address and the path to your PHP scripts
String serverName1 = "http://localhost/post-esp-data.php";

// API key value (same as in PHP)
String apiKeyValue = "YOUR_API_KEY";

// RFID setup
#define SS_PIN 5   // Select pin for MFRC522
#define RST_PIN 0  // Reset pin for MFRC522
MFRC522 mfrc522(SS_PIN, RST_PIN); // Create MFRC522 instance

void setup() {
  // Start serial communication for debugging
  Serial.begin(115200);

  // Setup SPI bus for MFRC522
  SPI.begin();     
  mfrc522.PCD_Init();  
  Serial.println("RFID reader initialized");

  // Connect to Wi-Fi network
  WiFi.begin(ssid, password);
  Serial.println("Connecting to WiFi...");

  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("Connected to WiFi network.");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  // Look for new RFID cards
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    Serial.println("RFID Card detected");

    // Convert UID to a string
    String uidString = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      uidString += String(mfrc522.uid.uidByte[i], HEX);
    }
    uidString.toUpperCase(); // Convert to uppercase for consistency
    Serial.print("UID Tag: ");
    Serial.println(uidString);

    // Check if connected to Wi-Fi
    if (WiFi.status() == WL_CONNECTED) {
      
      // Send data to the first server (post-esp-data.php)
      sendDataToServer(serverName1, uidString);
      
      // Send data to the second server (final.php)
      //sendDataToServer(serverName2, uidString);
      
    } else {
      Serial.println("WiFi Disconnected");
    }

    // Delay before next read to avoid repeated scans
    delay(2000);
  }
}

// Function to send POST data to a given server
void sendDataToServer(String server, String uidString) {
  HTTPClient http;

  // Start connection and send HTTP header
  http.begin(server);

  // Specify content type header (application/x-www-form-urlencoded)
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  // Create the HTTP POST data with the API key and UID tag
  String httpRequestData = "api_key=" + apiKeyValue + "&uid=" + uidString;
  Serial.print("Sending data to ");
  Serial.println(server);
  Serial.println(httpRequestData);

  // Send HTTP POST request
  int httpResponseCode = http.POST(httpRequestData);

  // Check the response code
  if (httpResponseCode > 0) {
    // Get the response from the server
    String response = http.getString();
    Serial.println("HTTP Response code: " + String(httpResponseCode));
    //Serial.println("Response from server: " + response);
  } else {
    // If the request failed
    Serial.print("Error on sending POST: ");
    Serial.println(httpResponseCode);
  }

  // Free the resources
  http.end();
}
