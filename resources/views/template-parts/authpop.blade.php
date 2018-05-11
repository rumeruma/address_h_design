<div id="user">

    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="listing-modal-1 modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> Login</h4>
                </div>
                <div class="modal-body">
                    <div class="listing-login-form">
                        <login></login>
                        <div class="bottom-links">
                            <p>not a member?<a href="{{ route('register') }}">create account</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="listing-modal-1 modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel2">Registration</h4>
                </div>
                <div class="modal-body">
                    <div class="listing-register-form">
                        <register></register>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>