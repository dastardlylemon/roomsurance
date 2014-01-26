<html>

<body>
    <div data-role="page" id="login" class="card">
        <div data-role="content">
            <!--//<script type="text/javascript" src="/index.js"></script>-->
            
            <h1>roomsurance</h1>
            <div id="fb-root">
                <a href="#home" onclick="fbLogin();">
                    <button class="login">LOG IN GODDAMMIT</button>
                </a>
            </div>
            <script>
                window.fbAsyncInit = function () {
                    FB.init({
                        appId: '493687680748660',
                        status: true, // check login status
                        cookie: true, // enable cookies to allow the server to access the session
                        xfbml: true // parse XFBML
                    });
                };

                function fbLogin() {
                    FB.login(function (response) {

                            if (response.authResponse) {
                                console.log('Welcome!  Fetching your information.... ');
                                access_token = response.authResponse.accessToken; //get access token
                                user_id = response.authResponse.userID; //get FB UID


                                FB.api('/me', function (response) {
                                    user_email = response.email; //get user email
                                    // you can store this data into your database
                                });

                                $.mobile.changePage("#home");

                            } else {
                                //user hit cancel button
                                console.log('User cancelled login or did not fully authorize.');

                            }
                        })
                }
                (function () {
                            var e = document.createElement('script');
                            e.src = 'http://connect.facebook.net/en_US/all.js';
                            e.async = true;
                            document.getElementById('fb-root').appendChild(e);
                }())    

 
            </script>
        </div>
    </div>
</body>

</html>