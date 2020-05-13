<br>
<p align="center">
  <img src="https://xanx.co.uk/images/Logo-MDC.png">
</p>

# MDC Panel
<dl>
  <dd>Multi-functional tools, generators, and resources for official government use. (GTA V - RageMP - GTA World).</dd>
  <dd>
    <a href="https://gta.world/">RageMP - GTA:V Community Multiplayer Platform</a><br>
    <a href="https://gta.world/">GTA World - Roleplay Community</a>
  </dd>
</dl>

## Getting Started

<dl>
  <dd>These instructions will explain on how to obtain a working copy of the project up and running onto your local machine.</dd>
  <dd>See the <b>Deployment</b> section for further instructions on how to setup the project after going through the <b>Prerequisites & Requirements</b> section.</dd>
</dl>

#
### Prerequisites & Requirements

<dl>
  <dd>Web-development platforms (such as <b>WAMP</b>, <b>XAMP</b>) which include the following software is required in order to run the project on a local machine.</dd>
<dd>
<pre>Apache2
PHP 7+</pre>
</dd>
</dl>

#
### Deployment

<dl>
  <dd>The following steps will, in brief, explain how to setup your project up and running onto your local machine for development and testing purposes.</dd>

<dd>

#### 1. Local Respository

<dl>
  <dd>Download the project repository to your local machine under any development path. e.g. <i>X:/Your/Path/To/MDC</i></dd>
</dl>

#### 2. Virtual Hosts

<dl>
  <dd>Using your web-development platform of choice, create a new <b>VirtualHost</b>. This is usually the <code>httpd-vhosts.conf</code> file, however, filenames may vary on development platform basis and therefore you should research on how to accesss such a file if not knowledgable in this area.</dd>
<dd>
	
```
<VirtualHost *:80>

	ServerName MDC
	DocumentRoot "X:/Your/Path/To/MDC"
	
	<Directory  "X:/Your/Path/To/MDC/">
		Options +Indexes +Includes +FollowSymLinks +MultiViews
		AllowOverride All
		Require local
	</Directory>
	
</VirtualHost>
```
	
</dd>
</dl>

#### 3. Local Machine Hosts File

<dl>
	<dd>Access your machine's hosts file to override the <b>Domain Name System</b> (<b>DNS</b>) for a local machine domain to gain easier access to the website.</dd>

<dd>

##### Windows

* Open Command Prompt with Administrator Privileges
* Enter the following: <code>notepad C:\Windows\System32\drivers\etc\hosts</code>
</dd>

<dd>

##### Linux

* Open Terminal
* Enter the following: <code>sudo nano /etc/hosts</code>
</dd>

<dd>Add the following line at the bottom of the hosts file: <code>127.0.0.1 MDC.dev</code>
Save the hosts file.</dd>
</dl>

#### 4. Local Website Access

<dl>
<dd>Turn on your web-development platform and access the local website for development/testing purposes.</dd>
<dd><a href="http://MDC.dev">http://MDC.dev</a></dd>
</dl>
</dd>
</dl>

#

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
