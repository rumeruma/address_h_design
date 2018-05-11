<template>

    <form role="form">
        <div class="listing-form-field" :class="{'has-error' : errorsEmail}"> <i class="fa fa-user blue-1"></i>
            <input class="form-field bgwhite" placeholder="email" id="email" type="email" name="email" v-model="loginDetails.email" required autofocus />
        </div>
        <span v-if="errorsEmail" class="help-block">
            <strong>{{emailError}}</strong>
        </span>
        <div class="listing-form-field" :class="{'has-error' : errorsPassword}"> <i class="fa fa-lock blue-1"></i>
            <input class="form-field bgwhite" placeholder="password" id="password" type="password" v-model="loginDetails.password" name="password" required />

            <span v-if="errorsPassword" class="help-block">
            <strong>{{passwordError}}</strong>
        </span>
        <div class="listing-form-field clearfix margin-top-20 margin-bottom-20">
            <input type="checkbox" id="checkbox-1-1" class="regular-checkbox" v-model="loginDetails.remember"  name="remember" />
            <label for="checkbox-1-1"></label>
            <label class="checkbox-lable">Remember me</label>
            <a href="/password/reset">forgot password?</a> </div>
        <div class="listing-form-field">
            <button type="submit" @click.prevent="loginPost" class="form-field submit">Login</button>
        </div>
        </div>
        
    </form>
                    
</template>

<script>
    export default {
        data(){
            return{
            loginDetails:{
                email:'',
                password:'',
                remember:true
            },
            errorsEmail: false,
            errorsPassword: false,
            emailError:null,
            passwordError:null
            }
        },
        methods:{
        loginPost(){
            let vm = this;
            axios.post('/login', vm.loginDetails)
            .then(function (response) {
                window.location = "/my-profile";
            })
            .catch(function (error) {
                var errors = error.response
                if(errors.statusText === 'Unprocessable Entity'){
                    if(errors.data){
                        if(errors.data.email){
                           vm.errorsEmail = true
                           vm.emailError = _.isArray(errors.data.email) ? errors.data.email[0]: errors.data.email
                        }
                        if(errors.data.password){
                           vm.errorsPassword = true
                           vm.passwordError = _.isArray(errors.data.password) ? errors.data.password[0] : errors.data.password
                        }
                    }
                }
            });
        }
        },
        mounted() {
        }
    }
</script>