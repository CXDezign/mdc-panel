<?php

	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/initialise.php';

	header("Content-type: text/css; charset: UTF-8");

	// Toggle Hints
	if ($g->findCookie('toggleHints')) {
		echo '.form-group small { display: none!important; }';
	}

	if ($g->findCookie('toggleBreadcrumb')) {
		echo '#breadcrumb {	display: none!important; }';
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
	$cMDC = "#005db8";
	$cMap = "#e74c3c";
	$cGenerators = "#ca9159";
	$cResources = "#8764d7";
	$cArrest = "#cbc2c5";
	$cTraffic = "#c9222e";
	$cImpound = "#fedd3c";
	$cParking = "#0066b2";
	$cEvidence = "#7da522";
	$cPatrol = "#11cab9";
	$cDeath = "#8e8449";
	$cTDpatrol = "#5b1d16";
	$cMDDeployment = "#ff1e31";

?>

/*//////////////////
// PSEUDO CLASSES //
//////////////////*/

input:required,
textarea:required,
select:required ~ .dropdown-toggle {
	border: 1px solid rgba(0,200,50,0.4)!important;
}

input:invalid,
textarea:invalid,
select:invalid ~ .dropdown-toggle {
    box-shadow: none;
    border: 1px solid rgba(255,0,0,0.4)!important;
}

::selection {
	background: rgba(200,200,200,.5);
	border-radius: 5px;
}

/*/////////////////
// HTML ELEMENTS //
/////////////////*/

html {
	overflow-y: scroll;
	overflow-x: hidden;
	scroll-behavior: smooth;
}

body {
	background-color: rgba(238, 238, 238, 0.95);
}

body #container {
	background-size: 500px 500px;
	background-position: calc(50% + 130px) 40%;
	background-repeat: no-repeat;
	background-attachment: fixed;
	min-height: 100vh;
}

a {
	cursor: pointer;
	color: <?= $golden ?>;
	transition: color .1s linear!important;
}

a:hover {
	color: #b78f48;
	text-decoration: none;
}

a:not([href]) {
	color: #fff;
}
a:not([href]):hover {
	color: #fff;
	text-decoration: none;
}

optgroup {
	font-style: unset;
}

/*//////////////
// CONTAINERS //
//////////////*/

#wrapper {

}

#container {
	display: block;
	width: calc(100vw - 260px);
	margin-left: 260px;
}

.container-page {
	position: relative;
	padding: 4rem 0;
	min-height: 70vh;
	transition: transform .5s linear;
}

#breadcrumb {
	position: static;
	margin: 0;
	padding: 0 .75rem .75rem .75rem;
	background: #eee;
	border-bottom: 1px solid rgba(0,0,0,.1) !important;
	border-radius: 0 !important;
	font-weight: 600;
	text-shadow: 0 1px 2px #00000040 !important;
	transition: transform .5s linear;
}

#breadcrumb .breadcrumb-item {
	margin: .75rem 0 0 0;
}

#breadcrumb .user {
	margin-top: .75rem;
}

#footer {
	position: static;
	padding: .5rem 0;
	background-color: #eeeeee;
	border-top: 1px solid rgba(0,0,0,.1);
	text-align: center;
	z-index: -1;
	transition: transform .5s linear;
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
	background: url("<?= $g->getSettings('site-logo') ?>");
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

#sidebar ul {
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

#notification {
	display: block;
	background-color: #dc3545; 
	padding: 10px;
	color: #fff;
	text-align: center;
	transition: transform .5s linear, opacity .5s linear;
}

#notification .badge-trans {
	background-color: rgba(0,0,0,.2);
	transition: background-color .15s linear;
}

#notification .badge-trans:hover {
	background-color: rgba(0,0,0,.4);
}

/*///////////
// MASONRY //
///////////*/

#dashboard.grid {
	display: flex;
}

#dashboard .grid-col {
	float: left;
	min-width: 50%;
	padding: 0 .5em;
	flex-grow: 1;
}

#dashboard.grid .grid-item {
	margin-bottom: 1.25em;
}

#dashboard .grid-col--1 {
	display: none;
}

@media (min-width: 900px) {
	#dashboard .grid-col--1 {
		display: block;
	}
}

/* PAPERWORK GENERATORS */

#generators.grid {
	display: flex;
}

#generators .grid-col {
	float: left;
	min-width: 25%;
	padding: 0 .5em;
	flex-grow: 1;
}

#generators.grid .grid-item {
	margin-bottom: 1.25em;
}

#generators .grid-col--2 {
	display: none;
}

#generators .grid-col--3 {
	display: none;
}

#generators .grid-col--4 {
	display: none;
}

@media (min-width: 900px) {
	#generators .grid-col--2 {
		display: block;
	}
}

@media (min-width: 1100px) {
	#generators .grid-col--3 {
		display: block;
	}
}

@media (min-width: 1300px) {
	#generators .grid-col--4 {
		display: block;
	}
}

/* USEFUL RESOURCES */

#resources.grid {
	display: flex;
}

#resources .grid-col {
	float: left;
	min-width: 50%;
	padding: 0 .5em;
	flex-grow: 1;
}

#resources.grid .grid-item {
	margin-bottom: 1.25em;
}

#resources .grid-col--1 {
	display: none;
}

@media (min-width: 1100px) {
	#resources .grid-col--1 {
		display: block;
	}
}

/*///////////
// GENERAL //
///////////*/

#breadcrumb li a {
	background-color: rgba(255,255,255,1);
	padding: 4px 16px;
	border-radius: 5px;
}

