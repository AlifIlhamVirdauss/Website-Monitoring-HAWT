#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "KPU ATAS";
const char* pass = "87654321";
const char* server = "http://192.168.100.11";
const long jeda = 5000;

unsigned long previousMillis = 0;

WiFiClient client;
HTTPClient http;

void setup() {
  Serial.begin(9600);

  // KONEKSI WIFI
  WiFi.begin(ssid, pass);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("TERHUBUNG");
}

void loop() {
  unsigned long currentMillis = millis();

  if (currentMillis - previousMillis > jeda) {
    previousMillis = currentMillis;

    if (WiFi.status() == WL_CONNECTED) {
      float arus = random(1, 10); // Data sensor arus random
      float tegangan = random(100, 200); // Data sensor tegangan random
      int rpm = random(1000, 2000); // Data sensor rpm random

      String url = String(server) + "/hawt/input.php?data_sensor_arus=" + String(arus) +
                   "&data_sensor_tegangan=" + String(tegangan) +
                   "&data_sensor_rpm=" + String(rpm);

      Serial.println(url);

      http.begin(client, url);
      int httpCode = http.GET();

      if (httpCode > 0) {
        String payload = http.getString();
        Serial.println(payload);
      }

      http.end();
    }
  }
}
