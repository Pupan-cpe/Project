/*****************************************************************************************
  #Design and development factory of recycling management through the internet of thing

  #ComputerEngineering Faculty OF Engineering NakhonPhanomUniversity 
  
  #Pupan Phonkaew 593030710044
 *****************************************************************************************/
#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <SoftwareSerial.h>
#include <IotWebConf.h>

#include <ArduinoJson.h>
// #include <BlynkSimpleEsp8266.h>

#include "index.h" //Our HTML webpage contents with javascripts
#define CONFIG_VERSION "dem1"
// -- When CONFIG_PIN is pulled to ground on startup, the Thing will use the initial
//      password to buld an AP. (E.g. in case of lost password)
//#define CONFIG_PIN D2
// -- Status indicator pin.
//      First it will light up (kept LOW), on Wifi connection it will blink,
//      when connected to the Wifi it will turn off (kept HIGH).
//#define STATUS_PIN LED_BUILTIN
const char thingName[] = "scale";
const char wifiInitialApPassword[] = "12345678";

DNSServer dnsServer;
WebServer server(80);
HTTPUpdateServer httpUpdater;
String enrollID;
IotWebConf iotWebConf(thingName, &dnsServer, &server, wifiInitialApPassword, CONFIG_VERSION);
SoftwareSerial swSer(D1, D2);
String rs232input1;
String Website, data, Javascript, XML;
// BlynkTimer timer;

#define LED 2 //On board LED

//===============================================================
// This routine is executed when you open its IP in browser
//===============================================================
void WebsiteContent()
{
  if (data == "")
  {
    Serial.println("Unable to contact the scale");

    data = "Unable to contact the scale";
  }
  else
  {
  }

  server.sendHeader("access-control-allow-origin", "*");
  server.send(200, "text/html", data);
}
void handleRoot2()
{
  // -- Let IotWebConf test and handle captive portal requests.
  if (iotWebConf.handleCaptivePortal())
  {
    // -- Captive portal request were already served.
    return;
  }
  String s = "<!DOCTYPE html><html lang=\"en\"><head><meta name=\"viewport\" content=\"width=device-width, initial-scale=1, user-scalable=no\"/>";
  s += "<title>IotWebConf 04 Update Server</title></head><body>Hello world!";
  s += "Go to <a href='config'>configure page</a> to change values.";
  s += "</body></html>\n";

  server.send(200, "text/html", s);
}

void handleRoot()
{
  String s = MAIN_page;             //Read HTML contents
  server.send(200, "text/html", s); //Send web page
}

void handleADC()
{
  String a = rs232input1;
  String adcValue = a;
  digitalWrite(LED, !digitalRead(LED));     //Toggle LED on data request ajax
  server.send(200, "text/plane", adcValue); //Send ADC value only to client ajax request
}
void handle_NotFound()
{
  server.send(404, "text/plain", "404 Not found.");
}
//==============================================================
//                  SETUP
//==============================================================
void setup()
{
  Serial.begin(115200);
  swSer.begin(9600);

  //Connect to your WiFi router
  Serial.println("");

  //Onboard LED port Direction output
  pinMode(LED, OUTPUT);

  iotWebConf.setupUpdateServer(&httpUpdater);
  iotWebConf.getApTimeoutParameter()->visible = true;
  // iotWebConf.setWifiConnectionTimeoutMs(&httpUpdater);
  // -- Initializing the configuration.
  iotWebConf.init();
  //timer.setInterval(300L, WebsiteContent);
  Serial.println("\nSoftware serial test started");
  server.on("/getscale", WebsiteContent);
  // server.on("/", );
  server.on("/config", [] { iotWebConf.handleConfig(); });

  server.onNotFound(handle_NotFound);
  Serial.println("HTTP server started");

  server.on("/", handleRoot);       //Which routine to handle at root location. This is display page
  server.on("/readADC", handleADC); //This page is called by java Script AJAX

  server.begin(); //Start server
  Serial.println("HTTP server started");

  for (char ch = ' '; ch <= 'z'; ch++)
  { //send serially a to z on so ftware serial
    swSer.write(ch);
  }
  swSer.println("");
}
//==============================================================
//                     LOOP
//==============================================================
void loop()
{

  iotWebConf.doLoop();
  server.handleClient();
  data = "";
 
  if (swSer.available() > 0)
  {
    rs232input1 = swSer.readStringUntil('\n');
    //Serial.println(rs232input1);
    int strindex = rs232input1.indexOf('=');
    int endindex = rs232input1.indexOf('(');
    rs232input1 = rs232input1.substring(strindex + 1, endindex);
    DynamicJsonDocument root(100);
    root["scale"] = String(rs232input1);
    serializeJson(root, data);
   // Serial.println(data);
  }
}