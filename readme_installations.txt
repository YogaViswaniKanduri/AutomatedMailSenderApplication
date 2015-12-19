
	/**** Instructions for sending mail from Localhost using WAMP server*****/

Note: Please follow below instructions after your WAMP installation. Make sure that you use php5.3.0 or above versions.

1. Unzip Mail_Installations.zip file
2. If you install WAMP under C drive, then place all unzipped files in the path mentioned below 

	Folder path: C:\wamp\bin\php\php5.3.8

	Note: Above mentioned is specfic to php5.3.8. It may varies for other php versions. If php version is Php5.3.2 then final folder
          will be ..\wamp\bin\php\php5.3.2

3. Now its time to install PEAR. Open Command prompt as Adminstrator (right click on command prompt and run as administrator). Assuming that 
   PHP is installed in C drive and below paths below from now on will be using C drive. 

   3.1 Type cd C:\wamp\bin\php\php5.3.8 and it will take to php installed folder. Now follow below instructions.
   
   3.2 Run following command 
   
		C:\wamp\bin\php\php5.3.8>php go-pear.phar <<type command and press enter>>
		
		Are you installing a system-wide PEAR or a local copy?
		 (system|local) [system] : system <<type system and press enter>>
		 /*
				Below is a suggested file layout for your new PEAR installation.  To
				change individual locations, type the number in front of the
				directory.  Type 'all' to change all of them or simply press Enter to
				accept these locations.
				1. Installation base ($prefix)                   : C:\wamp\bin\php\php5.3.8
				2. Temporary directory for processing            : C:\wamp\bin\php\php5.3.8\tmp
				3. Temporary directory for downloads             : C:\wamp\bin\php\php5.3.8\tmp
				4. Binaries directory                            : C:\wamp\bin\php\php5.3.8
				5. PHP code directory ($php_dir)                 : C:\wamp\bin\php\php5.3.8\pear
				6. Documentation directory                       : C:\wamp\bin\php\php5.3.8\docs
				7. Data directory                                : C:\wamp\bin\php\php5.3.8\data
				8. User-modifiable configuration files directory : C:\wamp\bin\php\php5.3.8\cfg
				9. Public Web Files directory                    : C:\wamp\bin\php\php5.3.8\www
				10. Tests directory                              : C:\wamp\bin\php\php5.3.8\tests
				11. Name of configuration file                   : C:\WINDOWS\pear.ini
				12. Path to CLI php.exe                          : C:\wamp\bin\php\php5.3.8
		*/
		1-12, 'all' or Enter to continue: <<press ENTER button>>
		/*
		 Beginning install...
		 Configuration written to C:\WINDOWS\pear.ini...
		 Initialized registry...
		 Preparing to install...
		 installing phar://C:/wamp/bin/php/php5.3.8/go-pear.phar/PEAR/go-pear-tarballs/Archive_Tar-1.3.7.tar...
		 installing phar://C:/wamp/bin/php/php5.3.8/go-pear.phar/PEAR/go-pear-tarballs/Console_Getopt-1.3.0.tar...
		 installing phar://C:/wamp/bin/php/php5.3.8/go-pear.phar/PEAR/go-pear-tarballs/PEAR-1.9.4.tar...
		 installing phar://C:/wamp/bin/php/php5.3.8/go-pear.phar/PEAR/go-pear-tarballs/Structures_Graph-1.0.4.tar...
		 installing phar://C:/wamp/bin/php/php5.3.8/go-pear.phar/PEAR/go-pear-tarballs/XML_Util-1.2.1.tar...
		 install ok: channel://pear.php.net/Archive_Tar-1.3.7
		 install ok: channel://pear.php.net/Console_Getopt-1.3.0
		 install ok: channel://pear.php.net/Structures_Graph-1.0.4
		 install ok: channel://pear.php.net/XML_Util-1.2.1
		 install ok: channel://pear.php.net/PEAR-1.9.4
		 PEAR: Optional feature webinstaller available (PEAR's web-based installer)
		 PEAR: Optional feature gtkinstaller available (PEAR's PHP-GTK-based installer)
		 PEAR: Optional feature gtk2installer available (PEAR's PHP-GTK2-based installer)
		 PEAR: To install optional features use "pear install pear/PEAR#featurename"
		 ******************************************************************************
		  WARNING!  The include_path defined in the currently used php.ini does not
		  contain the PEAR PHP directory you just specified:
		*/
		 If the specified directory is also not in the include_path used by
		 your scripts, you will have problems getting any PEAR packages working.
		 Would you like to alter php.ini ? [Y/n] : y <<press Y and press enter (sometimes enter is not necessary)>>
		/*
		 php.ini  include_path updated.
		 Current include path           : .;C:\php5\pear
		 Configured directory           : C:\wamp\bin\php\php5.3.8\pear
		 Currently used php.ini (guess) : C:\wamp\bin\php\php5.3.8\php.ini
		*/ 
		 Press Enter to continue: <<press ENTER button>>
		/*
		 ** WARNING! Old version found at C:\wamp\bin\php\php5.3.8, please remove it or be sure 
		 to use the new c:\wamp\bin\php\php5.3.8\pear.bat command
		 The 'pear' command is now at your service at c:\wamp\bin\php\php5.3.8\pear.bat
		 ** The 'pear' command is not currently in your PATH, so you need to
		 ** use 'c:\wamp\bin\php\php5.3.8\pear.bat' until you have added
		 ** 'C:\wamp\bin\php\php5.3.8' to your PATH environment variable.
		 Run it without parameters to see the available actions, try 'pear list'
		 to see what packages are installed, or 'pear help' for help.
		 For more information about PEAR, see:
			http://pear.php.net/faq.php
			http://pear.php.net/manual/
		 Thanks for using go-pear!
		 * WINDOWS ENVIRONMENT VARIABLES *
		 For convenience, a REG file is available under C:\wamp\bin\php\php5.3.8PEAR_ENV.reg .
		 This file creates ENV variables for the current user.
		 Double-click this file to add it to the current user registry.
		*/
		
		C:\wamp\bin\php\php5.3.8>
		
		At the end it will generate a PEAR_ENV.reg file, on which you have to double click to enter this information into registry.
		
	3.3 Redo again step 3.2 for reinstalling PEAR. So that it will remove errors which is caused due to first time installation.
	3.4 a) Open your php.ini file which is located in C:\wamp\bin\php\php5.3.8 . Find
			/*	
				;;;;;;;;;;;;;;;;;;;;;;;;;
				; Paths and Directories ;
				;;;;;;;;;;;;;;;;;;;;;;;;; 


				; UNIX: "/path1:/path2"
				;include_path = ".:/php/includes"
				;
				; Windows: "\path1;\path2"
				;include_path = ".;c:\php\includes"
			*/
		b) Add include_path = ".;C:\wamp\bin\php\php5.3.8\pear"
		c) Now your file looks like
		   /*
				;;;;;;;;;;;;;;;;;;;;;;;;;
				; Paths and Directories ;
				;;;;;;;;;;;;;;;;;;;;;;;;;


				; UNIX: "/path1:/path2"
				;include_path = ".:/php/includes"
				;
				; Windows: "\path1;\path2"
				;include_path = ".;c:\php\includes"
				include_path = ".;C:\wamp\bin\php\php5.3.8\pear"
	       */
		d) Save file, repeat same for php.ini in apache server, located at
			/*
				C:\wamp\bin\apache\Apache2.2.21\bin
			*/
			Note: Make sure to take a copy of .ini file before modification. Dont replace with file present inside php folder. Replacing may 
				  causes issues in future while working with apache server.
		e) Restart all services of WAMP server (especially PHP & Apache).
	3.5 Hurry! You have successfully finished PEAR installations. Now you are just 2 steps behind two complete this complete process.
	3.6 Dont close command prompt as it is required for further steps too.
