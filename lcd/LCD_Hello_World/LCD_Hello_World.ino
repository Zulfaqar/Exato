#include <Wire.h>
//#include <LCD.h>
#include <LiquidCrystal_I2C.h>

#define I2C_ADDR    0x27  // Define I2C Address where the PCF8574A is
#define BACKLIGHT_PIN     3
#define En_pin  2
#define Rw_pin  1
#define Rs_pin  0
#define D4_pin  4
#define D5_pin  5
#define D6_pin  6
#define D7_pin  7
#define echoPin 11 // Echo Pin
#define trigPin 12 // Trigger Pin

int n = 1;

long duration, distance; // Duration used to calculate distance

LiquidCrystal_I2C  lcd(I2C_ADDR,En_pin,Rw_pin,Rs_pin,D4_pin,D5_pin,D6_pin,D7_pin);

void setup()
{
  lcd.begin (16,2);
 pinMode(trigPin, OUTPUT);
 pinMode(echoPin, INPUT);
  //pinMode(13, OUTPUT);
  
// Switch on the backlight
  lcd.setBacklightPin(BACKLIGHT_PIN,POSITIVE);
  lcd.setBacklight(HIGH);         //depends to turn on or turn off the backlight
  //lcd.setBacklight(LOW);
  
  lcd.home ();                   // go home
          //"                "   LCD length-16
  lcd.print("   Hai all :)   ");  
  lcd.setCursor ( 0, 1 );        // go to the 2nd line
  //lcd.print("Goodluck for FYP");
delay(1000);
}

void loop()
{
  // Backlight on/off every 3 seconds
  lcd.clear();
  lcd.setCursor (13,2);        // go col 14 of line 3
  //lcd.print(n++,DEC);
  //digitalWrite(13, HIGH);
  //delay(1000);
  //digitalWrite(13, LOW);
  //delay(1000);

  digitalWrite(trigPin, LOW);
 delayMicroseconds(2);
 
 digitalWrite(trigPin, HIGH);
 delayMicroseconds(10);
 
 digitalWrite(trigPin, LOW);
 duration = pulseIn(echoPin, HIGH);
 
 //Calculate the distance (in cm) based on the speed of sound.
 distance = duration/58.2;
 
 lcd.print(distance);
 
 delay(500);
}
