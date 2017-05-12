<template>
    <button v-on:click="toggleLike" class="btn btn-block btn-outline-danger"><i class="fa"></i> {{likeTxt}}</button>
</template>

<script>
    export default {
        mounted() {

        },
        data() {
            return {
                existLike: false,
            }
        },
        computed: {
            likeTxt () {
                let btnTxt = '';
                if(this.existLike){
                    btnTxt = 'Убрать лайк';
                } else {
                    btnTxt = 'Поставить лайк';
                }
                return btnTxt;
            }
        },
        props: ['profileid' , 'is_like'],
        methods: {
            toggleLike () {

                this.$http.post('/profile/like/' + this.profileid, this.userData).then(
                    // Success
                    (response) => {
                        console.log(response.data);
                        if(response.data.attached.length > 0){
                            this.$set(this ,'existLike' , true);
                        } else {
                            this.$set(this ,'existLike' , false);
                        }
                    },
                    // Error
                    (response) => {


                    }
                );
            }
        }
    }
</script>