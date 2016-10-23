<?php
/**
 * Created by PhpStorm.
 * User: Piru
 * Date: 10/22/2016
 * Time: 12:36 AM
 */
?>

<html lang="en">
<head>
    <title>Project Reading List</title>
    <link rel="stylesheet" type="text/css" href="defaultStyleSheet.css">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="167819039680-dpitvpdhk8slhikg859r4dcjm694rjku.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</head>
<body>

<p class=pagetitle align=center>Project Reading List</p>

<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>

<script>
    function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'process.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            console.log('Signed in as: ' + xhr.responseText);
        };

        xhr.send('email=' + profile.getEmail());
        window.location = "getarticles.php";

    };


</script>

<a href="#" onclick="signOut();">Sign out</a>
<script>
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            console.log('User signed out.');

            <?php session_destroy(); ?>

        });
    }
</script>

</body>
</html>
