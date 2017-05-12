<template>
    <form class="" role="form" method="POST" action="" v-on:submit.prevent="submitRegister">
        <div class="form-group" v-bind:class="{ 'has-danger': errors.has('name') }">
            <label for="email">Фио</label>
            <input id="name" v-validate="'required|min:3'" type="text" class="form-control" name="name"   autofocus v-model="userData.name">
            <span v-show="errors.has('name')" class="form-control-feedback is-danger">{{ errors.first('name') }}</span>

        </div>


        <div class="form-group" v-bind:class="{ 'has-danger': errors.has('email') }">
            <label for="email">E-Mail</label>
            <input v-validate="'required|email'" id="email" class="form-control" name="email"   autofocus v-model="userData.email">
            <span v-show="errors.has('email')" class="form-control-feedback is-danger">{{ errors.first('email') }}</span>
        </div>

        <div class="form-group"  v-bind:class="{ 'has-danger':  errors.has('password') }">
            <label for="password">Пароль</label>
            <input v-validate="'required|min:6|confirmed:password_confirmation'" id="password" type="password" class="form-control" name="password"  autofocus v-model="userData.password">
            <span v-show="errors.has('password')" class="form-control-feedback is-danger">{{ errors.first('password') }}</span>
        </div>

        <div class="form-group" >
            <label for="password_confirmation">Пароль повторно</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"  autofocus v-model="userData['password_confirmation']">

        </div>

        <div class="form-group">

            <button type="submit" class="btn btn-primary">
                Зарегестрироваться
            </button>

            <a class="" href="/login" >
                Есть аккаунт?
            </a>

        </div>
    </form>
</template>

<script>

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                userData: {
                    name: 'Name',
                    email: 'mail@mail.com',
                    password: '111111',
                    "password_confirmation": '111111',
                }



            }
        },
        methods: {
            submitRegister () {
                let userData = this.userData;
                let ErrorStorage = this.errors;
                this.$validator.validateAll().then(() => {
                    this.$http.post('/api/auth/register', userData).then(
                        // Success
                        (response) => {
                            if(response.data.redirect)
                                window.location = response.data.redirect;

                        },
                        // Error
                        (response) => {
                            console.log(response)
                            for(var  i in response.data){
                                ErrorStorage.add(i, response.data[i][0] , 'email')
                            }
                        }
                    );
                }).catch(() => {


                });


            }
        }
    }
</script>