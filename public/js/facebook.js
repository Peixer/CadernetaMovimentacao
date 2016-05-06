/**
 * Created by Glaicon on 01/05/2016.
 */

window.fbAsyncInit = function () {
    FB.init({
        appId: '1721225824819950',
        xfbml: true,
        version: 'v2.6'
    });

    function onLogin(response) {
        if (response.status == 'connected') {
            FB.api('/me?fields=first_name', function (data) {
                var welcomeBlock = document.getElementById('fb-welcome');
                welcomeBlock.innerHTML = 'Hello, ' + data.first_name + '!';
            });
        }
    }

    FB.getLoginStatus(function (response) {
        if (response.status == 'connected') {
            onLogin(response);
        } else {
            FB.login(function (response) {
                onLogin(response);
            }, {scope: 'user_friends, email'});
        }
    });
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));