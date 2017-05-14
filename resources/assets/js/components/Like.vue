<template>
    <div>
        <button v-on:click="toggleLike" v-html="likeTxt" class="btn btn-block btn-outline-danger"></button>

    </div>

</template>

<script>
    export default {
        mounted() {

        },
        created() {


            this.$http.post('/profile/likes/get/' + this.profileid).then(
                // Success
                (response) => {
                    //console.log(response.data);
                    this.$set(this ,'existLike' , response.data.isLike);
                    this.$set(this ,'likes' , response.data.isLike);
                    this.$set(this ,'likesCount' , response.data.likes.data.length);
                },
                // Error
                (response) => {


                }
            );
        },
        data() {
            return {
                existLike: false,
                likes: [],
                likesCount: 0,
            }
        },
        computed: {
            likeTxt () {
                let btnTxt = '';
                if(this.existLike){
                    btnTxt = this.likesCount+' <i class="fa fa-heart" aria-hidden="true"></i>';
                } else {
                    btnTxt = this.likesCount+' <i class="fa fa-heart-o" aria-hidden="true"></i>';
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
                        //console.log(response.data);
                        if(response.data.attached.length > 0){
                            this.$set(this ,'existLike' , true);
                            this.$set(this ,'likesCount' , this.likesCount + 1);
                        } else {
                            this.$set(this ,'existLike' , false);
                            this.$set(this ,'likesCount' , this.likesCount - 1);
                        }
                    },
                    // Error
                    (error) => {
                        if(error.status === 401) {
                            $.toast({
                                icon: 'error',
                                heading: 'Авторизуйтесь!',
                                text: 'Лайкать можно после авторизации ;)',
                                position: 'top-right',
                                stack: true
                            })
                        }



                    }
                );
            }
        }
    }
</script>