<?php
// fungsi untuk mengecek apakah user sudah login atau belum
function loggedIn()
{
	// cek apakah session logged_in ada atau tidak
	return $_SESSION['logged_in'] ?? false;
}
