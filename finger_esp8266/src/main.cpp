/***************************************************
 This is my project 
 Pupan Phonkaew | 593030710044
 Computer Engineering |Faculty of Engingeering NakhonPhanom University
 
 ****************************************************/
#include <Arduino.h>
#include <IotWebConf.h>
#include <U8g2lib.h>
#include <ESP8266WiFi.h>
#include <Adafruit_Fingerprint.h>
#include <ArduinoJson.h>
#include <SPI.h>
#include <BlynkSimpleEsp8266.h>

BlynkTimer timer;

U8G2_SSD1309_128X64_NONAME0_F_4W_SW_SPI u8g2(U8G2_R0, /* clock=*/D5, /* data=*/D7, /* cs=*/D6, /* dc=*/D8, /* reset=*/D1);
const char thingName[] = "Finger";
int FingerID;
int cnt1;
IPAddress ip;

String send, wifiip;
String timeout, timeout1;
// -- Initial password to connect to the Thing, when it creates an own Access Point.
const char wifiInitialApPassword[] = "12345678";

// -- Configuration specific key. The value should be modified if config structure was changed.
#define CONFIG_VERSION "dem1"

// -- When CONFIG_PIN is pulled to ground on startup, the Thing will use the initial
//      password to buld an AP. (E.g. in case of lost password)
#define CONFIG_PIN D2

// -- Status indicator pin.
//      First it will light up (kept LOW), on Wifi connection it will blink,
//      when connected to the Wifi it will turn off (kept HIGH).
#define STATUS_PIN LED_BUILTIN
String JsonDatascale;
String Website, data, XML, Javascript;
String status2, status;
DNSServer dnsServer;
WebServer server(80);
HTTPUpdateServer httpUpdater;
String enrollID;
IotWebConf iotWebConf(thingName, &dnsServer, &server, wifiInitialApPassword, CONFIG_VERSION);

// On Leonardo/Micro or others with hardware serial, use those! #0 is green wire, #1 is white
// uncomment this line:
// #define mySerial Serial1

// For UNO and others without hardware serial, we must use software serial...
// pin #2 is IN from sensor (GREEN wire)
// pin #3 is OUT from arduino  (WHITE wire)
// comment these two lines if using hardware serial
SoftwareSerial mySerial(D3, D4);

Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);
uint16_t id;
int cnt = 0;
String sendID;

// uint16_t readnumber(void)
// {
//   uint16_t num = 0;

//   while (num == 0)
//   {
//     while (!Serial.available())
//       ;
//     num = Serial.parseInt();
//   }
//   return num;
// }

void checkinternet()
{

  if (WiFi.status() != WL_CONNECTED)
  {
    u8g2.clearBuffer();                           // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr);           // choose a suitable font
    u8g2.drawStr(0, 30, "Waiting for Internet."); // write something to the internal memory
    u8g2.sendBuffer();

    u8g2.clearBuffer();                             // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr);             // choose a suitable font
    u8g2.drawStr(0, 30, "Waiting for Internet..."); // write something to the internal memory
    u8g2.sendBuffer();
  }
  else
  {
    String myip = WiFi.localIP().toString();
    u8g2.clearBuffer();                 // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
    u8g2.drawStr(40, 30, "Ready !");
    u8g2.setFont(u8g2_font_5x7_tr);
     u8g2.drawStr(30, 50, "IP:");
    u8g2.drawStr(30, 50, myip.c_str());
    // write something to the internal memory    // write something to the internal memory
    u8g2.sendBuffer();
  }
}
void ipshow()
{
}

//---------------------enroll ------------------------------------