.table {
	border-radius: 5px;
}

.text-golden {
	color: <?= $golden ?>;
}

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

.dropdown-menu li.disabled,
.dropdown-menu option.disabled {
	cursor: not-allowed;
}

.dropdown-menu li.disabled .text {
	color: rgba(0,0,0,0.5);
}

.bootstrap-select .dropdown-menu li a {
	color: #333;
}

.dropdown-item.active, .dropdown-item:active {
	color: #fff !important;
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

.card .text-muted {
	color: #e8e8e8!important;
}

.card .card-icon {
	text-align: center!important;
}

.card-panel .card-title {
	margin-top: .75rem;
	text-align: center;
}

.card-panel {
	width: 100%;
	background-color: #fff;
	color: #212529;
	box-shadow: 0px 1px 0 rgba(0, 0, 0, .5);
	transition: all .1s ease-in-out!important;
}

.card-panel a {
	color: unset;
}

.card-panel i {
	text-shadow: 0px 1px 0 rgba(0, 0, 0, .25);
	transition: all .1s ease-in-out!important;
}

.card-resource {
	margin-bottom: 10px;
	background-color: #fff;
	color: #212529;
	box-shadow: 0px 1px 0 rgba(0, 0, 0, .5);
	transition: all .1s ease-in-out!important;
}

.card-resource i {
	text-shadow: 0px 1px 0 rgba(0, 0, 0, .25);
	transition: all .1s ease-in-out!important;
}

#card-main-mdc:hover {
	box-shadow: <?= $cMDC ?> 0 1px 0px;
}

#card-main-mdc:hover i {
	color: <?= $cMDC ?>!important;
	text-shadow: <?= $cMDC ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
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

#card-generators-patrol:hover {
	box-shadow: <?= $cPatrol ?> 0 1px 0px;
}

#card-generators-patrol:hover i {
	color: <?= $cPatrol ?>!important;
	text-shadow: <?= $cPatrol ?>80 0 0 15px, 0px 1px 0 rgba(0, 0, 0, .75);
}

#card-generators-tdpatrol:hover {
	box-shadow: <?= $cTDpatrol ?> 0 1px 0px;
}

#card-generators-tdpatrol img {
	filter: grayscale(100%);
	transition: filter .1s linear;
}

#card-generators-tdpatrol:hover img {
	filter: grayscale(0%);
}

#card-generators-mddeployment:hover {
	box-shadow: <?= $cMDDeployment ?> 0 1px 0px;
}

#card-generators-mddeployment img {
	filter: grayscale(100%);
	transition: filter .1s linear;
}

#card-generators-mddeployment:hover img {
	filter: grayscale(0%);
}

/*///////////////////////////////////////////////////////////////////////////////////////////
// MOBILE DEVICES //
//////////////////*/

@media (max-width: 768px) {

	body #container {
		background-size: 250px 250px;
		background-position: calc(50% + 50px) 50%;
	}

	#container {
		display: block;
		width: calc(100vw - 60px);
		margin-left: 60px;
	}

	#map {
		width: calc(100% - 60px)!important;
		left: 100px!important;
	}

	#breadcrumb {
		display: none;
	}

	#sidebar {
		min-width: 60px;
		max-width: 60px;
	}

	#sidebar ul {
		padding: 8px!important;
	}

	#sidebar .nav-link {
		padding: .2rem .5rem;
	}

	#sidebar-logo {
		background: url("<?= $g->getSettings('site-favicon') ?>");
		background-size: 100%;
		background-repeat: no-repeat;
		background-position: center;
		width: 50px;
		height: 50px;
		margin: 0 auto;
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

	#sidebar #timestamp {
		background-color: unset;
		font-size: 10px;
	}

	.container h1 {
		font-size: 1.5rem!important;
	}

}

@media (max-width: 991px) {

	.container-page {
		padding-top: 2rem;
	}

	.breadcrumb-item {
		display: block!important;
		padding-left: unset!important;
	}

	.breadcrumb-item::before {
		display: none!important;
		padding-right: unset!important;
		content: ""!important;
	}

}

/*//////////////////////////////////////////////////////////////////////////////////////
// DARKMODE //
////////////*/

<?php

if (!$g->findCookie('toggleMode')) {

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
	color: #515151;
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

.dropdown-menu li.disabled .text {
	color: rgba(255,255,255,0.25);
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
	background: #1f1f1f;
	border-bottom: 1px solid rgba(0,0,0,.2)!important;
}

/*//////////
// FOOTER //
//////////*/

#footer {
	border-top: 1px solid rgba(0,0,0,.1);
	background-color: #1f1f1f;
}

/*/////////
// CARDS //
/////////*/

.card-panel {
	background-color: #151515;
	color: #fff;
	box-shadow: 0px -1px 0 rgba(255, 255, 255, .1);
}

.card-panel:hover {
	box-shadow: 0px -1px 0 rgba(255, 255, 255, .5);
}

.card-resource {
	background-color: #151515;
	color: #fff;
	box-shadow: 0px -1px 0 rgba(255, 255, 255, .1);
}

.card-resource:hover {
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

#card-main-mdc:hover {
	box-shadow: <?= $cMDC ?>80 0 -1px 0px;
}

#card-main-mdc:hover i {
	text-shadow: <?= $cMDC ?>80 0 0 15px, 0px -1px 0 rgba(255, 255, 255, .5);
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

#card-generators-mddeployment:hover {
	box-shadow: <?= $cMDDeployment ?>80 0 -1px 0px;
}

<?php

}

?>