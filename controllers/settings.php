<?php
	
	session_start();
	require '../models/general.php';
	$g = new General();

	public function actions(Request $request) {

		if ($request->type == "toggleMode") {

			$toggleMode = $g->cookieToggleMode();
			if ($toggleMode == false) {
				setcookie("toggleMode",true,2147483647, "/");
			} else {
				setcookie("toggleMode",false,2147483647, "/");
			}
		}
	}

?>