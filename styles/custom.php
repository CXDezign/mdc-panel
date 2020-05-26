<?php

	require '../models/general.php';
	$g = new General();

	header("Content-type: text/css; charset: UTF-8");

	// Toggle Hints
	if ($g->findCookie('toggleHints')) {
		echo '.form-group small { display: none!important; }';
	}

	// Toggle Footer
	if ($g->findCookie('toggleFooter')) {
		echo '#footer {	display: none!important; }';
	}

	// Toggle Background
	if (!$g->findCookie('toggleBackgroundLogo')) {
		echo '#container { background-image: url(../images/Logo-SanAndreasSealTransparent.png)!important; }';
	}

	// Variables

	$golden = "#e2b055";
	$cMap = "#e74c3c";
	$cGenerators = "#ca9159";
	$cResources = "#8764d7";
	$cArrest = "#cbc2c5";
	$cTraffic = "#c9222e";
	$cImpound = "#fedd3c";
	$cParking = "#0066b2";
	$cEvidence = "#7da522";
	$cPatrol = "#11cab9";
	$cTDpatrol = "#e36528";
	$cDeath = "#8e8449";

?>

/*/////////////////
// HTML ELEMENTS //
/////////////////*/

html {
	overflow-y: scroll;
	scroll-behavior: smooth;
}

::selection {
  background: rgba(200,200,200,.5);
  border-radius: 5px;
}

body {
	background-color: rgba(238, 238, 238, 0.95);
}

body #container {
	background-size: 500px 500px;
	background-position: calc(50% + 130px) 50%;
	background-repeat: no-repeat;
	background-attachment: fixed;
	min-height: 100vh;
}

a {
	color: <?= $golden ?>;
	transition: color .1s linear!important;
}

a:hover {
	color: #b78f48;
	text-decoration: none;
}

optgroup {
	font-style: unset;
}

/*////////
// MAIN //
////////*/

.wrapper {
	display: flex;
	align-items: stretch;
}

#container {
	display: block;
	width: calc(100vw - 260px);
	margin-left: 260px;
}

.table {
	border-radius: 5px;
}

.text-golden {
	color: <?= $golden ?>;
}

/*///////////
// GENERAL //
///////////*/

.fa-ss {
	color: rgba(255,255,255,0.4)!important;
	transform: translate(0,-1px);
}

.btn:hover {
	transition: all .1s linear!important;
}

.toggle.btn {
	border-radius: 100vh;
}

.toggle-handle {
	padding: 0 15px!important;
}

.toggle-off.btn {
	padding-left: .75rem !important;
}

.toggle-on.btn {
	padding-right: .75rem !important;
}

.bootstrap-select .no-results {
	border-radius: 5px!important;
	padding: 5px 15px!important;
}

.dropdown-item {
	transition: all .1s linear!important;
}

/*//////////
// FOOTER //
//////////*/

.footer-container {
	position: fixed;
	z-index: -1000;
	left: 0;
	bottom: 0;
	width: calc(100vw - 260px);
	margin-left: 260px;
	border-top: 1px solid rgba(0,0,0,.1);
	background-color: #eeeeee;
}

#footer {
	opacity: 0.25;
	transition: all .5s linear;
}

#footer:hover {
	opacity: 1;
}

#logo-footer {
	opacity: 0.1;
}

/*//////////////
// BREADCRUMB //
//////////////*/

#breadcrumb {
	background: unset!important;
	border-bottom: 1px solid rgba(0,0,0,.1)!important;
	border-radius: 0!important;
	font-weight: 600;
	text-shadow: 0 1px 2px #00000040!important;
}

#breadcrumb li {

}

#breadcrumb li a {
	background-color: rgba(255,255,255,1);
	padding: 4px 16px;
	border-radius: 5px;
}

/*///////////
// SIDEBAR //
///////////*/

#sidebar {
	height: 100vh;
	position: fixed;
	font-size: 80%;
	min-width: 260px;
	max-width: 260px;
	background-color: #282828;
	overflow-y: auto;
}

#sidebar-logo {
	background: url("/images/Logo-MDC.png");
	background-size: 100%;
	background-repeat: no-repeat;
	background-position: center;
	width: 200px;
	height: 100px;
	margin: 0 auto;
}

#sidebar-logo img {
	display: none;
}

#sidebar, ul {
	margin-bottom: 75px;
}