uint16_t getFingerprintEnroll()
{
  cnt1 = 0;
  int p = -1;
  Serial.print("Waiting for valid finger to enroll as #");
  Serial.println(id);
  while (p != FINGERPRINT_OK)
  {
    p = finger.getImage();
    switch (p)
    {
    case FINGERPRINT_OK:
      Serial.println("Image taken");
      break;
    case FINGERPRINT_NOFINGER:
      cnt1++;
      Serial.println(".");
      Serial.println(cnt1);
      Serial.println("Scan now #1");

      u8g2.clearBuffer();                  // clear the internal memory
      u8g2.setFont(u8g2_font_ncenB08_tr);  // choose a suitable font
      u8g2.drawStr(30, 30, "Scan Now #1"); // write something to the internal memory
      u8g2.sendBuffer();

      if (cnt1 == 30)
      {
        Serial.println("Time out");
        status2 = "Time Out";

        u8g2.clearBuffer();                 // clear the internal memory
        u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
        u8g2.drawStr(30, 30, "Time Out");   // write something to the internal memory
        u8g2.sendBuffer();
        delay(1500);
        u8g2.clearBuffer();                 // clear the internal memory
        u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
        u8g2.drawStr(30, 30, "");           // write something to the internal memory
        u8g2.sendBuffer();
        return p;
      }

      break;

    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      break;
    default:
      Serial.println("Unknown error");
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(1);
  switch (p)
  {
  case FINGERPRINT_OK:
    Serial.println("Image converted");
    break;
  case FINGERPRINT_IMAGEMESS:
    Serial.println("Image too messy");
    return p;
  case FINGERPRINT_PACKETRECIEVEERR:
    Serial.println("Communication error");
    return p;
  case FINGERPRINT_FEATUREFAIL:
    Serial.println("Could not find fingerprint features");
    return p;
  case FINGERPRINT_INVALIDIMAGE:
    Serial.println("Could not find fingerprint features");
    return p;
  default:
    Serial.println("Unknown error");
    return p;
  }

  Serial.println("Remove finger");
  delay(2000);
  p = 0;
  while (p != FINGERPRINT_NOFINGER)
  {
    p = finger.getImage();
  }
  Serial.print("ID ");
  Serial.println(id);
  p = -1;
  Serial.println("Place same finger again");
  while (p != FINGERPRINT_OK)
  {
    p = finger.getImage();
    switch (p)
    {
    case FINGERPRINT_OK:
      Serial.println("Image taken");
      break;
    case FINGERPRINT_NOFINGER:
      Serial.print(".");
      Serial.println("Scan now #2");
      u8g2.clearBuffer();                  // clear the internal memory
      u8g2.setFont(u8g2_font_ncenB08_tr);  // choose a suitable font
      u8g2.drawStr(30, 30, "Scan Now #2"); // write something to the internal memory
      u8g2.sendBuffer();

      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      break;
    default:
      Serial.println("Unknown error");
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(2);
  switch (p)
  {
  case FINGERPRINT_OK:
    Serial.println("Image converted");
    break;
  case FINGERPRINT_IMAGEMESS:
    Serial.println("Image too messy");
    return p;
  case FINGERPRINT_PACKETRECIEVEERR:
    Serial.println("Communication error");
    return p;
  case FINGERPRINT_FEATUREFAIL:
    Serial.println("Could not find fingerprint features");
    return p;
  case FINGERPRINT_INVALIDIMAGE:
    Serial.println("Could not find fingerprint features");
    return p;
  default:
    Serial.println("Unknown error");
    return p;
  }

  // OK converted!
  Serial.print("Creating model for #");
  Serial.println(id);

  p = finger.createModel();
  if (p == FINGERPRINT_OK)
  {
    Serial.println("Prints matched!");
  }
  else if (p == FINGERPRINT_PACKETRECIEVEERR)
  {
    Serial.println("Communication error");
    return p;
  }
  else if (p == FINGERPRINT_ENROLLMISMATCH)
  {
    Serial.println("Fingerprints did not match");
    status2 = "Fingerprints did not match";
    u8g2.clearBuffer();                 // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
    u8g2.drawStr(30, 30, "Error");      // write something to the internal memory
    u8g2.sendBuffer();
    delay(1500);
    u8g2.clearBuffer();                 // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
    u8g2.drawStr(30, 30, "");           // write something to the internal memory
    u8g2.sendBuffer();

    cnt1 = 0;
    return p;
  }
  else
  {
    Serial.println("Unknown error");
    return p;
  }

  Serial.print("ID ");
  Serial.println(id);
  p = finger.storeModel(id);
  if (p == FINGERPRINT_OK)
  {
    Serial.println("Stored!");
    status2 = "Success!";
    u8g2.clearBuffer();                 // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
    u8g2.drawStr(30, 30, "Success!");   // write something to the internal memory
    u8g2.sendBuffer();
    delay(1500);
    u8g2.clearBuffer();                 // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
    u8g2.drawStr(30, 30, "");           // write something to the internal memory
    u8g2.sendBuffer();

    cnt1 = 0;
  }
  else if (p == FINGERPRINT_PACKETRECIEVEERR)
  {
    Serial.println("Communication error");
    return p;
  }
  else if (p == FINGERPRINT_BADLOCATION)
  {
    Serial.println("Could not store in that location");
    return p;
  }
  else if (p == FINGERPRINT_FLASHERR)
  {
    Serial.println("Error writing to flash");
    return p;
  }
  else
  {
    Serial.println("Unknown error");
    return p;
  }
}
//-------------------------

// void printHex(int num, int precision)
// {
//   char tmp[16];
//   char format[128];

//   sprintf(format, "%%.%dX", precision);

//   sprintf(tmp, format, num);
//   Serial.print(tmp);
// }

// uint8_t downloadFingerprintTemplate(uint16_t id)
// {
//   Serial.println("------------------------------------");

//   Serial.print("Attempting to load #");
//   Serial.println(id);
//   uint8_t p = finger.loadModel(id);
//   switch (p)
//   {
//   case FINGERPRINT_OK:
//     Serial.print("Template ");
//     Serial.print(id);
//     Serial.println(" loaded");
//     break;
//   case FINGERPRINT_PACKETRECIEVEERR:
//     Serial.println("Communication error");
//     return p;
//   default:
//     Serial.print("Unknown error ");
//     Serial.println(p);
//     return p;
//   }

//   // OK success!

//   Serial.print("Attempting to get #");
//   Serial.println(id);
//   p = finger.getModel();
//   switch (p)
//   {
//   case FINGERPRINT_OK:
//     Serial.print("Template ");
//     Serial.print(id);
//     Serial.println(" transferring:");
//     break;
//   default:
//     Serial.print("Unknown error ");
//     Serial.println(p);
//     return p;
//   }

//   // one data packet is 267 bytes. in one data packet, 11 bytes are 'usesless' :D
//   uint8_t bytesReceived[534]; // 2 data packets
//   memset(bytesReceived, 0xff, 534);

//   uint32_t starttime = millis();
//   int i = 0;
//   while (i < 534 && (millis() - starttime) < 20000)
//   {
//     if (mySerial.available())
//     {
//       bytesReceived[i++] = mySerial.read();
//     }
//   }
//   Serial.print(i);
//   Serial.println(" bytes read.");
//   Serial.println("Decoding packet...");

//   uint8_t fingerTemplate[512]; // the real template
//   memset(fingerTemplate, 0xff, 512);

//   // filtering only the data packets
//   int uindx = 9, index = 0;
//   while (index < 534)
//   {
//     while (index < uindx)
//       ++index;
//     uindx += 256;
//     while (index < uindx)
//     {
//       fingerTemplate[index++] = bytesReceived[index];
//     }
//     uindx += 2;
//     while (index < uindx)
//       ++index;
//     uindx = index + 9;
//   }
//   for (int i = 0; i < 512; ++i)
//   {
//     //Serial.print("0x");
//     printHex(fingerTemplate[i], 2);
//     //Serial.print(", ");
//   }
//   Serial.println("\ndone.");

//   /*
//   uint8_t templateBuffer[256];
//   memset(templateBuffer, 0xff, 256);  //zero out template buffer
//   int index=0;
//   uint32_t starttime = millis();
//   while ((index < 256) && ((millis() - starttime) < 1000))
//   {
//     if (mySerial.available())
//     {
//       templateBuffer[index] = mySerial.read();
//       index++;
//     }
//   }

//   Serial.print(index); Serial.println(" bytes read");

//   //dump entire templateBuffer.  This prints out 16 lines of 16 bytes
//   for (int count= 0; count < 16; count++)
//   {
//     for (int i = 0; i < 16; i++)
//     {
//       Serial.print("0x");
//       Serial.print(templateBuffer[count*16+i], HEX);
//       Serial.print(", ");
//     }
//     Serial.println();
//   }*/
// }

//Read fingerprints------------------------------------------------------------------

uint8_t getFingerprintID()
{
  uint8_t p = finger.getImage();
  switch (p)
  {
  case FINGERPRINT_OK:
    Serial.println("Image taken");
    break;
  case FINGERPRINT_NOFINGER:
    Serial.println("No finger detected");
    return p;
  case FINGERPRINT_PACKETRECIEVEERR:
    Serial.println("Communication error");
    return p;
  case FINGERPRINT_IMAGEFAIL:
    Serial.println("Imaging error");
    return p;
  default:
    Serial.println("Unknown error");
    return p;
  }

  // OK success!

  p = finger.image2Tz();
  switch (p)
  {
  case FINGERPRINT_OK:
    Serial.println("Image converted");
    break;
  case FINGERPRINT_IMAGEMESS:
    Serial.println("Image too messy");
    return p;
  case FINGERPRINT_PACKETRECIEVEERR:
    Serial.println("Communication error");
    return p;
  case FINGERPRINT_FEATUREFAIL:
    Serial.println("Could not find fingerprint features");
    return p;
  case FINGERPRINT_INVALIDIMAGE:
    Serial.println("Could not find fingerprint features");
    return p;
  default:
    Serial.println("Unknown error");
    return p;
  }

  // OK converted!
  p = finger.fingerFastSearch();
  if (p == FINGERPRINT_OK)
  {
    Serial.println("Found a print match!");
  }
  else if (p == FINGERPRINT_PACKETRECIEVEERR)
  {
    Serial.println("Communication error");
    return p;
  }
  else if (p == FINGERPRINT_NOTFOUND)
  {
    Serial.println("Did not find a match");
    return p;
  }
  else
  {
    Serial.println("Unknown error");
    return p;
  }

  // found a match!
  Serial.print("Found ID #");
  Serial.print(finger.fingerID);
  Serial.print(" with confidence of ");
  Serial.println(finger.confidence);

  return finger.fingerID;
}

// returns -1 if failed, otherwise returns ID #
int getFingerprintIDez()
{
  uint16_t p = finger.getImage();
  if (p != FINGERPRINT_OK)
    return -1;

  p = finger.image2Tz();
  if (p != FINGERPRINT_OK)
    return -1;

  p = finger.fingerFastSearch();
  if (p != FINGERPRINT_OK)
    return -1;

  // found a match!
  Serial.print("Found ID #");
  Serial.print(finger.fingerID);
  Serial.print(" with confidence of ");
  Serial.println(finger.confidence);
  return finger.fingerID;
}

uint8_t deleteFingerprint(uint8_t id)
{
  uint8_t p = -1;

  p = finger.deleteModel(id);

  if (p == FINGERPRINT_OK)
  {
    Serial.println("Deleted!");
  }
  else if (p == FINGERPRINT_PACKETRECIEVEERR)
  {
    Serial.println("Communication error");
    return p;
  }
  else if (p == FINGERPRINT_BADLOCATION)
  {
    Serial.println("Could not delete in that location");
    return p;
  }
  else if (p == FINGERPRINT_FLASHERR)
  {
    Serial.println("Error writing to flash");
    return p;
  }
  else
  {
    Serial.print("Unknown error: 0x");
    Serial.println(p, HEX);
    return p;
  }
}
void del1()
{

  uint8_t deleteFingerprint(uint8_t id);
  deleteFingerprint(id);
  status2 = "Delete Success";
}

void read1()
{

  Serial.println("Ready to read a fingerprint!");

  FingerID = -1;
  //id =-1;

  // do
  // {

  //   cnt++;

  //     id = getFingerprintIDez();
  //     Serial.println("Scan NOW");
  //     Serial.println(cnt);
  // } while (cnt == 80);
  //break;

  // while (id == )
  // {
  //   FingerID=getFingerprintIDez();
  //   cnt++;
  //   Serial.println(cnt);

  // }

  while (FingerID == -1)
  {
    cnt++;

    FingerID = getFingerprintIDez();
    Serial.println("Scan Now");
    Serial.println(cnt);
    u8g2.clearBuffer();                 // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
    u8g2.drawStr(30, 30, "Scan Now");   // write something to the internal memory
    u8g2.sendBuffer();
    u8g2.clearBuffer();                 // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
    u8g2.drawStr(30, 30, "Scan Now.");  // write something to the internal memory
    u8g2.sendBuffer();
    u8g2.clearBuffer();                  // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr);  // choose a suitable font
    u8g2.drawStr(30, 30, "Scan Now..."); // write something to the internal memory
    u8g2.sendBuffer();                   // transfer internal memory to the display

    if (cnt == 30)
    {
      break;
    }

  } //---------ใช้ได้

  //  DynamicJsonDocument  root(100);

  // root["Scale"] = String(FingerID);

  // serializeJson(root, JsonDatascale);
  // Serial.println(JsonDatascale);

  // } while (cnt == 65535);
  // if (id == 65535)
  // {
  //   cnt = 0;
  //   Serial.println("Time out");
  // }
  cnt = 0;
  sendID = "";

  DynamicJsonDocument root(100);
  root["id"] = String(FingerID);
  serializeJson(root, sendID);
  Serial.println(sendID);

  if (FingerID == -1)
  {
    timeout1 = "";
    timeout = "Time Out";
    DynamicJsonDocument root(100);
    root["id"] = String(timeout);
    serializeJson(root, timeout1);
    server.sendHeader("access-control-allow-origin", "*");
    server.send(200, "text/html", String(timeout1));
    Serial.print("Read ID => Time OUT");
    u8g2.clearBuffer();                 // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
    u8g2.drawStr(30, 30, "Time Out");   // write something to the internal memory
    u8g2.sendBuffer();
    delay(1000);
    u8g2.clearBuffer();                 // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
    u8g2.drawStr(30, 30, "");           // write something to the internal memory
    u8g2.sendBuffer();
  }
  else
  {
    server.sendHeader("access-control-allow-origin", "*");
    server.send(200, "text/html", String(sendID));
    u8g2.clearBuffer();                 // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
    u8g2.drawStr(50, 30, "OK !");       // write something to the internal memory

    //u8g2.drawStr(60, 30, String(FingerID).c_str());         // write something to the internal memory
    u8g2.sendBuffer();
    delay(2000);

    u8g2.clearBuffer();                 // clear the internal memory
    u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
    u8g2.drawStr(30, 30, "");           // write something to the internal memory
    u8g2.sendBuffer();
  }

  //++;

  //Serial.println("Ready to Read a fingerprint!");
  // id = getFingerprintIDez(); // check the sensors // wait for sensors to stabilize
  // getFingerprintIDez();
  // getFingerprintIDez();

  // }
  // id = finger.fingerID;

  // do
  // {
  //   cnt++;
  //   getFingerprintIDez();
  //   Serial.println(id);
  //   Serial.println(cnt);

  //   if (cnt == 80)
  //   {
  //     cnt = 0;
  //     break;
  //   }

  // } while (id == 65535);
  // Serial.println("okpass");
}

void wirte1()
{

  Serial.println("StartRegister ");

  getFingerprintEnroll();
}

void javascriptContent()
{
  Javascript = "<SCRIPT>\n";
  Javascript += "var xmlHttp=createXmlHttpObject();\n";
  Javascript += "function createXmlHttpObject(){\n";
  Javascript += "if(window.XMLHttpRequest){\n";
  Javascript += "xmlHttp=new XMLHttpRequest();\n";
  Javascript += "}else{\n";
  Javascript += "xmlHttp=new ActiveXObject('Microsoft.XMLHTTP');\n";
  Javascript += "}\n";
  Javascript += "return xmlHttp;\n";
  Javascript += "}\n";
  Javascript += "\n";
  Javascript += "function response(){\n";
  Javascript += "xmlResponse=xmlHttp.responseXML;\n";
  Javascript += "xmldoc = xmlResponse.getElementsByTagName('data');\n";
  Javascript += "message = xmldoc[0].firstChild.nodeValue;\n";
  Javascript += "document.getElementById('div1').innerHTML=message;\n";
  Javascript += "}\n";
  Javascript += "function process(){\n";
  Javascript += "xmlHttp.open('PUT','xml',true);\n";
  Javascript += "xmlHttp.onreadystatechange=response;\n";
  Javascript += "xmlHttp.send(null);\n";
  Javascript += "setTimeout('process()',200);\n";
  Javascript += "}\n";
  //server.send(200, "text/html", JsonData);
  Javascript += "</SCRIPT>\n";
}
void WebsiteContent()
{
  //  javascriptContent();
  //  Website = "Access-Control-Allow-Origin: *";
  //  Website +="Access-Control-Allow-Methods: POST";
  //  Website += JsonDatascale;

  //  Website += "<style>\n";
  //  Website += "#div1{\n";
  //  Website += "width:500px;\n";
  //  Website += "margin:0 auto;\n";
  //  Website += "margin-top:130px;\n";
  //  Website += "font-size:100%;\n";
  //  Website += "color:#000100;\n";
  //  Website += "}\n";
  //  Website += "</style>\n";
  //  Website += "<body onload='process()'>";
  //  Website += "<div id='div1'>" + JsonDatascale + "</div></body></html>";
  //  Website += Javascript;
  server.sendHeader("access-control-allow-origin", "*");
  server.send(200, "text/plain", "example");
}

void XMLcontent()
{

  XML = "<?xml version='1.0'?>";
  XML += "<data>";
  XML += "JsonDatascale";
  XML += "</data>";
  server.sendHeader("access-control-allow-origin", "*");
  server.send(200, "text/xml", XML);
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
  server.sendHeader("access-control-allow-origin", "*");
  server.send(200, "text/html", s);
}
void handle_NotFound()
{
  server.send(404, "text/plain", "----------------Not found----------");
}
void handleRoot()
{
  status = "";
  String message;

  if (server.arg("del").toInt())
  {
    id = server.arg("id").toInt();
    Serial.println(server.arg("del").toInt());
    del1();
  }

  if (server.arg("id").toInt())
  {
    id = server.arg("id").toInt();
    wirte1();
  }

  DynamicJsonDocument root(100);

  root["id"] = String(status2);
  serializeJson(root, status);
  server.sendHeader("access-control-allow-origin", "*");
  server.send(200, "text/html", status);
}
void setup()
{
  Serial.begin(115200);
  finger.begin(57600);
  u8g2.begin();
  timer.setInterval(300L, checkinternet);
  iotWebConf.setStatusPin(STATUS_PIN);
  iotWebConf.setConfigPin(CONFIG_PIN);
  iotWebConf.setupUpdateServer(&httpUpdater);
  iotWebConf.getApTimeoutParameter()->visible = true;
  // iotWebConf.setWifiConnectionTimeoutMs(&httpUpdater);
  // -- Initializing the configuration.
  iotWebConf.init();

  // u8g2.drawStr(60, 30, String(ip).c_str()); // write something to the internal memory
  // u8g2.sendBuffer();
  // delay(2000);
  // Serial.println(ip);

  // -- Set up required URL handlers on the web server.
  server.on("/iotweb", handleRoot2);
  server.on("/config", [] { iotWebConf.handleConfig(); });
  server.onNotFound([]() { iotWebConf.handleNotFound(); });
  server.on("/readID", read1);
  server.on("/", handleRoot);
  server.onNotFound(handle_NotFound);
  Serial.println("Ready.");

  u8g2.clearBuffer();                 // clear the internal memory
  u8g2.setFont(u8g2_font_ncenB08_tr); // choose a suitable font
  u8g2.drawStr(30, 30, "WelCome!");   // write something to the internal memory
  u8g2.sendBuffer();                  // transfer internal memory to the display
  delay(1000);

  // set the data rate for the sensor serial port

  // if (finger.verifyPassword())
  // {
  //   Serial.println("Found fingerprint sensor!");
  // }
  // else
  // {
  //   Serial.println("Did not find fingerprint sensor :(");
  //   while (1)
  //   {
  //     delay(1);
  //   }
  // }

  // finger.getTemplateCount();
  // Serial.print("Sensor contains ");
  // Serial.print(finger.templateCount);
  // Serial.println(" templates");
  // Serial.println("Waiting for valid finger...");
}

void loop() // run over and over again
{
  timer.run();
  // getFingerprintIDez();
  iotWebConf.doLoop();
  server.handleClient();
  // read1();
  //  getFingerprintIDez();
}
//------------------------------------------------------------------------------------------------------------------------------------