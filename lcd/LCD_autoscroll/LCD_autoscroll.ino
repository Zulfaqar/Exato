#include <Wire.h>
#include <LCD.h>
#include <LiquidCrystal_I2C.h>

#define I2C_ADDR    0x3F  // Define I2C Address where the PCF8574A is
#define BACKLIGHT_PIN     3
#define En_pin  2
#define Rw_pin  1
#define Rs_pin  0
#define D4_pin  4
#define D5_pin  5
#define D6_pin  6
#define D7_pin  7

int n = 1;

LiquidCrystal_I2C  lcd(I2C_ADDR,En_pin,Rw_pin,Rs_pin,D4_pin,D5_pin,D6_pin,D7_pin);

void setup()
{
  lcd.begin (16,2);

  pinMode(13, OUTPUT);
  
// Switch on the backlight
  lcd.setBacklightPin(BACKLIGHT_PIN,POSITIVE);
  lcd.setBacklight(HIGH);         //depends to turn on or turn off the backlight
  //lcd.setBacklight(LOW);
  
  lcd.home ();                   // go home
          //"                "   LCD length-16
  //lcd.print("long text test dgdd drgdrgdr rgr");  
  //lcd.setCursor ( 0, 1 );        // go to the 2nd line
  //lcd.print("Goodluck for FYP");

}

void loop()
{
  /*lcd.setCursor (0,1); 
  lcd.scrollDisplayLeft();
  lcd.print("this is a long text for Arduino");
  delay(300);
  //lcd.noAutoscroll();delay(1000);*/

            /*lcd.clear();
            lcd.print("reading...");
            lcd.cursor();lcd.blink();
            delay(2000);
            lcd.noCursor();lcd.noBlink();*/
/*for (int i=3; i >= 0; i--)
{
  lcd.setCursor(0,0);
  lcd.print("www.tehnic.go.ro");
  lcd.setCursor(i, 1);
  lcd.print("by niq_ro ");
  delay(500);lcd.clear();
 }*/
String sms_text="ayam";
            for(int i=(sms_text.length()); i>=0; i--){
            lcd.clear();
            lcd.print("reading...");
            lcd.cursor();
            lcd.noCursor();
            lcd.setCursor(i,1);
            lcd.print(sms_text);
            delay(150);
            }
}
