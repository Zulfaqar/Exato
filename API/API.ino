#define FAN 9           // Output pin for fan

int ledPower = 12;
int samplingTime = 280;
int deltaTime = 40;
int sleepTime = 9680;

float voMeasured = 0;
float calcVoltage = 0;
float dustDensity = 0;

void setup(){
  Serial.begin(9600);
  pinMode(ledPower,OUTPUT);
  pinMode(FAN, OUTPUT);
}

void loop(){
  
  digitalWrite(ledPower,LOW); // power on the LED
  delayMicroseconds(samplingTime);

  voMeasured = analogRead(A5);// read the dust value
  
  delayMicroseconds(deltaTime);
  digitalWrite(ledPower,HIGH); // turn the LED off
  delayMicroseconds(sleepTime);

  // 0 - 5.0V mapped to 0 - 1023 integer values 
  calcVoltage = (voMeasured*(5.0/1024.0)); 
  
  Serial.print("API Value: ");
  Serial.print(voMeasured);
  Serial.println("ug/m3");
  
  Serial.print("Voltage: ");
  Serial.print(calcVoltage);
  Serial.println("V");
  Serial.println();

  if (voMeasured<50.00)
    analogWrite(FAN,0);
  else
    analogWrite(FAN,500);
  
  delay(3000);
}




