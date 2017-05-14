<template>
    <form class="" role="form" method="POST" action="" v-on:submit.prevent="submitLogin">
        <div class="form-group" v-bind:class="{ 'has-danger': errors.has('email') }">
            <label for="email">E-Mail</label>
            <input id="email" type="email" class="form-control" name="email"  required autofocus v-model="userData.email">
            <span v-show="errors.has('email')" class="form-control-feedback is-danger">{{ errors.first('email') }}</span>
        </div>

        <div class="form-group"  v-bind:class="{ 'has-danger': errors.has('password') }">

            <label for="password">Пароль</label>
            <input id="password" type="password" class="form-control" name="password" required autofocus v-model="userData.password">
            <span v-show="errors.has('password')" class="form-control-feedback is-danger">{{ errors.first('password') }}</span>
        </div>



        <div class="form-group">

            <div class="checkbox">
                <label>
                    <input v-model="userData.remember" type="checkbox" name="remember"> Запомнить
                </label>
            </div>

        </div>

        <div class="form-group">

            <button type="submit" class="btn btn-primary">
                Войти
            </button>

            <a class="btn btn-link" href="/password/reset" >
                Забыли пароль?
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
                userData : {
                    email: 'mail@mail.com',
                    password: '111111',
                    remember: true,
                },

            }
        },
        methods: {
            submitLogin () {
                let userData = this.userData;
                let ErrorStorage = this.errors;
                this.$validator.validateAll().then(() => {
                    this.$http.post('/api/auth/login', this.userData).then(
                        // Success
                        (response) => {
                            if(response.data.redirect)
                                window.location = response.data.redirect;

                        },
                        // Error
                        (response) => {
                            for(var  i in response.data){
                                console.log(i)
                                ErrorStorage.add(i, response.data[i][0])
                            }
                        }
                    );
                }).catch(() => {


                });

            }
        }
    }
</script>