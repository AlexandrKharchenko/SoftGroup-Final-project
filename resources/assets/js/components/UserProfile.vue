<template>
    <form class="" role="" method="POST" action="" v-on:submit.prevent="updateProfile" enctype="multipart/form-data" id="updateProfileId">
        <div class="row wBg">

            <div class="col-md-4">

                <div class="form-group" v-bind:class="{ 'has-danger': errors.has('photo') }">
                    <label for="photo">Фото профиля</label>
                    <img class="profile-edit-preview-photo"  v-show="previewPhoto" :src="previewPhoto" />

                    <input id="photo"  type="file" class="form-control"
                           name="photo"  @change="changeUserPhoto" v-validate="'image'">
                    <span v-show="errors.has('photo')"
                          class="form-control-feedback is-danger">{{ errors.first('photo') }}</span>
                    <button type="button" v-show="editPhoto" v-on:click="cancelEditPhoto" class="btn btn-sm btn-danger btn-block">Отменить редактирование фото</button>
                </div>

                <div class="form-group" v-bind:class="{ 'has-danger': errors.has('first_name') }">
                    <label for="first_name">Имя</label>
                    <input id="first_name" v-validate="'required|min:3'" type="text" class="form-control"
                           name="first_name"
                           placeholder="Имя" autofocus v-model="userData.first_name">
                    <span v-show="errors.has('first_name')"
                          class="form-control-feedback is-danger">{{ errors.first('first_name') }}</span>
                </div>


                <div class="form-group" v-bind:class="{ 'has-danger': errors.has('last_name') }">
                    <label for="last_name">Фамилия</label>
                    <input id="last_name" v-validate="'required|min:3'" type="text" class="form-control"
                           name="last_name"
                           placeholder="Фамилия" autofocus v-model="userData.last_name">
                    <span v-show="errors.has('first_name')"
                          class="form-control-feedback is-danger">{{ errors.first('last_name') }}</span>
                </div>

                <div class="form-group" v-bind:class="{ 'has-danger': errors.has('middle_name') }">
                    <label for="middle_name">Отчество</label>
                    <input id="middle_name" v-validate="'required|min:3'" type="text" class="form-control"
                           name="middle_name"
                           placeholder="Отчество" autofocus v-model="userData.middle_name">
                    <span v-show="errors.has('middle_name')"
                          class="form-control-feedback is-danger">{{ errors.first('middle_name') }}</span>
                </div>

                <div class="form-group" v-bind:class="{ 'has-danger': errors.has('bdate') }">
                    <label for="middle_name">Дата рождения</label>
                    <input id="bdate" v-validate="'required|date_format:DD.MM.YYYY'" type="text" class="form-control"
                           name="bdate"
                           placeholder="Дата рождения" autofocus v-model="userData.bdate">
                    <span v-show="errors.has('bdate')"
                          class="form-control-feedback is-danger">{{ errors.first('bdate') }}</span>
                </div>



                <div class="form-group" v-bind:class="{ 'has-danger': errors.has('phone') }">
                    <label for="phone">Телефон</label>
                    <input id="phone"  type="text" class="form-control" name="phone"
                           placeholder="Телефон" autofocus v-model="userData.phone">
                    <span v-show="errors.has('phone')"
                          class="form-control-feedback is-danger">{{ errors.first('phone') }}</span>
                </div>

                <div class="form-group" v-bind:class="{ 'has-danger': errors.has('github_url') }">
                    <label for="phone">Профиль GitHub</label>
                    <input id="github_url" v-validate="'required|url'" type="text" class="form-control"
                           name="github_url"
                           placeholder="Профиль GitHub" autofocus v-model="userData.github_url">
                    <span v-show="errors.has('github_url')"
                          class="form-control-feedback is-danger">{{ errors.first('github_url') }}</span>
                </div>

                <div class="form-group">
                    <button class="btn btn-outline-success btn-block">Обновить профиль</button>
                </div>


            </div>

            <div class="col-md-8">
                <div class="form-group" v-bind:class="{ 'has-danger': errors.has('about') }">
                    <label for="about">О себе</label>
                    <textarea id="about" placeholder="О себе" v-validate="'required|min:20'" class="form-control"
                              name="about" v-model="userData.about"></textarea>

                    <span v-show="errors.has('about')"
                          class="form-control-feedback is-danger">{{ errors.first('about') }}</span>
                </div>
            </div>

        </div>
    </form>

</template>

<script>

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        created () {
            console.log()
            this.$http.post('/api/profile', {}).then(
                // Success
                (response) => {
                    console.log(response.data)
                    if(response.data.profile)
                        this.userData = response.data.profile;

                    this.previewPhoto = '/' + response.data.profile.photo;


                },
                // Error
                (response) => {

                }
            );
        },
        data() {
            return {
                userData: {
                    first_name: '',
                    last_name: '',
                    middle_name: '',
                    bdate: '',
                    phone: '',
                    github_url: '',
                    about: '',
                    photo: null,
                },
                previewPhoto: '',
                editPhoto: false,
            }
        },
        methods: {
            updateProfile (e) {
                var formData = new FormData();

                for ( let key in this.userData ) {
                    formData.append(key, this.userData[key])
                }

                formData.append('editPhoto', this.editPhoto)


                let userData = this.userData;
                let ErrorStorage = this.errors;
                let VC = this;

                this.$validator.validateAll().then(() => {
                    this.$http.post('/api/profile/update', formData).then(
                        // Success
                        (response) => {
                            if(response.data.profile) {
                                VC.updateUserDataAfterRequest(response.data.profile);

                                $.toast({
                                    icon: 'success',
                                    heading: 'Профиль обновлен!',

                                    position: 'top-right',
                                    stack: false
                                });

                            }


                        },
                        // Error
                        (response) => {
                            if(response.status == 500){
                                $.toast({
                                    icon: 'error',
                                    heading: 'Ошибка сервера!',
                                    text: 'Мы скоро с этим разберемся! ;)',
                                    position: 'top-right',
                                    stack: false
                                });
                                return false;
                            }


                            for (var i in response.data) {
                                ErrorStorage.add(i, response.data[i][0], 'email')
                            }

                        }
                    );
                }).catch(() => {


                });

            },
            cancelEditPhoto () {
                this.$set(this, 'editPhoto' , false);
            },
            changeUserPhoto (e) {
                this.$set(this, 'editPhoto' , true);
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                this.userData.photo = files[0];
                this.createImage(files[0]);
            },
            createImage(file) {
                let image = new Image();
                let reader = new FileReader();
                let vm = this;

                reader.onload = (e) => {
                    vm.previewPhoto = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            updateUserDataAfterRequest(userData){
                this.$set(this , 'userData' , userData);
            },

        }
    }
</script>