4. The above PEAR installation doesnt comes with MAIL package. So we need to install MAIL package for PEAR. Follow below instructions to install 
   MAIL package.
   
	C:\wamp\bin\php\php5.3.8>pear install Mail-1.2.0 <<type this command and press enter>>
	
	This will install MAIL package. Along with MAIL package we need to install its dependency packages. Otherwise MAIL package will not work and 
	throws error while running PHP, when try using this MAIL package.
5. In order to install MAIL package dependencies, follow below instructions.
	
	5.1 Run below command in order to Net_SMTP-1.6.2. This contains two more dependencies. Generally those dependency files get installed during 
	    installation of Net_SMTP.
		
		C:\wamp\bin\php\php5.3.8>pear install Net_SMTP-1.6.2 <<type this command and press enter>>
		
	5.2 Run below command in order to install Net_SMTP dependency file Net_Socket. 
	
		C:\wamp\bin\php\php5.3.8>pear install Net_Socket-1.0.14 <<type this command and press enter>>
	
		If command prompt says that Net_Socket has been already installed then proceed with next step.
	
	5.3 Run below command in order to install Net_SMTP dependency file Auth_SASL. 
	
		C:\wamp\bin\php\php5.3.8>pear install Auth_SASL-1.0.6 <<type this command and press enter>>
	
		If command prompt says that Auth_SASL has been already installed then no issues, we will have complete installation of MAIL package.
		
	5.4 Hurry you have completed installation of MAIL package.

6. Restart WAMP server all services (especially PHP and Apache services).
7. Before running mail command or file make sure that below services are running.

	1. Apache-> Apache Modules -> ssl_module. If service is ticked then we can ensure that service is running otherwise click on the service name
	   in order to start the service.
	2. PHP -> PHP extensions -> php_openssl and php_sockets. If services are ticked then we can ensure that services are running otherwise click on the service name
	   in order to start the services.

8. CONGRATULATIONS!! YOU HAVE SUCCESSFULLY INSTALLED MAILING PROCESSES UNDER WAMP SERVER. TRY RUNNING BELOW SCRIPT WITH YOUR CREDENTIALS.
	
	/*
		<?php
		include "C:\wamp\bin\php\php5.3.8\pear\Mail.php";
		$from = "from@yourdomain.com";//Sender Mail Address
		$to =  "to@domain.com";// Recipient mail address
		$subject = "Hi!";
		$body = "Hi,\n\nHow are you?";
		$host = "ssl://smtp.gmail.com";
		$port = "465";
		$username = "from@yourdomain.com";
		$password = "password";// Type your Password Here
		$headers = array ('From' => $from,'To' => $to,'Subject' => $subject);
		$smtp = Mail::factory('smtp',array ('host' => $host,'port' => $port,'auth' => true,'username' => $username,'password' => $password));
		$mail = $smtp->send($to, $headers, $body);
		if (PEAR::isError($mail)) {
		echo( $mail->getMessage());
		}

		else {
		echo "Shout Eureka!! Message Sent successfully !!!!";
		}
		?>
	*/
	
