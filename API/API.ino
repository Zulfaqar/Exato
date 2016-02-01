/* 
*  Arduino, Temp, Humidity, WiFi, MySQL and Highcharts remixed by Tim Scott
*  From a Simple WiFi weather station with Arduino, the DHT11 sensor & the CC3000 chip 
*  Writtent by Marco Schwartz for Open Home Automation
*  https://learn.adafruit.com/wifi-weather-station-arduino-cc3000/introduction
*  Part of the code is based on the work done by Adafruit on the CC3000 chip & the DHT11 sensor
*  https://learn.adafruit.com/adafruit-cc3000-wifi
*/

// Include required libraries
#include <Adafruit_CC3000.h>
#include <SPI.h>
#include <SHT1x.h>
#include<stdlib.h>


// Define CC3000 chip pins
#define ADAFRUIT_CC3000_IRQ   3
#define ADAFRUIT_CC3000_VBAT  5
#define ADAFRUIT_CC3000_CS    10

// WiFi network (change with your settings !)
#define WLAN_SSID       "TP-LINK"        // cannot be longer than 32 characters!
#define WLAN_PASS       "passwordtooshort"
#define WLAN_SECURITY   WLAN_SEC_WPA2 // This can be WLAN_SEC_UNSEC, WLAN_SEC_WEP, WLAN_SEC_WPA or WLAN_SEC_WPA2

// Specify data and clock connections and instantiate SHT1x object
#define dataPin  9
#define clockPin 8
SHT1x sht1x(dataPin, clockPin);
static char tempapi[10];
static char tempvolt[10];

//Sensor and Fan instances

int ledPower = 12;
int samplingTime = 280;
int deltaTime = 40;
int sleepTime = 9680;

float voMeasured = 0;
float calcVoltage = 0;
int FAN = 7;

// Create CC3000 & DHT instances

Adafruit_CC3000 cc3000 = Adafruit_CC3000(ADAFRUIT_CC3000_CS, ADAFRUIT_CC3000_IRQ, ADAFRUIT_CC3000_VBAT,SPI_CLOCK_DIV2);
                                         
// Local server IP, port, and repository (change with your settings !)
uint32_t ip = cc3000.IP2U32(192,168,1,104);//your computers ip address
int port = 80;//your webserver port (8888 is the default for MAMP)
String repository = "/exato/";//the folder on your webserver where the sensor.php file is located
                                         
void setup(void)
{
  Serial.begin(9600);
  pinMode(ledPower,OUTPUT);
  pinMode(FAN, OUTPUT);
    
  // Initialise the CC3000 module
  if (!cc3000.begin())
  {
    while(1);
  }

  // Connect to  WiFi network
  cc3000.connectToAP(WLAN_SSID, WLAN_PASS, WLAN_SECURITY);
  Serial.println("Connected to WiFi network!");
    
  // Check DHCP
  Serial.println(F("Request DHCP"));
  while (!cc3000.checkDHCP())
  {
    delay(100);
  }  
  
}

void loop(void)
{
    digitalWrite(ledPower,LOW); // power on the LED
    delayMicroseconds(samplingTime);

    voMeasured = analogRead(A5);// read the dust value

    delayMicroseconds(deltaTime);
    digitalWrite(ledPower,HIGH); // turn the LED off
    delayMicroseconds(sleepTime);

    // 0 - 5.0V mapped to 0 - 1023 integer values 
    calcVoltage = (voMeasured*(5.0/1024.0)); 

    if (voMeasured>50.00)
    digitalWrite(FAN,HIGH);
  else
    digitalWrite(FAN,LOW);
    
  
    // Measure the humidity & temperature
//    float temp_c = sht1x.readTemperatureC();
//    float humid = sht1x.readHumidity();
     
    // Transform to String
//    dtostrf(temp_c,6, 2, tempbuffer);
//    dtostrf(humid,6, 2, humidbuffer);
//    String temperature = tempbuffer;
//    temperature.trim();
//    String humidity = humidbuffer;
//    humidity.trim();

    // Print data
    Serial.print("API: ");
    Serial.println(voMeasured);
    Serial.print("Voltage: ");
    Serial.println(calcVoltage);
    Serial.println("");

     
    
    // Send request
    String request = "GET "+ repository + "sensor.php?temp=" + voMeasured + "&hum=" + calcVoltage + " HTTP/1.0";
    send_request(request);
    Serial.println("");
    Serial.print("request: ");
    Serial.println(request);
    Serial.println("");
    // Update every 30 seconds
    
    delay(30000);
}

// Function to send a TCP request and get the result as a string
void send_request (String request) {
     
    // Connect    
    Serial.println("Starting connection to server...");
    Adafruit_CC3000_Client client = cc3000.connectTCP(ip, port);
    
    // Send request
    if (client.connected()) {
      client.println(request);      
      client.println(F(""));
      Serial.println("Connected & Data sent");
    } 
    else {
      Serial.println(F("Connection failed"));    
    }

    while (client.connected()) {
      while (client.available()) {

      // Read answer
      char c = client.read();
      }
    }
    Serial.println("Closing connection");
    Serial.println("");
    client.close();
    
}