#sidebar a {
	color: #fff;
}

#sidebar a:hover {
	color: #ddd;
	text-decoration: none;
}

#sidebar i {
	color: #fff;
}

#sidebar li {
	border-radius: 3px;
	padding: 2px 0;
	margin-bottom: 2px;
	box-shadow: 0 1px 0 rgba(255,255,255,0);
	text-shadow: 0 1px 2px #000000!important;
	transition: all .1s linear;
}

#sidebar li:hover {
	color: #4095e8;
	background: rgba(255,255,255,0.1);
	box-shadow: 0 1px 0 rgba(255,255,255,.3);
}

#sidebar #timestamp {
	background-color: rgba(0,0,0,.1);
	border-radius: 5px;
}

#sidebar li img {
	transform: scale(1.1);
}

#timestamp {
	color: #FFF;
	font-size: 18px;
	letter-spacing: 2px;
	font-weight: 600;
	text-shadow: 0 2px 4px #000000!important;
}

@media (max-width: 768px) {

	body #container {
		background-size: 250px 250px;
		background-position: calc(50% + 50px) 50%;
	}

	#sidebar {
		min-width: 100px;
		max-width: 100px;
	}

	#sidebar-logo {
		background: url("/favicon.png");
		background-size: 100%;
		background-repeat: no-repeat;
		background-position: center;
		width: 60px;
		height: 60px;
		margin: 0 auto;
	}

	#container {
		display: block;
		width: calc(100vw - 100px);
		margin-left: 100px;
	}

	#map {
		width: calc(100% - 100px)!important;
		left: 100px!important;
	}

	#sidebar .icon-text {
		display: none;
	}

	#sidebar a {
		text-align: center;
	}

	#sidebar i, #sidebar img {
		margin-right: 0!important;
		font-size: 16px;
	}

	#sidebar img {
		transform: scale(1.4)!important;
	}

	.dropdown-toggle::after {
		content: unset;
	}

	.container-time {
		padding: 0 0!important;
	}

	.sidebar-visitor-text {
		display: none;
	}

	.footer-container {
		width: calc(100vw - 100px);
		margin-left: 100px;
	}

	#sidebar #timestamp {
		background-color: unset;
		font-size: 14px;
	}

	.container h1 {
		font-size: 1.5rem!important;
	}

	.card .card-description {
		display: none;
	}

	.card .card-icon {
		float: unset!important;
		text-align: center!important;
	}

	.card .card-title {
		text-align: center;
	}

}

@media (max-width: 991px) {

	.breadcrumb-item {
		display: block!important;
		padding-left: unset!important;
		padding-bottom: 10px;
	}

	.breadcrumb-item::before {
		padding-right: unset!important;
		content: ""!important;
	}

	.breadcrumb-item:last-of-type {
		padding-bottom: 0px;
	}

}

/*//////////////
// CHANGELOGS //
//////////////*/

.changelog-spacing {
	position: absolute;
	z-index: -1;
	left: 0;
	margin-top: -300px;
}

.card-change {
	box-shadow: 0 0 15px #00000000!important;
	transition: all 5s linear;
}

.changelog-spacing:target + .card-change {
	box-shadow: 0 0 15px <?= $golden ?>!important;
}

.cl-general {
	color: <?= $golden ?>;
	font-weight: 600;
}

/*/////////
// CARDS //
/////////*/

.card {
	border: unset!important;
}

.card-icon {
	text-align: right;
	float: right;
}

.card.text-white {
	color: #212529!important;
}

.card.bg-dark {
	background-color: #fff!important;
}

.card .text-muted {
	color: #e8e8e8!important;
}

.card-panel {
	box-shadow: 0px 1px 0 rgba(0, 0, 0, .5);
	transition: all .1s ease-in-out!important;
}

.card-panel i {
	text-shadow: 0px 1px 0 rgba(0, 0, 0, .25);
	transition: all .1s ease-in-out!important;
}

#card-main-map:hover {
	box-shadow: <?= $cMap ?> 0 1px 0px;
}

#card-main-map:hover i {
	color: <?= $cMap ?>!important;
	text-shadow: <?= $cMap ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

#card-main-generators:hover {
	box-shadow: <?= $cGenerators ?> 0 1px 0px;
}

#card-main-generators:hover i {
	color: <?= $cGenerators ?>!important;
	text-shadow: <?= $cGenerators ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

