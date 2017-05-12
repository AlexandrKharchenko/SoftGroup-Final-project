<template>
    <form class="" role="form" method="POST" action="" v-on:submit.prevent="submitLogin">
        <div class="form-group" v-bind:class="{ 'has-danger': errors.email }">
            <label for="email">E-Mail</label>
            <input id="email" type="email" class="form-control" name="email"  required autofocus v-model="userData.email">
            <div class="form-control-feedback" v-if="errors.email"> {{errors.email[0]}}</div>
        </div>

        <div class="form-group"  v-bind:class="{ 'has-danger': errors.password }">

            <label for="password">Пароль</label>
            <input id="password" type="password" class="form-control" name="password" required autofocus v-model="userData.password">
            <div class="form-control-feedback" v-if="errors.password"> {{errors.password[0]}}</div>
        </div>



        <div class="form-group">

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Запомнить
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
                    password: '111111'
                },
                errors: [],
            }
        },
        methods: {
            submitLogin () {

                this.$http.post('/api/auth/login', this.userData).then(
                    // Success
                    (response) => {
                        if(response.data.redirect)
                            window.location = response.data.redirect;
                    },
                    // Error
                    (response) => {


                    }
                );
            }
        }
    }
</script>