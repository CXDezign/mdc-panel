<p align="center">
  <img src="https://xanx.co.uk/images/Logo-MDC.png">
</p>

# MDC Panel

Multi-functional tools, generators, and resources for official government use. (GTA V - RageMP - GTA World).

<a href="https://gta.world/">RageMP - GTA:V Community Multiplayer Platform</a><br>
<a href="https://gta.world/">GTA World - Roleplay Community</a>

## Getting Started

These instructions will explain on how to obtain a working copy of the project up and running onto your local machine. See  the <b>Deployment</b> section for further instructions on how to setup the project after going through the <b>Prerequisites & Requirements</b> section.

### Prerequisites & Requirements

Web-development platforms (such as <b>WAMP</b>, <b>XAMP</b>) which include the following software is required in order to run the project on a local machine.
```
 Apache2
 PHP 7+
```

### Deployment

The following steps will, in brief, explain how to setup your project up and running onto your local machine for development and testing purposes.

<b>1)</b> Download the project repository to your local machine under any development path. (e.g. <i>X:/Your/Path/To/MDC-Panel</i>)
<br>
<b>2)</b> Using your web-development platform of choice, create a new <b>VirtualHost</b>. This is usually the `httpd-vhosts.conf` file, however, filenames may vary on development platform basis and therefore you should research on how to accesss such a file if not knowledgable in this area.

```
<VirtualHost *:80>
  ServerName MDC
  DocumentRoot "X:/Your/Path/To/MDC-Panel"
  <Directory  "X:/Your/Path/To/MDC-Panel/">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
  </Directory>
</VirtualHost>
```
<br>
<b>3)</b> Access your machine's hosts file to override the <b>Domain Name System</b> (<b>DNS</b>) for a local machine domain to gain easier access to the website.

<b>Windows</b><br>
  <i>a)</i> Open Command Prompt with Administrator Privileges<br>
  <i>b)</i> Enter the following: `notepad C:\Windows\System32\drivers\etc\hosts`<br>
  
<b>Linux</b><br>
  <i>a)</i> Open Terminal<br>
  <i>b)</i> Enter the following: `sudo nano /etc/hosts`<br>

Add the following line at the bottom and save the file: `127.0.0.1 MDC.dev`
<br>
<b>4)</b> Access the local website for development/testing purposes. <a href="http://MDC.dev">http://MDC.dev</a>

## Built With

* [Bootstrap](https://getbootstrap.com/) - Web Framework
* [FontAwesome](https://fontawesome.com/) - Font Icon Toolkit
* [Leaflet](https://leafletjs.com/) - Web Mapping Application

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/xanxTV/MDC-Panel/tags). 

## Contributors

* **xanxTV** - *Creator*. - [xanxTV](https://github.com/xanxTV)
* **Skenticus** - *Arrest Report, Patrol Log, Impound Report Generators*. - [Skenticus](https://github.com/Skenticus)
* **Callump01** - *Contributor*. - [Callump01](https://github.com/Callump01)
* **Cascade** - *Base Leaflet code*.
* **Spartan** - *Constant suggestions and interest in the project*.