#card-main-resources:hover {
	box-shadow: <?= $cResources ?> 0 1px 0px;
}

#card-main-resources:hover i {
	color: <?= $cResources ?>!important;
	text-shadow: <?= $cResources ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

#card-main-penal:hover {
	box-shadow: <?= $golden ?> 0 1px 0px;
}

#card-main-penal:hover i {
	color: <?= $golden ?>!important;
	text-shadow: <?= $golden ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

#card-generators-arrest:hover {
	box-shadow: <?= $cArrest ?> 0 1px 0px;
}

#card-generators-arrest:hover i {
	color: <?= $cArrest ?>!important;
	text-shadow: <?= $cArrest ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

#card-generators-traffic:hover {
	box-shadow: <?= $cTraffic ?> 0 1px 0px;
}

#card-generators-traffic:hover i {
	color: <?= $cTraffic ?>!important;
	text-shadow: <?= $cTraffic ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

#card-generators-impound:hover {
	box-shadow: <?= $cImpound ?> 0 1px 0px;
}

#card-generators-impound:hover i {
	color: <?= $cImpound ?>!important;
	text-shadow: <?= $cImpound ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

#card-generators-parking:hover {
	box-shadow: <?= $cParking ?> 0 1px 0px;
}

#card-generators-parking:hover i {
	color: <?= $cParking ?>!important;
	text-shadow: <?= $cParking ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

#card-generators-evidence:hover {
	box-shadow: <?= $cEvidence ?> 0 1px 0px;
}

#card-generators-evidence:hover i {
	color: <?= $cEvidence ?>!important;
	text-shadow: <?= $cEvidence ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

#card-generators-death:hover {
	box-shadow: <?= $cDeath ?> 0 1px 0px;
}

#card-generators-death:hover i {
	color: <?= $cDeath ?>!important;
	text-shadow: <?= $cDeath ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

#card-generators-tdpatrol:hover {
	box-shadow: <?= $cTDpatrol ?> 0 1px 0px;
}

#card-generators-tdpatrol:hover i {
	color: <?= $cTDpatrol ?>!important;
	text-shadow: <?= $cTDpatrol ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

#card-generators-patrol:hover {
	box-shadow: <?= $cPatrol ?> 0 1px 0px;
}

#card-generators-patrol:hover i {
	color: <?= $cPatrol ?>!important;
	text-shadow: <?= $cPatrol ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

/*/////////////////////////////////////////////////////////////////////*/
/* DARKMODE */

<?php

