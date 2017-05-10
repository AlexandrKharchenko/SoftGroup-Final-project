<template>
    <form class="" role="form" method="POST" action="" v-on:submit.prevent="submitRegister">
        <div class="form-group" v-bind:class="{ 'has-danger': errors.has('name') }">
            <label for="email">Фио</label>
            <input id="name" type="text" class="form-control" name="name"   autofocus v-model="userData.name">
            <span v-show="errors.has('name')" class="form-control-feedback is-danger">{{ errors.first('name') }}</span>

        </div>


        <div class="form-group" v-bind:class="{ 'has-danger': errors.has('email') }">
            <label for="email">E-Mail</label>
            <input v-validate="'required|email'" id="email" class="form-control" name="email"   autofocus v-model="userData.email">
            <span v-show="errors.has('email')" class="form-control-feedback is-danger">{{ errors.first('email') }}</span>
        </div>

        <div class="form-group"  v-bind:class="{ 'has-danger': errors.password }">
            <label for="password">Пароль</label>
            <input id="password" type="password" class="form-control" name="password"  autofocus v-model="userData.password">

        </div>

        <div class="form-group"  v-bind:class="{ 'has-danger': errors.password }">
            <label for="password-confirm">Пароль повторно</label>
            <input id="password-confirm" type="password" class="form-control" name="password-confirm"  autofocus v-model="userData['password-confirm']">

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
                    name: '',
                    email: '',
                    password: '',
                    "password-confirm": '',
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

                            //this.$set(this, 'errors',  []);
                        },
                        // Error
                        (response) => {
                            for(var  i in response.data){
                                ErrorStorage.add(i, response.data[i][0] , 'email')
                            }
                        }
                    );
                }).catch(() => {
                    // eslint-disable-next-line
                    alert('Correct them errors!');
                });


            }
        }
    }
</script>