/*========================================================
*** Pear installation required for running UHC app successfully.
***
*** IGNORE: if all below packages were installed
***======================================================*/

pear install OLE-1.0.0RC2
pear install Spreadsheet_Excel_Writer-0.9.3
pear channel-discover twilio.github.com/pear
pear install twilio/Services_Twilio
pear install Mail-1.2.0
pear install Mail_Mime-1.8.9
pear install Net_SMTP-1.6.2
pear install Net_Socket-1.0.14
pear install Auth_SASL-1.0.6