if ($g->findCookie('toggleMode')) {

?>

/*/////////////////
// HTML ELEMENTS //
/////////////////*/

body {
	color: #fff;
	background-color: #1f1f1f;
}

hr {
	border-top: 1px solid rgba(0,0,0,.25);
}

optgroup {
	background-color: #282828;
}

small.text-muted {
	color: #c9c9ca !important;
}

/*////////////////
// INPUT FIELDS //
////////////////*/

.input-group-midpend {
	margin-left: -1px;
	margin-right: -1px;
}

.form-control {
	display: block;
	width: 100%;
	height: calc(1.5em + .75rem + 2px);
	padding: .375rem .75rem;
	font-size: 1rem;
	font-weight: 400;
	line-height: 1.5;
	color: #ffffff;
	background-color: #282828;
	background-clip: padding-box;
	border: 1px solid #282828;
	border-radius: .25rem;
	transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.form-control:disabled, .form-control[readonly] {
	background-color: #313131;
	color: #ddd;
	opacity: 1;
}

.form-control:focus {
	color: #ffffff;
	background-color: #313131;
	border-color: #80bdff;
	outline: 0;
	box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.input-group-text {
	display: -ms-flexbox;
	display: flex;
	-ms-flex-align: center;
	align-items: center;
	padding: .375rem .75rem;
	margin-bottom: 0;
	font-size: 1rem;
	font-weight: 400;
	line-height: 1.5;
	color: #ffffff;
	text-align: center;
	white-space: nowrap;
	background-color: #404040;
	border: 1px solid #404040;
	border-radius: .25rem;
}

.form-control::placeholder {
	color: #9a9ea2;
}

.input-group .bootstrap-select.form-control .dropdown-toggle {
	background: #282828;
	color: #fff;
	border: 1px solid transparent;
}

.dropdown-toggle.btn-light {
	color: #fff;
	background-color: #282828;
	border-color: #282828;
}

.btn-light:not(:disabled):not(.disabled).active, .btn-light:not(:disabled):not(.disabled):active, .show > .btn-light.dropdown-toggle {
	color: #fff;
	background-color: #212121;
	border-color: #212121;
}

.bootstrap-select .no-results {
	background: #282828!important;
	color: #fff!important;
}

.dropdown-header {
	color: #a4a4a4;
}

.dropdown-divider {
	border-top: 1px solid rgba(0,0,0,0.2);
}

.dropdown-menu {
	background-color: #313131;
}

.dropdown-item {
	color: #fff!important;
}

.dropdown-item:hover {
	background-color: #212121;
}

/*//////////
// TABLES //
//////////*/

.table-light {
	color: #fff;
	background-color: #303131;
}

.table-light td, .table-light th, .table-light thead th {
	border-color: #454d55;
}

.table-light.table-hover tbody tr:hover {
    color: #fff;
    background-color: rgba(255,255,255,.075);
}

/*///////////////
// BREADCRUMBS //
///////////////*/

#breadcrumb li a {
	background-color: rgba(0,0,0,.25);
}

#breadcrumb {
	border-bottom: 1px solid rgba(0,0,0,.2)!important;
}

/*//////////
// FOOTER //
//////////*/

.footer-container {
	border-top: 1px solid rgba(0,0,0,.1);
	background-color: #1f1f1f;
}

/*/////////
// CARDS //
/////////*/

.card-panel {
	box-shadow: 0px -1px 0 rgba(255, 255, 255, .1);
}

.card-panel:hover {
	box-shadow: 0px -1px 0 rgba(255, 255, 255, .5);
}

.card.text-white {
	color: #fff!important;
}

.card.bg-dark {
	background-color: #151515!important;
}

.card .text-muted {
	text-shadow: 0px -1px 0 rgba(255, 255, 255, 0.2);
	color: #2f2f2f!important;
}

#card-main-map:hover {
	box-shadow: <?= $cMap ?>80 0 -1px 0px;
}

#card-main-map:hover i {
	text-shadow: <?= $cMap ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
}

#card-main-generators:hover {
	box-shadow: <?= $cGenerators ?>80 0 -1px 0px;
}

#card-main-generators:hover i {
	text-shadow: <?= $cGenerators ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
}

#card-main-resources:hover {
	box-shadow: <?= $cResources ?>80 0 -1px 0px;
}

#card-main-resources:hover i {
	text-shadow: <?= $cResources ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
}

#card-main-penal:hover {
	box-shadow: <?= $golden ?>80 0 -1px 0px;
}

#card-main-penal:hover i {
	text-shadow: <?= $golden ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
}

#card-generators-arrest:hover {
	box-shadow: <?= $cArrest ?>80 0 -1px 0px;
}

#card-generators-arrest:hover i {
	text-shadow: <?= $cArrest ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
}

#card-generators-traffic:hover {
	box-shadow: <?= $cTraffic ?>80 0 -1px 0px;
}

#card-generators-traffic:hover i {
	text-shadow: <?= $cTraffic ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
}

#card-generators-impound:hover {
	box-shadow: <?= $cImpound ?>80 0 -1px 0px;
}

#card-generators-impound:hover i {
	text-shadow: <?= $cImpound ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
}

#card-generators-parking:hover {
	box-shadow: <?= $cParking ?>80 0 -1px 0px;
}

#card-generators-parking:hover i {
	text-shadow: <?= $cParking ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
}

#card-generators-evidence:hover {
	box-shadow: <?= $cEvidence ?>80 0 -1px 0px;
}

#card-generators-evidence:hover i {
	text-shadow: <?= $cEvidence ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
}

#card-generators-death:hover {
	box-shadow: <?= $cDeath ?>80 0 -1px 0px;
}

#card-generators-death:hover i {
	text-shadow: <?= $cDeath ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
}

#card-generators-tdpatrol:hover {
	box-shadow: <?= $cTDpatrol ?>80 0 -1px 0px;
}

#card-generators-tdpatrol:hover i {
	text-shadow: <?= $cTDpatrol ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
}

#card-generators-patrol:hover {
	box-shadow: <?= $cPatrol ?>80 0 -1px 0px;
}

#card-generators-patrol:hover i {
	text-shadow: <?= $cPatrol ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
}

<?php

}

?>