<template>
    <div>
        <button v-on:click="toggleStatus"  v-bind:class="{ 'btn-danger' : setStatus , 'btn-success' : !setStatus}" class="btn btn-block ">{{text}}</button>

    </div>

</template>

<script>
    export default {
        mounted() {

        },
        created() {

            this.$set(this, 'setStatus' , this.status);
        },
        data() {
            return {
                setStatus: false

            }
        },
        computed: {
            text () {
                return (this.setStatus == true) ? 'Деактивировать' : 'Активировать';
            }
        },
        props: ['status' , 'profileid'],
        methods: {
            toggleStatus () {

                this.$http.post('/admin/profile/toggle-status/' + this.profileid, {status: !this.setStatus}).then(
                    // Success
                    (response) => {
                           if(response.action = "success")
                            this.$set(this ,'setStatus' , !this.setStatus);

                    },
                    // Error
                    (error) => {

                    }
                );
            }
        }
    }
</script>