<template>
    <div>
        <div class="alert alert-success ass">
            <strong>Your are successfully registered!!</strong>, Please Check Your Inbox To Activate Your Account And Login Then
        </div>
        <form id="dhon" action="#">
            <div class="listing-form-field" :class="{'has-error' : hasErrors.name}"><i class="fa fa-user blue-1"></i>
                <input class="form-field bgwhite" id="name" type="text" name="name" v-model="registerData.name"
                       placeholder="name" required autofocus/>
                <span v-if="hasErrors.name" class="help-block"><strong>{{errorMessage.name}}</strong></span>
            </div>
            <div class="listing-form-field" :class="{'has-error' : hasErrors.email}"><i
                    class="fa fa-envelope blue-1"></i>
                <input class="form-field bgwhite" placeholder="email" id="email" type="email" name="email"
                       v-model="registerData.email" required/>
                <span v-if="hasErrors.email" class="help-block"><strong>{{errorMessage.email}}</strong></span>
            </div>
            <div class="listing-form-field"><i class="fa fa-lock blue-1"></i>
                <input class="form-field bgwhite" placeholder="password" id="password" type="password" name="password"
                       v-model="registerData.password" required/>
                <span v-if="hasErrors.password" class="help-block"><strong>{{errorMessage.password}}</strong></span>
            </div>
            <div class="listing-form-field"><i class="fa fa-lock blue-1"></i>
                <input class="form-field bgwhite" placeholder="confirm password" id="password-confirm" type="password"
                       name="password_confirmation" v-model="registerData.password_confirmation"
                       required/>
            </div>
            <div class="listing-form-field clearfix margin-top-20 margin-bottom-20">
                <input type="checkbox" id="checkbox-1-2" class="regular-checkbox"/>
                <label for="checkbox-1-2"></label>
                <label class="checkbox-lable">i agree with</label>
                <a href="#">terms & conditions</a></div>
            <div class="listing-form-field">
                <!-- <input class="form-field submit" type="submit" value="create account" /> -->
                <button type="submit" class="form-field submit" @click.prevent="registerPost()">
                    Register
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                registerData: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                hasErrors: {
                    name: false,
                    email: false,
                    password: false
                },
                errorMessage: {
                    name: null,
                    email: null,
                    password: null
                }
                //passwordMatch:null
            }
        },
        methods: {
            registerPost: function () {
                var _this = this
                var vm = this.hasErrors
                var _vm = this.errorMessage
                axios.post('register', _this.registerData)
                    .then(function (response) {
                        // window.location = "/my-profile";
                        if (response.status === 200) {
                            $('#dhon').hide('slow');
                            $('.ass').show('slow');

                        }
                    })
                    .catch(function (error) {
                        var errors = error.response
                        if (errors.statusText === 'Unprocessable Entity') {
                            if (errors.data) {
                                if (errors.data.name) {
                                    vm.name = true
                                    _vm.name = _.isArray(errors.data.name) ? errors.data.name[0] : errors.data.name
                                }
                                if (errors.data.email) {
                                    vm.email = true
                                    _vm.email = _.isArray(errors.data.email) ? errors.data.email[0] : errors.data.email
                                }
                                if (errors.data.password) {
                                    vm.password = true
                                    _vm.password = _.isArray(errors.data.password) ? errors.data.password[0] : errors.data.password
                                }
                            }
                        }
                    });
            }
        }
        /*
            computed:{
                passwordValidate(){
                    var vm = this.registerData;
                    var _this = this
                    return vm.password_confirmation !== vm.password  ? _this.passwordMatch = 'The password confirmation does not match.'  : _this.passwordMatch = null
                }
            }
        */
    }
</script>

<style>

    .ass{
        display: none;
    }

</style>

